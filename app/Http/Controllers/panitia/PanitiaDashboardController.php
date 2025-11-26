<?php

namespace App\Http\Controllers\Panitia;

use App\Http\Controllers\Controller;

class PanitiaDashboardController extends Controller
{
    public function index()
    {
        return view('panitia.dashboard');
    }
}
