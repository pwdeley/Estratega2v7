<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VendedorController extends Controller
{
    public function dashboard() {
        return view('vendedor.dashboard');
    }
}
