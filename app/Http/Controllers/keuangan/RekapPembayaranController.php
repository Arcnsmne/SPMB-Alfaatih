<?php

namespace App\Http\Controllers\Keuangan;

use App\Http\Controllers\Controller;
use App\Models\Pendaftar;
use App\Models\PendaftarPembayaran;
use Carbon\Carbon;

class RekapPembayaranController extends Controller
{
    public function index()
    {
        // Statistik pembayaran
        $totalPendapatan = PendaftarPembayaran::where('status', 'VERIFIED')->sum('jumlah');
        $totalPembayaran = PendaftarPembayaran::count();
        $pembayaranVerified = PendaftarPembayaran::where('status', 'VERIFIED')->count();
        $pembayaranPending = PendaftarPembayaran::where('status', 'PENDING')->count();
        $pembayaranRejected = PendaftarPembayaran::where('status', 'REJECTED')->count();
        
        // Rekap per jurusan
        $rekapJurusan = Pendaftar::with(['jurusan', 'pembayaran'])
            ->whereHas('pembayaran', function($query) {
                $query->where('status', 'VERIFIED');
            })
            ->get()
            ->groupBy('jurusan.nama')
            ->map(function($group) {
                return [
                    'jumlah' => $group->count(),
                    'total' => $group->sum(function($item) {
                        return $item->pembayaran ? $item->pembayaran->jumlah : 0;
                    })
                ];
            });
            
        // Semua pembayaran
        $pembayaran = Pendaftar::with(['dataSiswa', 'jurusan', 'pembayaran'])
            ->whereHas('pembayaran')
            ->orderBy('tanggal_daftar', 'desc')
            ->get();
        
        return view('keuangan.rekap.index', compact(
            'totalPendapatan',
            'totalPembayaran',
            'pembayaranVerified',
            'pembayaranPending', 
            'pembayaranRejected',
            'rekapJurusan',
            'pembayaran'
        ));
    }
}