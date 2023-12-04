<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Compra;
use App\Models\Factura;
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

    public function compra()
    {
        return view('usuario.compra');
    }
}
