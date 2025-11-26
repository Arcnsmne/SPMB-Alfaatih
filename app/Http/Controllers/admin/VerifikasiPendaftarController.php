<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pendaftar;
use Illuminate\Http\Request;

class VerifikasiPendaftarController extends Controller
{
    public function index()
    {
        $pendaftar = Pendaftar::with(['dataSiswa', 'berkas', 'pembayaran', 'jurusan'])
                             ->whereNotNull('user_id')
                             ->orderBy('tanggal_daftar', 'desc')
                             ->get();
        
        return view('admin.verifikasi.index', compact('pendaftar'));
    }
    
    public function show($id)
    {
        $pendaftar = Pendaftar::with(['dataSiswa', 'dataOrtu', 'asalSekolah', 'berkas', 'pembayaran', 'jurusan'])
                             ->findOrFail($id);
        
        return view('admin.verifikasi.show', compact('pendaftar'));
    }
    
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:selesai,ditolak',
            'catatan' => 'nullable|string'
        ]);
        
        $pendaftar = Pendaftar::findOrFail($id);
        
        $pendaftar->update([
            'status' => $request->status,
            'tgl_verifikasi_adm' => now(),
            'user_verifikasi_adm' => auth()->id()
        ]);
        
        return back()->with('success', 'Status pendaftar berhasil diupdate');
    }
}