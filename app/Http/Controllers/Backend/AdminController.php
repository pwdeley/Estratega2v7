<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard() {
        $usuarios = DB::table ('users')->get();
        
        return view('admin.dashboard', ['users'=>$usuarios]);
    }

        
}
