<?php

namespace App\Http\Controllers\VerifikatorAdm;

use App\Http\Controllers\Controller;
use App\Models\Pendaftar;
use App\Models\PendaftarBerkas;
use Illuminate\Http\Request;

class VerifikasiBerkasController extends Controller
{
    public function index()
    {
        $pendaftar = Pendaftar::with(['dataSiswa', 'jurusan', 'berkas'])
            ->where('status', 'ADM_PASS')
            ->whereHas('berkas')
            ->orderBy('tanggal_daftar', 'desc')
            ->get();
        
        return view('verifikator_adm.verifikasi_berkas.index', compact('pendaftar'));
    }
    
    public function show($id)
    {
        $pendaftar = Pendaftar::with(['dataSiswa', 'jurusan', 'berkas'])->findOrFail($id);
        return view('verifikator_adm.verifikasi_berkas.show', compact('pendaftar'));
    }
    
    public function preview($id)
    {
        $pendaftar = Pendaftar::with('berkas')->findOrFail($id);
        return response()->json([
            'berkas' => $pendaftar->berkas->map(function($berkas) {
                return [
                    'jenis' => $berkas->jenis,
                    'file_path' => $berkas->file_path
                ];
            })
        ]);
    }
    
    public function verifikasi(Request $request, $id)
    {
        $pendaftar = Pendaftar::with('berkas')->findOrFail($id);
        $status = $request->input('status');
        
        foreach ($pendaftar->berkas as $berkas) {
            $berkas->valid = ($status == 'APPROVED') ? 1 : 0;
            $berkas->catatan = $request->input('catatan');
            $berkas->save();
        }
        
        // Update pendaftar status based on document verification
        if ($status == 'APPROVED') {
            $pendaftar->update([
                'status' => 'DOC_PASS',
                'user_verifikasi_berkas' => auth()->id(),
                'tgl_verifikasi_berkas' => now()
            ]);
        } else {
            $pendaftar->update([
                'status' => 'DOC_FAIL',
                'user_verifikasi_berkas' => auth()->id(),
                'tgl_verifikasi_berkas' => now()
            ]);
        }
        
        return response()->json(['success' => true]);
    }
}
