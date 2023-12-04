<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Compra;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;


class CompraController extends Controller
{

    public function compra()
    {
        $compras = DB::table('compra')->get();
        $compras = Compra::orderBy('id', 'desc')->paginate(5);
        return view('usuario.compra', ['compras' => $compras]);
    }

    public function store(Request $request): RedirectResponse
    {

        $compra = new Compra();

        $compra->ruc_empresa              = $request->ruc_empresa;
        $compra->empresa                  = $request->empresa;
        $compra->claveAcceso              = $request->claveAcceso;
        $compra->numeroFactura            = $request->numeroFactura;
        $compra->fechaEmision             = $request->fechaEmision;
        $compra->razonSocialProveedor     = $request->razonSocialProveedor;
        $compra->nombreComercialProveedor = $request->nombreComercialProveedor;
        $compra->identificacionProveedor  = $request->identificacionProveedor;
        $compra->direccionMatrizProveedor = $request->direccionMatrizProveedor;
        $compra->direccionEstabProveedor  = $request->direccionEstabProveedor;
        $compra->totalSinImpuestos        = $request->totalSinImpuestos;
        $compra->totalDescuento           = $request->totalDescuento;
        $compra->valorICE                 = $request->valorICE;
        $compra->subTotalIva0             = $request->subTotalIva0;
        $compra->subTotalIva12            = $request->subTotalIva12;
        $compra->iva12                    = $request->iva12;
        $compra->propina                  = $request->propina;
        $compra->valorTotal               = $request->valorTotal;


        $compra->save();

        return redirect()->route('compra.store', $compra);

    }

}
