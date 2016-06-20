<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class MisCommodityBrandController extends Controller
{
    public function index()
    {
        return view('mis.commodity.brand');
    }
}
