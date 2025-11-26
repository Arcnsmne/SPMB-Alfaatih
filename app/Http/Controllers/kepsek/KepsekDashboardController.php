<?php

namespace App\Http\Controllers\Kepsek;

use App\Http\Controllers\Controller;

class KepsekDashboardController extends Controller
{
    public function index()
    {
        return view('kepala_sekolah.dashboard');
    }
}
