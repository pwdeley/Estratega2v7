<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\UsuarioController;
use App\Http\Controllers\Backend\VendedorController;
use App\Http\Controllers\Backend\AdminPerfilController;
use App\Http\Controllers\Backend\CompraController;
use App\Http\Controllers\Backend\FacturaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/nosotros', function () {
    return view('nosotros');
});

Route::get('/servicios', function () {
    return view('servicios');
});

Route::get('/contacto', function () {
    return view('contacto');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware(['auth', 'rol:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/perfil', [AdminPerfilController::class, 'index'])->name('admin.perfil');
    Route::post('/admin/perfil/update', [AdminPerfilController::class, 'updatePerfil'])->name('admin.perfil.update');

});

Route::middleware(['auth', 'rol:vendedor'])->group(function () {
    Route::get('/vendedor/dashboard', [VendedorController::class, 'dashboard'])->name('vendedor.dashboard');
});

Route::middleware(['auth', 'rol:usuario'])->group(function () {
    Route::get('/usuario/dashboard', [UsuarioController::class, 'dashboard'])->name('usuario.dashboard');
    Route::get('/usuario/Layout', [UsuarioController::class, 'Layout'])->name('usuario.Layout');
    //Rutas protegidas de ventas:
    Route::get('/usuario/factura', [FacturaController::class, 'factura'])->name('usuario.factura');
    Route::post('/usuario/factura', [FacturaController::class, 'store'])->name('factura.store');


    //Rutas protegidas de compras:
    Route::get('/usuario/compra', [CompraController::class, 'compra'])->name('usuario.compra');
    Route::get('/usuario/compra-nueva', [CompraController::class, 'cargarCompra'])->name('usuario.compra-nueva');
    Route::get('/usuario/compra',[CompraController::class,'compra']);
    Route::post('/usuario/compra',[CompraController::class,'store'])->name('compra.store');
    Route::get('/usuario/compra/descargar/{name}',[CompraController::class,'downloadFile'])->name('download');
});
