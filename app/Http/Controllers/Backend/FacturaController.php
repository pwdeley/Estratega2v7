<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Factura;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class FacturaController extends Controller
{

    public function factura()
    {
        $facturas = DB::table('factura')->get();
        $facturas = Factura::orderBy('id', 'desc')->paginate(5);
        return view('usuario.factura', ['facturas' => $facturas]);
    }

/*    public function store(Request $request): RedirectResponse
    {

        $factura = new Factura();

        $factura->ruc_empresa              = $request->cliente_id;
        $factura->empresa                  = $request->cliente;
        $factura->fechaEmision             = $request->fechaEmision;
        $factura->secuencial               = $request->secuencial;
        $factura->totalSinImpuestos        = $request->totalSinImpuestos;
        $factura->totalDescuento           = $request->totalDescuento;
        $factura->valorICE                 = $request->valorICE;
        $factura->subtotal0                = $request->subtotal0;
        $factura->subtotal12               = $request->subtotal12;
        $factura->iva12                    = $request->iva12;
        $factura->propina                  = $request->propina;
        $factura->valorTotal               = $request->valorTotal;


        $factura->save();

        return redirect()->route('factura.store', $factura);

    }*/

    public function store (Request $request)

    {

        include('public/conexion.php');

        $file_factura = $_FILES["input_factura"];
        $xml_content = file_get_contents($file_factura["tmp_name"]);

        $xml_content = str_replace('<![CDATA[<?xml version="1.0" encoding="UTF-8"?>', '', $xml_content);
        $xml_content = str_replace("]]", "", $xml_content);

        $xml_content =  simplexml_load_string($xml_content);

        $xml_content = (array) $xml_content;


// Tipo de facturas que contienen [infoFactura][totalConImpuestos][totalImpuesto][baseImponible]:
        if ($xml_content["@attributes"]["version"] == "1.0.0") {
            $xml_content["infoTributaria"] = (array)$xml_content["infoTributaria"];
            $xml_content["infoFactura"] = (array)$xml_content["infoFactura"];
            $xml_content["infoFactura"]["totalConImpuestos"] = (array)$xml_content["infoFactura"]["totalConImpuestos"];
            $xml_content["infoFactura"]["totalConImpuestos"]["totalImpuesto"] = (array)$xml_content["infoFactura"]["totalConImpuestos"]["totalImpuesto"];

// extracción de datos:
            $xml_data["ruc_empresa"]                = $xml_content["infoTributaria"]["ruc"];
            $xml_data["empresa"]                    = $xml_content["infoTributaria"]["razonSocial"];;
            $xml_data["claveAcceso"]                = $xml_content["infoTributaria"]["claveAcceso"];
            $xml_data["numeroFactura"]              = $xml_content["infoTributaria"]["estab"]."-".$xml_content["infoTributaria"]["ptoEmi"]."-".$xml_content["infoTributaria"]["secuencial"];
            $xml_data["fechaEmision"]               = date_format(new DateTime($xml_content["infoFactura"] ["fechaEmision"]),"y-m-d");
            $xml_data["cliente_id"]                 = $xml_content["infoFactura"]["identificacionComprador"];
            $xml_data["cliente"]                    = $xml_content["infoFactura"]["razonSocialComprador"];
            $xml_data["totalSinImpuestos"]          = $xml_content["infoFactura"]["totalSinImpuestos"];
            $xml_data["totalDescuento"]             = $xml_content["infoFactura"]["totalDescuento"];
//extracción de valores con y sin IVA:
            if ($xml_content["infoFactura"]["totalConImpuestos"]["totalImpuesto"]["codigo"] == 2) {
                $xml_data["valorICE"]               = 0;
                $xml_data["subtotal0"]              = 0;
                $xml_data["subtotal12"]             = $xml_content["infoFactura"]["totalConImpuestos"]["totalImpuesto"]["baseImponible"];
                $xml_data["iva12"]                  = $xml_content["infoFactura"]["totalConImpuestos"]["totalImpuesto"]["valor"];
                $xml_data["propina"]                = $xml_content["infoFactura"]["propina"];
                $xml_data["valorTotal"]             = $xml_content["infoFactura"]["importeTotal"];
            }

            elseif
            ($xml_content["infoFactura"]["totalConImpuestos"]["totalImpuesto"]["codigoPorcentaje"] == 0){
                $xml_data["valorICE"] = 0;
                $xml_data["subtotal0"] = $xml_content["infoFactura"]["totalConImpuestos"]["totalImpuesto"]["baseImponible"];
                $xml_data["subtotal12"] = 0;
                $xml_data["iva12"] = 0;
                $xml_data["propina"] = $xml_content["infoFactura"]["propina"];
                $xml_data["valorTotal"] = $xml_content["infoFactura"]["importeTotal"];

            }
// inserción de datos en la BD:
            $sql = "INSERT INTO factura(cliente_id, cliente, claveAcceso, secuencial, fechaEmision,
                totalSinImpuestos, totalDescuento, valorICE, subtotal0, subtotal12, iva12, propina, valorTotal)
            VALUES (:ruc_empresa, :empresa, :claveAcceso, :numeroFactura, :fechaEmision,
                :totalSinImpuestos, :totalDescuento, :valorICE, :subtotal0, :subtotal12, :iva12, :propina, :valorTotal)";
            $stm = $conexion->prepare($sql);
            $stm->execute($xml_data);
        }

        print_r("Venta Cargada con Éxito");
        exit;


    }


}
