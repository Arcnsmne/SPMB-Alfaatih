<?php

namespace App\Http\Controllers\VerifikatorAdm;

use App\Http\Controllers\Controller;
use App\Models\Pendaftar;

class VerifikatorAdmDashboardController extends Controller
{
    public function index()
    {
        $totalBerkas = Pendaftar::count();
        $menungguVerifikasi = Pendaftar::whereIn('status', ['SUBMIT', '0'])->count();
        $terverifikasi = Pendaftar::where('status', 'ADM_PASS')->count();
        $ditolak = Pendaftar::where('status', 'ADM_REJECT')->count();
        
        $pendaftaranMenunggu = Pendaftar::whereIn('status', ['SUBMIT', '0'])
            ->with(['dataSiswa', 'jurusan', 'berkas'])
            ->orderBy('tanggal_daftar', 'desc')
            ->limit(5)
            ->get();
        
        return view('verifikator_adm.dashboard', compact(
            'totalBerkas',
            'menungguVerifikasi',
            'terverifikasi',
            'ditolak',
            'pendaftaranMenunggu'
        ));
    }
}
