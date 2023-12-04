<?php

namespace FactelBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use FactelBundle\Entity\Compra;
use FactelBundle\Entity\DetalleCompra;

/**
 * Compra controller.
 *
 * @Route("/comprobantes/compra")
 */
class CompraController extends Controller {

    /**
     * Lists all Emisor entities.
     *
     * @Route("/", name="compra")
     * @Method("GET")
     * @Template()
     */
    public function indexAction() {

        return array();
    }

    /**
     * Lists all Factura entities.
     *
     * @Route("/compras", name="all_compra")
     * @Secure(roles="ROLE_EMISOR")
     * @Method("GET")
     */
    public function comprasAction() {
        if (isset($_GET['sEcho'])) {
            $sEcho = $_GET['sEcho'];
        }
        if (isset($_GET['iDisplayStart'])) {
            $iDisplayStart = intval($_GET['iDisplayStart']);
        }
        if (isset($_GET['iDisplayLength'])) {
            $iDisplayLength = intval($_GET['iDisplayLength']);
        }
        $sSearch = "";
        if (isset($_GET['sSearch'])) {
            $sSearch = $_GET['sSearch'];
        }

        $em = $this->getDoctrine()->getManager();
        $emisorId = null;
        $idEstablecimiento = null;
        $userId = $this->get("security.context")->gettoken()->getuser()->getId();
        $user = $em->getRepository('FactelBundle:User')->find($userId);
        if ($this->get("security.context")->isGranted("ROLE_EMISOR_ADMIN")) {
            $emisorId = $user->getEmisor()->getId();
        } else {
            $idEstablecimiento = $user->getPtoEmision()->getEstablecimiento()->getId();
        }
        $count = $em->getRepository('FactelBundle:Compra')->cantidadCompras($idEstablecimiento, $emisorId);
        $entities = $em->getRepository('FactelBundle:Compra')->findCompras($sSearch, $iDisplayStart, $iDisplayLength, $idEstablecimiento, $emisorId);
        $totalDisplayRecords = $count;

        if ($sSearch != "") {
            $totalDisplayRecords = count($em->getRepository('FactelBundle:Compra')->findCompras($sSearch, $iDisplayStart, 1000000, $idEstablecimiento, $emisorId));
        }
        $compraArray = array();
        $i = 0;
        foreach ($entities as $entity) {
            $fechaEmision = $entity->getFechaEmision()->format("d/m/Y");
            $proveedor = $entity->getNombreComercialProveedor() != null ? $entity->getNombreComercialProveedor() : $entity->getRazonSocialProveedor();
            $compraArray[$i] = [$entity->getId(), $entity->getNumeroFactura(),
                $proveedor, $entity->getIdentificacionProveedor(),
                $fechaEmision, $entity->getSubTotalIva12(),
                $entity->getSubTotalIva0(),
                $entity->getIva12(),
                $entity->getValorICE(),
                $entity->getValorTotal(),
                $entity->getFacturaFisica() ? "SI" : "NO"];
            $i++;
        }

        $arr = array(
            "iTotalRecords" => (int) $count,
            "iTotalDisplayRecords" => (int) $totalDisplayRecords,
            'aaData' => $compraArray
        );

        $post_data = json_encode($arr);

        return new Response($post_data, 200, array('Content-Type' => 'application/json'));
    }

    /**
     * Creates a new Factura entity.
     *
     * @Route("/eliminar/{id}", name="compra_eliminar")
     * @Method("GET")
     * @Secure(roles="ROLE_EMISOR")
     */
    public function eliminarAccion($id) {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('FactelBundle:Compra')->find($id);
        if (!$entity) {
            throw $this->createNotFoundException('No existe la compra con ID = ' + $id);
        }
        foreach ($entity->getDetallesCompra() as $detalleCompra) {
            $em->remove($detalleCompra);
        }
        $em->remove($entity);
        $em->flush();
        return $this->redirect($this->generateUrl('compra'));
    }

    /**
     * @Route("/nueva", name="compra-nueva")
     * @Method("GET")
     * @Secure(roles="ROLE_EMISOR")
     * @Template()
     */
    public function cargarCompraAction() {
        $form = $this->createCompraForm();
        return array(
            'form' => $form->createView(),
        );
    }

    /**
     *
     * @Route("/guardar-compra-fisica", name="guardar-compra-fisica")
     * @Method("POST")
     * @Secure(roles="ROLE_EMISOR")
     */
    public function createCompraFisicaAction(Request $request) {

        $fechaEmision = $request->request->get("fechaEmision");
        $numeroFactura = $request->request->get("numeroFactura");
        $numeroAutorizacion = $request->request->get("numeroAutorizacion");

        $nombre = $request->request->get("nombre");
        $identificacion = $request->request->get("identificacion");
        $direccion = $request->request->get("direccion");

        $idCompra = $request->request->get("idCompra");

        $ruta = $idCompra != null && $idCompra != '' ? $this->generateUrl('compra_edit', array('id' => $idCompra)) : $this->generateUrl('compra-nueva', array());
        $texto = "";
        $campos = "";
        $cantidadErrores = 0;

        if ($fechaEmision == '') {
            $campos .= "Fecha Emision, ";
            $cantidadErrores++;
        }
        if ($numeroFactura == '') {
            $campos .= "Numero Factura, ";
            $cantidadErrores++;
        }
        if ($numeroAutorizacion == '') {
            $campos .= "Numero Autorizacion, ";
            $cantidadErrores++;
        }
        if ($nombre == '') {
            $campos .= "Nombre Cliente, ";
            $cantidadErrores++;
        }
        if ($identificacion == '') {
            $campos .= "Identificacion, ";
            $cantidadErrores++;
        }
        if ($direccion == '') {
            $campos .= "Direccion, ";
            $cantidadErrores++;
        }
        if ($cantidadErrores > 0) {
            if ($cantidadErrores == 1) {
                $texto = "El campo <strong>" . $campos . "</strong> no puede estar vacios";
            } else {
                $texto = "Los campos " . $campos . " no pueden estar vacios";
            }
            $this->get('session')->getFlashBag()->add(
                    'notice', $texto
            );

            return $this->redirect($ruta);
        }


        $subTotalSinImpuesto = 0;
        $subTotal12 = 0;
        $subTotal0 = 0;
        $descuento = 0;
        $ice = 0;

        $cantidadArray = $request->request->get("cantidad");
        $nombreProductoArray = $request->request->get("nombreProducto");
        $precioArray = $request->request->get("precio");
        $descuentoArray = $request->request->get("descuento");
        $tieneivaArray = $request->request->get("tieneiva");
        $iceArray = $request->request->get("ice");

        if ($cantidadArray == null) {
            $this->get('session')->getFlashBag()->add(
                    'notice', "La factura debe contener al menos un producto"
            );
            return $this->redirect($ruta);
        }

        $em = $this->getDoctrine()->getManager();
        $userId = $this->get("security.context")->gettoken()->getuser()->getId();
        $user = $em->getRepository('FactelBundle:User')->find($userId);
        if ($idCompra != null && $idCompra != '') {
            $compra = new Compra();
            $compra = $em->getRepository('FactelBundle:Compra')->find($idCompra);
            if (!is_null($compra)) {
                foreach ($compra->getDetallesCompra() as $detalle) {
                    $em->remove($detalle);
                }
                $em->flush();
            }
        } else {
            $compra = new Compra();
        }
        $compra->setFacturaFisica(true);
        foreach ($cantidadArray as $key => $cantidad) {
            $detalleCompra = new DetalleCompra();
            $detalleCompra->setCompra($compra);
            $detalleCompra->setCodigoProducto("N/A");
            $detalleCompra->setCantidad(floatval($cantidad));
            $detalleCompra->setNombre($nombreProductoArray[$key]);
            $detalleCompra->setPrecioUnitario(floatval($precioArray[$key]));
            $detalleCompra->setDescuento(floatval($descuentoArray[$key]));
            $detalleCompra->setIce(floatval($iceArray[$key]));

            $baseImponible = floatval($cantidadArray[$key]) * floatval($precioArray[$key]) - floatval($descuentoArray[$key]);
            $detalleCompra->setSubTotal($baseImponible);
            $subTotalSinImpuesto +=$baseImponible;
            if (isset($tieneivaArray[$key])) {
                $subTotal12+= $baseImponible;
                $iva = round($baseImponible * 12 / 100, 2);
                $detalleCompra->setIva12($iva);
            } else {
                $subTotal0 += $baseImponible;
            }
            $descuento += $detalleCompra->getDescuento();
            $ice +=$detalleCompra->getIce();

            $compra->addDetallesCompra($detalleCompra);
            $em->persist($detalleCompra);
        }
        $iva12 = round($subTotal12 * 12 / 100, 2);
        $valorTotal = floatval($subTotalSinImpuesto) + floatval($ice) + $iva12;
        $fechaModificada = str_replace("/", "-", $fechaEmision);
        $fecha = new \DateTime($fechaModificada);
        $compra->setFechaEmision($fecha);
        $compra->setClaveAcceso($numeroAutorizacion);
        $compra->setNumeroAutorizacion($numeroAutorizacion);
        $compra->setNumeroFactura($numeroFactura);
        $compra->setIdentificacionProveedor($identificacion);
        $compra->setRazonSocialProveedor($nombre);
        $compra->setNombreComercialProveedor($nombre);
        $compra->setDireccionMatrizProveedor($direccion);

        $compra->setDireccionEstabProveedor($direccion);
        $compra->setEmisor($user->getEmisor());
        $compra->setEstablecimiento($user->getPtoEmision()->getEstablecimiento());
        $compra->setTotalSinImpuestos($subTotalSinImpuesto);
        $compra->setTotalDescuento($descuento);
        $compra->setSubTotalIva12($subTotal12);
        $compra->setIva12($iva12);
        $compra->setSubTotalIva0($subTotal0);
        $compra->setValorICE($ice);
        $compra->setPropina(0.00);
        $compra->setValorTotal($valorTotal);

        $em->persist($compra);
        $em->flush();
        return $this->redirect($this->generateUrl('compra_show', array('id' => $compra->getId())));
    }

    /**
     *
     * @Route("/cargar", name="compra-cargar")
     * @Method("POST")
     * @Secure(roles="ROLE_EMISOR")
     */
    public function createCompraAction(Request $request) {
        $form = $this->createCompraForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form['xml_compra']->getData();
            $extension = $file->guessExtension();

            if (strtolower($extension) != "xml") {
                $this->get('session')->getFlashBag()->add(
                        'notice', "Ha cargado un archivo con extension: " . $extension . ", debe cargar un archivo xml"
                );
                return $this->redirect($this->generateUrl('compra-nueva'));
            }

            $xml = simplexml_load_file($file->getPathname(), 'SimpleXMLElement', LIBXML_NOCDATA);
            $compra = new Compra();
            if ($xml->estado) {
                if ($xml->estado != "AUTORIZADO") {
                    $this->get('session')->getFlashBag()->add(
                            'notice', "Solo se pueden cargar facturas con estado AUTORIZADO"
                    );
                    return $this->redirect($this->generateUrl('compra-nueva'));
                }

                $compra->setNumeroAutorizacion($xml->numeroAutorizacion);
                $compra->setFechaAutorizacion(new \DateTime($xml->fechaAutorizacion));
                $xml = simplexml_load_string($xml->comprobante);
            }

            $infoTributaria = $xml->infoTributaria;
            if ($infoTributaria->ambiente != "2") {
                $this->get('session')->getFlashBag()->add(
                        'notice', "Solo se pueden cargar facturas emitidas en ambiente PRODUCCION"
                );
                return $this->redirect($this->generateUrl('compra-nueva'));
            }
            if ($infoTributaria->codDoc != "01") {
                $this->get('session')->getFlashBag()->add(
                        'notice', "Solo se pueden cargar XML correspondientes a Factura(codDoc=01)"
                );
                return $this->redirect($this->generateUrl('compra-nueva'));
            }

            $em = $this->getDoctrine()->getManager();
            $compraBD = $em->getRepository('FactelBundle:Compra')->findOneBy(array(
                'claveAcceso' => $infoTributaria->claveAcceso
            ));

            if ($compraBD != null) {
                $this->get('session')->getFlashBag()->add(
                        'notice', "Ya se encuentra cargada una factura de compra con la misma clave de acceso"
                );
                return $this->redirect($this->generateUrl('compra-nueva'));
            }

            $userId = $this->get("security.context")->gettoken()->getuser()->getId();
            $user = $em->getRepository('FactelBundle:User')->find($userId);
            $compra->setClaveAcceso($infoTributaria->claveAcceso);
            if ($compra->getNumeroAutorizacion() == null) {
                $compra->setNumeroAutorizacion($infoTributaria->claveAcceso);
            }
            $compra->setNumeroFactura($infoTributaria->estab . "-" . $infoTributaria->ptoEmi . "-" . $infoTributaria->secuencial);
            $compra->setIdentificacionProveedor($infoTributaria->ruc);
            $compra->setRazonSocialProveedor($infoTributaria->razonSocial);
            $compra->setNombreComercialProveedor($infoTributaria->nombreComercial);
            $compra->setDireccionMatrizProveedor($infoTributaria->dirMatriz);

            $infoFactura = $xml->infoFactura;
            $compra->setDireccionEstabProveedor($infoFactura->dirEstablecimiento);
            $compra->setEmisor($user->getEmisor());
            $compra->setEstablecimiento($user->getPtoEmision()->getEstablecimiento());
            $compra->setTotalSinImpuestos(floatval($infoFactura->totalSinImpuestos));
            $compra->setTotalDescuento(floatval($infoFactura->totalDescuento));

            $fechaModificada = str_replace("/", "-", $infoFactura->fechaEmision);

            $compra->setFechaEmision(new \DateTime($fechaModificada));
            $totalesImpuesto = $infoFactura->totalConImpuestos;
            foreach ($totalesImpuesto->totalImpuesto as $totalImpuesto) {
                if ($totalImpuesto->codigo == "2" && $totalImpuesto->codigoPorcentaje == "2") {
                    $compra->setSubTotalIva12(floatval($totalImpuesto->baseImponible));
                    $compra->setIva12(floatval($totalImpuesto->valor));
                } else if ($totalImpuesto->codigo == "2" && $totalImpuesto->codigoPorcentaje == "0") {
                    $compra->setSubTotalIva0(floatval($totalImpuesto->baseImponible));
                } else if ($totalImpuesto->codigo == "3") {
                    $compra->setValorICE(floatval($totalImpuesto->valor));
                }
            }
            $compra->setPropina(floatval($infoFactura->propina));
            $compra->setValorTotal(floatval($infoFactura->importeTotal));

            $detalles = $xml->detalles;
            foreach ($detalles->detalle as $detalle) {
                $detalleCompra = new DetalleCompra();
                $detalleCompra->setCompra($compra);
                $detalleCompra->setCodigoProducto($detalle->codigoPrincipal);
                $detalleCompra->setCantidad(floatval($detalle->cantidad));
                $detalleCompra->setNombre($detalle->descripcion);
                $detalleCompra->setPrecioUnitario($detalle->precioUnitario);
                $detalleCompra->setDescuento($detalle->descuento);


                $impuestos = $detalle->impuestos;
                foreach ($impuestos->impuesto as $impuesto) {
                    if ($impuesto->codigo == "2" && $impuesto->codigoPorcentaje == "2") {
                        $detalleCompra->setSubTotal(floatval($impuesto->baseImponible));
                        $detalleCompra->setIva12(floatval($impuesto->valor));
                    } else if ($impuesto->codigo == "2" && $impuesto->codigoPorcentaje == "0") {
                        $detalleCompra->setSubTotal(floatval($impuesto->baseImponible));
                    } else if ($impuesto->codigo == "3") {
                        $detalleCompra->setIce(floatval($impuesto->valor));
                    }
                }

                $compra->addDetallesCompra($detalleCompra);
                $em->persist($detalleCompra);
            }
            $em->persist($compra);
            $em->flush();
            return $this->redirect($this->generateUrl('compra_show', array('id' => $compra->getId())));
        }

        return $this->redirect($this->generateUrl('compra-nueva'));
    }

    /**
     * Finds and displays a Factura entity.
     *
     * @Route("/{id}", name="compra_show")
     * @Method("GET")
     * @Secure(roles="ROLE_EMISOR")
     * @Template()
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FactelBundle:Compra')->findCompraById($id);
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Compra entity.');
        }

        return array(
            'entity' => $entity,
        );
    }

    /**
     * Displays a form to edit an existing Factura entity.
     *
     * @Route("/{id}/editar", name="compra_edit")
     * @Method("GET")
     * @Secure(roles="ROLE_EMISOR")
     * @Template()
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FactelBundle:Compra')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Compra entity.');
        }
        if (!($entity->getFacturaFisica() && $entity->getretencionCreadaId() == null)) {
            $this->get('session')->getFlashBag()->add(
                    'notice', "Solo puede ser editada la factura cargadas manualmente y que no hayan sido utilizadas en una retencion"
            );
            return $this->redirect($this->generateUrl('compra_show', array('id' => $entity->getId())));
        }
        return array(
            'entity' => $entity,
        );
    }

    public function createCompraForm() {

        $builder = $this->createFormBuilder();
        $builder->setAction($this->generateUrl('compra-cargar'));
        $builder->setMethod('POST');

        $builder->add('xml_compra', 'file', [
            'label' => 'Subir XML de Compra'
        ]);

        $builder->add('import', 'submit', array(
            'label' => 'Cargar',
            'attr' => array('class' => 'import'),
        ));
        return $builder->getForm();
    }

}
