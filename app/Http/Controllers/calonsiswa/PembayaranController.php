<?php

namespace App\Http\Controllers\CalonSiswa;

use App\Http\Controllers\Controller;
use App\Models\Pendaftar;
use App\Models\PendaftarPembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PembayaranController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $pendaftar = Pendaftar::with(['pembayaran', 'berkas', 'gelombang', 'jurusan', 'dataSiswa'])->where('user_id', $user->id)->first();
        
        if (!$pendaftar || !$pendaftar->berkas || $pendaftar->berkas->count() == 0) {
            return redirect('/upload')->with('error', 'Silakan upload berkas terlebih dahulu');
        }
        
        // Jika sudah bayar, tampilkan status
        if ($pendaftar->pembayaran) {
            $message = match($pendaftar->pembayaran->status) {
                'VERIFIED' => 'Pembayaran telah diverifikasi dan diterima',
                'REJECTED' => 'Pembayaran ditolak, silakan hubungi bagian keuangan',
                default => 'Pembayaran sedang diverifikasi'
            };
            return view('calon_siswa.waiting_verification', [
                'title' => 'Status Pembayaran',
                'message' => $message,
                'status' => $pendaftar->pembayaran->status
            ]);
        }
        
        // Ambil biaya dari gelombang
        $biayaDaftar = $pendaftar->gelombang ? $pendaftar->gelombang->biaya_daftar : 0;
        
        return view('calon_siswa.pembayaran.index', compact('pendaftar', 'biayaDaftar'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'jumlah' => 'required|numeric|min:1',
            'metode' => 'required|in:QRIS,TRANSFER_BANK',
            'bukti' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'catatan' => 'nullable|string'
        ]);
        
        $user = Auth::user();
        $pendaftar = Pendaftar::where('user_id', $user->id)->first();
        
        if (!$pendaftar) {
            return back()->with('error', 'Data pendaftar tidak ditemukan');
        }
        
        $file = $request->file('bukti');
        $filename = time() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('pembayaran', $filename, 'public');
        
        // Ambil biaya dari gelombang
        $biayaDaftar = $pendaftar->gelombang ? $pendaftar->gelombang->biaya_daftar : 0;
        
        PendaftarPembayaran::updateOrCreate(
            ['pendaftar_id' => $pendaftar->id],
            [
                'jumlah' => $biayaDaftar, // Gunakan biaya dari gelombang
                'metode' => $request->metode,
                'bukti' => $path,
                'catatan' => $request->catatan,
                'status' => 'PENDING'
            ]
        );
        

        
        return back()->with('success', 'Bukti pembayaran berhasil diupload');
    }
}