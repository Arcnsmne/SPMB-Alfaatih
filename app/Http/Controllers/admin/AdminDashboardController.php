<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pendaftar;
use App\Models\Gelombang;
use App\Models\Jurusan;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Total pendaftar
        $totalPendaftar = Pendaftar::count();
        
        // Terverifikasi (status = 'terverifikasi')
        $terverifikasi = Pendaftar::where('status', 'terverifikasi')->count();
        
        // Sudah terbayar (ada pembayaran)
        $terbayar = Pendaftar::whereHas('pembayaran')->count();
        
        // Data per gelombang
        $dataGelombang = Gelombang::withCount([
            'pendaftar as total_pendaftar',
            'pendaftar as terverifikasi' => function($query) {
                $query->where('status', 'terverifikasi');
            }
        ])->get();
        
        // Data per jurusan untuk chart
        $dataJurusan = Jurusan::withCount([
            'pendaftar as total_pendaftar',
            'pendaftar as terverifikasi' => function($query) {
                $query->where('status', 'terverifikasi');
            }
        ])->get();
        
        return view('admin.dashboard', compact(
            'totalPendaftar', 
            'terverifikasi', 
            'terbayar', 
            'dataGelombang', 
            'dataJurusan'
        ));
    }
}
