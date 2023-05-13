<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VendorTandaTangan extends Controller
{
    public function index()
    {
        return view('vendor.tandatangan');
    }
}
