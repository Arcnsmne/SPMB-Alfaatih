<?php

namespace App\Http\Controllers\VerifikatorAdm;

use App\Http\Controllers\Controller;
use App\Models\Pendaftar;

class DataVerifikasiController extends Controller
{
    public function index()
    {
        $pendaftaran = Pendaftar::with(['dataSiswa', 'jurusan', 'gelombang'])
            ->orderBy('tanggal_daftar', 'desc')
            ->get();
        
        return view('verifikator_adm.data_verifikasi', compact('pendaftaran'));
    }
}
