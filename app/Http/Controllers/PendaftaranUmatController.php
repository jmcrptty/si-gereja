<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PendaftaranUmatController extends Controller
{
    public function index() {
        return view('layouts.pendaftaranumat');
    }
}
