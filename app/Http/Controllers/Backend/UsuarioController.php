<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Compra;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Dotenv\Parser\Value;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use function PHPUnit\Framework\assertSame;

class UsuarioController extends Controller
{
    public function dashboard()
    {
        return view('usuario.dashboard');
    }

    public function Layout()
    {
        return view('usuario.Layout');
    }

    public function factura()
    {
        return view('usuario.factura');
    }


    public function cargarCompra()
    {
        return view('usuario.cargarCompra');
    }

    public function compra()
    {
        $compras = DB::table('compra')->get();
        $compras = Compra::orderBy('id', 'desc')->paginate(5);
        return view('usuario.compra', ['compras' => $compras]);
    }

//private $disk = "public";

    /*public function compra(){
        $files = [];

            foreach(Storage::disk($this->disk)->files() as $file){
                $name = str_replace("$this->disk/","",$file);
                $picture = "";
                $type = Storage::disk($this->disk)->mimeType($name);
                if(strpos($type, "image")!==false){
                    $picture = asset(Storage::disk($this->disk)->url($name));
                }
                $downloadLink = route("download",$name);
                $files[] = [
                    "picture" => $picture,
                    "name" => $name,
                    "link" => $downloadLink,
                    "size" => Storage::disk($this->disk)->size($name)
                ];
            }

        return view('usuario/compra',["files"=>$files]);

    }*/

    /*public function storeFile(Request $req){

        if($req->isMethod('POST')){
            $file = $req->file('file');
            $name = $req->input('name');
            $file->storeAs('',$name.".".$file->extension(),$this->disk);
        }
        return $this->compra();
    }*/

    /*public function store(Request $request)
    {
        $compra = new compra;
        $compra->ruc_empresa              = $request->input('ruc_empresa');
        $compra->empresa                  = $request->input('empresa');
        $compra->claveAcceso              = $request->input('claveAcceso');
        $compra->numeroFactura            = $request->input('numeroFactura');
        $compra->fechaEmision             = $request->input('fechaEmision');
        $compra->razonSocialProveedor     = $request->input('razonSocialProveedor');
        $compra->nombreComercialProveedor = $request->input('nombreComercialProveedor');
        $compra->identificacionProveedor  = $request->input('identificacionProveedor');
        $compra->direccionMatrizProveedor = $request->input('direccionMatrizProveedor');
        $compra->direccionEstabProveedor  = $request->input('direccionEstabProveedor');
        $compra->totalSinImpuestos        = $request->input('totalSinImpuestos');
        $compra->totalDescuento           = $request->input('totalDescuento');
        $compra->valorICE                 = $request->input('valorICE');
        $compra->subTotalIva0             = $request->input('subTotalIva0');
        $compra->subTotalIva12            = $request->input('subTotalIva12');
        $compra->iva12                    = $request->input('iva12');
        $compra->propina                  = $request->input('propina');
        $compra->valorTotal               = $request->input('valorTotal');

        $compra->save();

        session()->flash('status', 'Compra Registrada');

        return to_route('usuario.compra');

    }*/


    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('usuario.compra');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
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

    /*      $request->validate([
            'ruc_empresa'              => ['required', 'string', 'max:255'],
            'empresa'                  => ['required', 'string', 'max:255'],
            'claveAcceso'              => ['required', 'string', 'max:255'],
            'numeroFactura'            => ['required', 'string', 'max:255'],
            'fechaEmision'             => ['required', 'string', 'max:255'],
            'razonSocialProveedor'     => ['required', 'string', 'max:255'],
            'nombreComercialProveedor' => ['required', 'string', 'max:255'],
            'identificacionProveedor'  => ['required', 'string', 'max:255'],
            'direccionMatrizProveedor' => ['required', 'string', 'max:255'],
            'direccionEstabProveedor'  => ['required', 'string', 'max:255'],
            'totalSinImpuestos'        => ['required', 'string', 'max:255'],
            'totalDescuento'           => ['required', 'string', 'max:255'],
            'valorICE'                 => ['required', 'string', 'max:255'],
            'subTotalIva0'             => ['required', 'string', 'max:255'],
            'subTotalIva12'            => ['required', 'string', 'max:255'],
            'iva12'                    => ['required', 'string', 'max:255'],
            'propina'                  => ['required', 'string', 'max:255'],
            'valorTotal'               => ['required', 'string', 'max:255'],
            ]);

            $compra = Compra::create([
                'ruc_empresa'              => $request->ruc_empresa,
                'empresa'                  => $request->empresa,
                'claveAcceso'              => $request->claveAcceso,
                'numeroFactura'            => $request->numeroFactura,
                'fechaEmision'             => $request->fechaEmision,
                'razonSocialProveedor'     => $request->razonSocialProveedor,
                'nombreComercialProveedor' => $request->nombreComercialProveedor,
                'identificacionProveedor'  => $request->identificacionProveedor,
                'direccionMatrizProveedor' => $request->direccionMatrizProveedor,
                'direccionEstabProveedor'  => $request->direccionEstabProveedor,
                'totalSinImpuestos'        => $request->totalSinImpuestos,
                'totalDescuento'           => $request->totalDescuento,
                'valorICE'                 => $request->valorICE,
                'subTotalIva0'             => $request->subTotalIva0,
                'subTotalIva12'            => $request->subTotalIva12,
                'iva12'                    => $request->iva12,
                'propina'                  => $request->propina,
                'valorTotal'               => $request->valorTotal,
            ]);

            event(new Registered($compra));



            return to_route('usuario.compra');
        }*/


}
