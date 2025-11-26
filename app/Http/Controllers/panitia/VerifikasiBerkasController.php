<?php

namespace App\Http\Controllers\Panitia;

use App\Http\Controllers\Controller;
use App\Models\Pendaftar;
use App\Models\PendaftarBerkas;
use App\Models\PendaftarDataSiswa;
use Illuminate\Http\Request;

class VerifikasiBerkasController extends Controller
{
    public function index()
    {
        $pendaftar = Pendaftar::with(['dataSiswa', 'berkas'])
            ->whereIn('status', ['SUBMIT', '0'])
            ->get();
        return view('panitia.verifikasi_berkas.index', compact('pendaftar'));
    }
    
    public function show($id)
    {
        $pendaftar = Pendaftar::findOrFail($id);
        $dataSiswa = PendaftarDataSiswa::where('pendaftar_id', $id)->first();
        $berkas = PendaftarBerkas::where('pendaftar_id', $id)->get();
        
        return view('panitia.verifikasi_berkas.detail', compact('pendaftar', 'dataSiswa', 'berkas'));
    }
    
    public function verify(Request $request, $id)
    {
        $berkas = PendaftarBerkas::findOrFail($id);
        
        $berkas->update([
            'valid' => $request->status,
            'catatan' => $request->catatan
        ]);
        
        return redirect()->back()->with('success', 'Status berkas berhasil diupdate');
    }
    
    public function complete($id)
    {
        $pendaftar = Pendaftar::findOrFail($id);
        $berkas = PendaftarBerkas::where('pendaftar_id', $id)->get();
        
        $allValid = $berkas->every(function($b) {
            return $b->valid == 1;
        });
        
        if ($allValid && $berkas->count() > 0) {
            $pendaftar->status = 'ADM_PASS';
            $pendaftar->user_verifikasi_adm = auth()->user()->name;
            $pendaftar->tgl_verifikasi_adm = now();
            $pendaftar->save();
            
            return redirect()->route('verifikasi.berkas.index')->with('success', 'Verifikasi berkas selesai. Status diubah menjadi ADM_PASS');
        }
        
        return redirect()->back()->with('error', 'Semua berkas harus valid untuk menyelesaikan verifikasi');
    }
    
    public function reject($id)
    {
        $pendaftar = Pendaftar::findOrFail($id);
        
        $pendaftar->status = 'ADM_REJECT';
        $pendaftar->user_verifikasi_adm = auth()->user()->name;
        $pendaftar->tgl_verifikasi_adm = now();
        $pendaftar->save();
        
        return redirect()->route('verifikasi.berkas.index')->with('success', 'Pendaftar ditolak. Status diubah menjadi ADM_REJECT');
    }
}
