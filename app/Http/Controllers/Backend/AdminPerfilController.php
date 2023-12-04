<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminPerfilController extends Controller
{
    public function index() {
        return view('admin.perfil.index');
    }

    public function updatePerfil(Request $request) {
        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        
        return redirect()->back();
    }
}
