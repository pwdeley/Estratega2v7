<?php

$file_factura = $_FILES["input_factura"];
$xml_content = file_get_contents($file_factura["tmp_name"]);

$xml_content = str_replace('<![CDATA[<?xml version="1.0" encoding="UTF-8"?>', '', $xml_content);
$xml_content = str_replace("]]", "", $xml_content);

$xml_content =  simplexml_load_string($xml_content);

$xml_content = (array) $xml_content;

// Tipo de facturas que contienen [infoFactura][totalConImpuestos][totalImpuesto][baseImponible]:
if ($xml_content["@attributes"]["version"] == "2.1.0")
{
    $xml_content["infoTributaria"] = (array)$xml_content["infoTributaria"];
    $xml_content["infoFactura"] = (array)$xml_content["infoFactura"];
    $xml_content["infoFactura"]["totalConImpuestos"] = (array)$xml_content["infoFactura"]["totalConImpuestos"];
    $xml_content["infoFactura"]["totalConImpuestos"]["totalImpuesto"] = (array)$xml_content["infoFactura"]["totalConImpuestos"]["totalImpuesto"];

// extracción de datos:
    $xml_data["ruc_empresa"]                ='1723742316001';
    $xml_data["empresa"]                    ='PAREDES NOGALES FREDDY JAVIER';
    $xml_data["claveAcceso"]                = $xml_content["infoTributaria"]["claveAcceso"];
    $xml_data["numeroFactura"]              = $xml_content["infoTributaria"]["estab"]."-".$xml_content["infoTributaria"]["ptoEmi"]."-".$xml_content["infoTributaria"]["secuencial"];
    $xml_data["fechaEmision"]               = $xml_content["infoFactura"] ["fechaEmision"];
    $xml_data["razonSocialProveedor"]       = $xml_content["infoTributaria"]["razonSocial"];
    $xml_data["nombreComercialProveedor"]   = $xml_content["infoTributaria"]["nombreComercial"];
    $xml_data["identificacionProveedor"]    = $xml_content["infoTributaria"]["ruc"];
    $xml_data["direccionMatrizProveedor"]   = $xml_content["infoTributaria"]["dirMatriz"];
    $xml_data["direccionEstabProveedor"]    = $xml_content["infoFactura"]["dirEstablecimiento"];
    $xml_data["totalSinImpuestos"]          = $xml_content["infoFactura"]["totalSinImpuestos"];
    $xml_data["totalDescuento"]             = $xml_content["infoFactura"]["totalDescuento"];

    //extracción de valores con y sin IVA:
    if ($xml_content["infoFactura"]["totalConImpuestos"]["totalImpuesto"]["codigo"] == 2) {
        $xml_data["valorICE"]               = 0;
        $xml_data["subTotalIva0"]           = 0;
        $xml_data["subTotalIva12"]          = $xml_content["infoFactura"]["totalConImpuestos"]["totalImpuesto"]["baseImponible"];
        $xml_data["iva12"]                  = $xml_content["infoFactura"]["totalConImpuestos"]["totalImpuesto"]["valor"];
        $xml_data["propina"]                = $xml_content["infoFactura"]["propina"];
        $xml_data["valorTotal"]             = $xml_content["infoFactura"]["importeTotal"];

    // inserción de datos en la BD:
//        $sql = "INSERT INTO compra(ruc_empresa, empresa, claveAcceso, numeroFactura, fechaEmision, razonSocialProveedor, nombreComercialProveedor, identificacionProveedor,
//                direccionMatrizProveedor, direccionEstabProveedor, totalSinImpuestos, totalDescuento, valorICE, subTotalIva0, subTotalIva12, iva12, propina, valorTotal)
//            VALUES (:ruc_empresa, :empresa, :claveAcceso, :numeroFactura, :fechaEmision, :razonSocialProveedor, :nombreComercialProveedor, :identificacionProveedor,
//                :direccionMatrizProveedor, :direccionEstabProveedor, :totalSinImpuestos, :totalDescuento, :valorICE, :subTotalIva0, :subTotalIva12, :iva12, :propina, :valorTotal)";
//        $stm = $conexion->prepare($sql);
//        $stm->execute($xml_data);

    } elseif($xml_content["infoFactura"]["totalConImpuestos"]["totalImpuesto"]["codigoPorcentaje"]==0)
    {
        $xml_data["valorICE"]               = 0;
        $xml_data["subTotalIva0"]           = $xml_content["infoFactura"]["totalConImpuestos"]["totalImpuesto"]["baseImponible"];
        $xml_data["subTotalIva12"]          = 0;
        $xml_data["iva12"]                  = 0;
        $xml_data["propina"]                = $xml_content["infoFactura"]["propina"];
        $xml_data["valorTotal"]             = $xml_content["infoFactura"]["importeTotal"];

    }
}elseif($xml_content["@attributes"]["version"] == "1.1.0") {
// habilitación de campos xml que están como: SimpleXMLElement Object
    $xml_content["infoTributaria"] = (array)$xml_content["infoTributaria"];
    $xml_content["infoFactura"] = (array)$xml_content["infoFactura"];
    $xml_content["infoFactura"]["totalConImpuestos"] = (array)$xml_content["infoFactura"]["totalConImpuestos"];
    $xml_content["infoFactura"]["totalConImpuestos"]["totalImpuesto"] = (array)$xml_content["infoFactura"]["totalConImpuestos"]["totalImpuesto"];


   switch ($xml_content["infoFactura"]["importeTotal"]>0) {

       case (round(($xml_content["infoFactura"]["totalSinImpuestos"]),2)==round(($xml_content["infoFactura"]["importeTotal"]),2)):

// extracción de datos:
           $xml_data["ruc_empresa"]                ='1723742316001';
           $xml_data["empresa"]                    ='PAREDES NOGALES FREDDY JAVIER';
           $xml_data["claveAcceso"]                = $xml_content["infoTributaria"]["claveAcceso"];
           $xml_data["numeroFactura"]              = $xml_content["infoTributaria"]["estab"]."-".$xml_content["infoTributaria"]["ptoEmi"]."-".$xml_content["infoTributaria"]["secuencial"];
           $xml_data["fechaEmision"]               = $xml_content["infoFactura"] ["fechaEmision"];
           $xml_data["razonSocialProveedor"]       = $xml_content["infoTributaria"]["razonSocial"];
           $xml_data["nombreComercialProveedor"]   = $xml_content["infoTributaria"]["nombreComercial"];
           $xml_data["identificacionProveedor"]    = $xml_content["infoTributaria"]["ruc"];
           $xml_data["direccionMatrizProveedor"]   = $xml_content["infoTributaria"]["dirMatriz"];
           //$xml_data["direccionEstabProveedor"]    = $xml_content ["infoFactura"]["dirEstablecimiento"];
           $xml_data["totalSinImpuestos"]          = $xml_content["infoFactura"]["totalSinImpuestos"];
           $xml_data["totalDescuento"]             = $xml_content["infoFactura"]["totalDescuento"];
        //extracción de valores con y sin IVA:
           $xml_data["valorICE"]               = 0;
           $xml_data["subTotalIva0"]           = $xml_content["infoFactura"]["totalSinImpuestos"];
           $xml_data["subTotalIva12"]          = 0;
           $xml_data["iva12"]                  = 0;
           $xml_data["propina"]                = $xml_content["infoFactura"]["propina"];
           $xml_data["valorTotal"]             = $xml_content["infoFactura"]["importeTotal"];

        break;

       case (($xml_content["infoFactura"]["importeTotal"])==round(($xml_content["infoFactura"]["totalSinImpuestos"]*1.12),2)):


           // extracción de datos:
           $xml_data["ruc_empresa"]                ='1723742316001';
           $xml_data["empresa"]                    ='PAREDES NOGALES FREDDY JAVIER';
           $xml_data["claveAcceso"]                = $xml_content["infoTributaria"]["claveAcceso"];
           $xml_data["numeroFactura"]              = $xml_content["infoTributaria"]["estab"]."-".$xml_content["infoTributaria"]["ptoEmi"]."-".$xml_content["infoTributaria"]["secuencial"];
           $xml_data["fechaEmision"]               = $xml_content["infoFactura"] ["fechaEmision"];
           $xml_data["razonSocialProveedor"]       = $xml_content["infoTributaria"]["razonSocial"];
           $xml_data["nombreComercialProveedor"]   = $xml_content["infoTributaria"]["nombreComercial"];
           $xml_data["identificacionProveedor"]    = $xml_content["infoTributaria"]["ruc"];
           $xml_data["direccionMatrizProveedor"]   = $xml_content["infoTributaria"]["dirMatriz"];
           //$xml_data["direccionEstabProveedor"]    = $xml_content["infoFactura"]["dirEstablecimiento"];
           $xml_data["totalSinImpuestos"]          = $xml_content["infoFactura"]["totalSinImpuestos"];
           $xml_data["totalDescuento"]             = $xml_content["infoFactura"]["totalDescuento"];
           //extracción de valores con y sin IVA:

       if (isset($xml_content["infoFactura"]["totalConImpuestos"]["totalImpuesto"]["baseImponible"])) {

           $xml_data["valorICE"]               = 0;
           $xml_data["subTotalIva0"]           = 0;
           $xml_data["subTotalIva12"]          = $xml_content["infoFactura"]["totalConImpuestos"]["totalImpuesto"]["baseImponible"];
           $xml_data["iva12"]                  = $xml_content["infoFactura"]["totalConImpuestos"]["totalImpuesto"]["valor"];
           if (isset($xml_content["infoFactura"]["propina"])){
               $xml_data["propina"]                = ($xml_content["infoFactura"]["propina"]);
           }
           $xml_data["propina"]                = 0.00;
           $xml_data["valorTotal"]             = $xml_content["infoFactura"]["importeTotal"];

           break;
       }

           if (isset($xml_content["infoFactura"]["totalConImpuestos"]["totalImpuesto"][0]["baseImponible"])) {

               $xml_data["valorICE"]               = 0;
               $xml_data["subTotalIva0"]           = 0;
               $xml_data["subTotalIva12"]          = $xml_content["infoFactura"]["totalConImpuestos"]["totalImpuesto"][0]["baseImponible"];
               $xml_data["iva12"]                  = $xml_content["infoFactura"]["totalConImpuestos"]["totalImpuesto"][0]["valor"];
               $xml_data["propina"]                = $xml_content["infoFactura"]["propina"];
               $xml_data["valorTotal"]             = $xml_content["infoFactura"]["importeTotal"];

               break;
           }

           if (isset($xml_content["infoFactura"]["totalConImpuestos"]["totalImpuesto"][1]["baseImponible"])) {
               $xml_data["valorICE"]               = 0;
               $xml_data["subTotalIva0"]           = 0;
               $xml_data["subTotalIva12"]          = $xml_content["infoFactura"]["totalConImpuestos"]["totalImpuesto"][1]["baseImponible"];
               $xml_data["iva12"]                  = $xml_content["infoFactura"]["totalConImpuestos"]["totalImpuesto"][1]["valor"];
               $xml_data["propina"]                = $xml_content["infoFactura"]["propina"];
               $xml_data["valorTotal"]             = $xml_content["infoFactura"]["importeTotal"];
               break;
           }


       case (($xml_content["infoFactura"]["importeTotal"]-$xml_content["infoFactura"]["totalSinImpuestos"])>0.00):

        $xml_content["infoFactura"]["totalConImpuestos"]["totalImpuesto"][0] = (array)$xml_content["infoFactura"]["totalConImpuestos"]["totalImpuesto"][0];
        $xml_content["infoFactura"]["totalConImpuestos"]["totalImpuesto"][1] = (array)$xml_content["infoFactura"]["totalConImpuestos"]["totalImpuesto"][1];
           // extracción de datos:
           $xml_data["ruc_empresa"]                ='1723742316001';
           $xml_data["empresa"]                    ='PAREDES NOGALES FREDDY JAVIER';
           $xml_data["claveAcceso"]                = $xml_content["infoTributaria"]["claveAcceso"];
           $xml_data["numeroFactura"]              = $xml_content["infoTributaria"]["estab"]."-".$xml_content["infoTributaria"]["ptoEmi"]."-".$xml_content["infoTributaria"]["secuencial"];
           $xml_data["fechaEmision"]               = $xml_content["infoFactura"] ["fechaEmision"];
           $xml_data["razonSocialProveedor"]       = $xml_content["infoTributaria"]["razonSocial"];
           $xml_data["nombreComercialProveedor"]   = $xml_content["infoTributaria"]["nombreComercial"];
           $xml_data["identificacionProveedor"]    = $xml_content["infoTributaria"]["ruc"];
           $xml_data["direccionMatrizProveedor"]   = $xml_content["infoTributaria"]["dirMatriz"];
           $xml_data["direccionEstabProveedor"]    = $xml_content["infoFactura"]["dirEstablecimiento"];
           $xml_data["totalSinImpuestos"]          = $xml_content["infoFactura"]["totalSinImpuestos"];
           $xml_data["totalDescuento"]             = $xml_content["infoFactura"]["totalDescuento"];

        switch ($xml_content["infoFactura"]["totalConImpuestos"]["totalImpuesto"][0]["codigoPorcentaje"]) {
            // extracción de datos:
            case (($xml_content["infoFactura"]["totalConImpuestos"]["totalImpuesto"][0]["codigoPorcentaje"])==0 && ($xml_content["infoFactura"]["totalConImpuestos"]["totalImpuesto"][1]["codigoPorcentaje"])==2):
            //extracción de valores con y sin IVA:

                $xml_data["valorICE"]               = 0;
                $xml_data["subTotalIva0"]           = $xml_content["infoFactura"]["totalConImpuestos"]["totalImpuesto"][0]["baseImponible"];
                $xml_data["subTotalIva12"]          = $xml_content["infoFactura"]["totalConImpuestos"]["totalImpuesto"][1]["baseImponible"];
                $xml_data["iva12"]                  = $xml_content["infoFactura"]["totalConImpuestos"]["totalImpuesto"][1]["valor"];
                $xml_data["propina"]                = $xml_content["infoFactura"]["propina"];
                $xml_data["valorTotal"]             = $xml_content["infoFactura"]["importeTotal"];
                break;

            case (($xml_content["infoFactura"]["totalConImpuestos"]["totalImpuesto"][1]["codigoPorcentaje"])==0 && ($xml_content["infoFactura"]["totalConImpuestos"]["totalImpuesto"][0]["codigoPorcentaje"])==2):
        //extracción de valores con y sin IVA:

                $xml_data["valorICE"]               = 0;
                $xml_data["subTotalIva0"]           = $xml_content["infoFactura"]["totalConImpuestos"]["totalImpuesto"][1]["baseImponible"];
                $xml_data["subTotalIva12"]          = $xml_content["infoFactura"]["totalConImpuestos"]["totalImpuesto"][0]["baseImponible"];
                $xml_data["iva12"]                  = $xml_content["infoFactura"]["totalConImpuestos"]["totalImpuesto"][0]["valor"];
                $xml_data["propina"]                = $xml_content["infoFactura"]["propina"];
                $xml_data["valorTotal"]             = $xml_content["infoFactura"]["importeTotal"];
                break;
        }

    }
}

elseif ($xml_content["@attributes"]["version"] == "1.0.0") {
    $xml_content["infoTributaria"] = (array)$xml_content["infoTributaria"];
    $xml_content["infoFactura"] = (array)$xml_content["infoFactura"];
    $xml_content["infoFactura"]["totalConImpuestos"] = (array)$xml_content["infoFactura"]["totalConImpuestos"];
    $xml_content["infoFactura"]["totalConImpuestos"]["totalImpuesto"] = (array)$xml_content["infoFactura"]["totalConImpuestos"]["totalImpuesto"];

    // extracción de datos:
    $xml_data["ruc_empresa"]                ='1723742316001';
    $xml_data["empresa"]                    ='PAREDES NOGALES FREDDY JAVIER';
    $xml_data["claveAcceso"]                = $xml_content["infoTributaria"]["claveAcceso"];
    $xml_data["numeroFactura"]              = $xml_content["infoTributaria"]["estab"]."-".$xml_content["infoTributaria"]["ptoEmi"]."-".$xml_content["infoTributaria"]["secuencial"];
    $xml_data["fechaEmision"]               = $xml_content["infoFactura"] ["fechaEmision"];
    $xml_data["razonSocialProveedor"]       = $xml_content["infoTributaria"]["razonSocial"];
    $xml_data["nombreComercialProveedor"]   = $xml_content["infoTributaria"]["nombreComercial"];
    $xml_data["identificacionProveedor"]    = $xml_content["infoTributaria"]["ruc"];
    $xml_data["direccionMatrizProveedor"]   = $xml_content["infoTributaria"]["dirMatriz"];
    $xml_data["direccionEstabProveedor"]    = $xml_content["infoFactura"]["dirEstablecimiento"];
    $xml_data["totalSinImpuestos"]          = $xml_content["infoFactura"]["totalSinImpuestos"];
    $xml_data["totalDescuento"]             = $xml_content["infoFactura"]["totalDescuento"];
    //extracción de valores con y sin IVA:
    if ($xml_content["infoFactura"]["totalConImpuestos"]["totalImpuesto"]["codigo"] == 2) {
        $xml_data["valorICE"]               = 0;
        $xml_data["subTotalIva0"]           = 0;
        $xml_data["subTotalIva12"]          = $xml_content["infoFactura"]["totalConImpuestos"]["totalImpuesto"]["baseImponible"];
        $xml_data["iva12"]                  = $xml_content["infoFactura"]["totalConImpuestos"]["totalImpuesto"]["valor"];
        $xml_data["propina"]                = $xml_content["infoFactura"]["propina"];
        $xml_data["valorTotal"]             = $xml_content["infoFactura"]["importeTotal"];
    } elseif ($xml_content["infoFactura"]["totalConImpuestos"]["totalImpuesto"]["codigoPorcentaje"] == 0) {
        $xml_data["valorICE"]               = 0;
        $xml_data["subTotalIva0"]           = $xml_content["infoFactura"]["totalConImpuestos"]["totalImpuesto"]["baseImponible"];
        $xml_data["subTotalIva12"]          = 0;
        $xml_data["iva12"]                  = 0;
        $xml_data["propina"]                = $xml_content["infoFactura"]["propina"];
        $xml_data["valorTotal"]             = $xml_content["infoFactura"]["importeTotal"];

    }

}

print_r($xml_data); exit;



