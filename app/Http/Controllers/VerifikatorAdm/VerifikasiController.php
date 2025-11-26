<?php

namespace App\Http\Controllers\VerifikatorAdm;

use App\Http\Controllers\Controller;
use App\Models\Pendaftar;
use Illuminate\Http\Request;

class VerifikasiController extends Controller
{
    public function show($id)
    {
        $pendaftar = Pendaftar::with(['dataSiswa', 'jurusan', 'gelombang', 'berkas', 'dataOrtu', 'asalSekolah'])
            ->findOrFail($id);
        
        return view('verifikator_adm.verifikasi', compact('pendaftar'));
    }
    
    public function selesai(Request $request, $id)
    {
        $pendaftar = Pendaftar::findOrFail($id);
        $status = $request->input('status', 'ADM_PASS');
        
        $pendaftar->update([
            'status' => $status,
            'user_verifikasi_adm' => auth()->id(),
            'tgl_verifikasi_adm' => now()
        ]);
        
        $message = $status == 'ADM_PASS' ? 'Verifikasi berhasil disetujui' : 'Verifikasi berhasil ditolak';
        
        return redirect()->route('verifikator_adm.dashboard')->with('success', $message);
    }
}
