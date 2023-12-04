<?php

namespace App\Models;

use http\Env\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Http\Controllers\Backend\FacturaController;


class Factura extends Model
{
  //  use HasFactory;

    protected $table = "factura";


}


