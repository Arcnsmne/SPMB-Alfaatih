<?php

namespace App\Http\Controllers\Keuangan;

use App\Http\Controllers\Controller;
use App\Models\Pendaftar;
use App\Models\PendaftarPembayaran;
use Illuminate\Http\Request;


class VerifikasiPembayaranController extends Controller
{
    public function index()
    {
        // Ambil semua pendaftar yang memiliki data pembayaran
        $pendaftar = Pendaftar::with(['dataSiswa', 'jurusan', 'gelombang', 'pembayaran'])
            ->whereHas('pembayaran')
            ->orderBy('tanggal_daftar', 'desc')
            ->get();

        return view('keuangan.verifikasi.index', compact('pendaftar'));
    }

    public function show($id)
    {
        $pendaftar = Pendaftar::with(['dataSiswa', 'jurusan', 'gelombang', 'pembayaran'])
            ->findOrFail($id);
        
        return view('keuangan.verifikasi.show', compact('pendaftar'));
    }
    
    public function verifikasi(Request $request, $id)
    {
        $pendaftar = Pendaftar::with('pembayaran')->findOrFail($id);
        $status = $request->input('status', 'VERIFIED');
        
        // Update status pembayaran
        if ($pendaftar->pembayaran) {
            $pendaftar->pembayaran->update([
                'status' => $status
            ]);
        }
        
        // Update data verifikasi dan status pendaftar
        $pendaftar->update([
            'user_verifikasi_payment' => auth()->user()->nama ?? auth()->user()->name,
            'tgl_verifikasi_payment' => now(),
            'status' => $status == 'VERIFIED' ? 'PAID' : $pendaftar->status
        ]);
        
        $message = $status == 'VERIFIED' ? 'Pembayaran berhasil disetujui' : 'Pembayaran berhasil ditolak';
        
        return redirect()->route('keuangan.verifikasi_pembayaran')->with('success', $message);
    }
}