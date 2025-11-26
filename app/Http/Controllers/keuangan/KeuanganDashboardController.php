<?php

namespace App\Http\Controllers\Keuangan;

use App\Http\Controllers\Controller;
use App\Models\Pendaftar;
use App\Models\PendaftarPembayaran;
use Carbon\Carbon;

class KeuanganDashboardController extends Controller
{
    public function index()
    {
        // Statistik pembayaran
        $totalPendapatan = PendaftarPembayaran::where('status', 'VERIFIED')->sum('jumlah');
            
        $menungguVerifikasi = PendaftarPembayaran::where('status', 'PENDING')->count();
        $pembayaranLunas = PendaftarPembayaran::where('status', 'VERIFIED')->count();
        $pembayaranTertunggak = Pendaftar::where('status', 'ADM_PASS')
            ->whereDoesntHave('pembayaran')
            ->count();
            
        // Pembayaran yang perlu verifikasi (5 terbaru)
        $pendingPayments = Pendaftar::with(['dataSiswa', 'jurusan', 'pembayaran'])
            ->whereHas('pembayaran', function($query) {
                $query->where('status', 'PENDING');
            })
            ->orderBy('tanggal_daftar', 'desc')
            ->take(5)
            ->get();
            
        // Pembayaran terbaru (10 terbaru)
        $recentPayments = Pendaftar::with(['dataSiswa', 'jurusan', 'pembayaran'])
            ->whereHas('pembayaran')
            ->orderBy('tanggal_daftar', 'desc')
            ->take(10)
            ->get();
            
        // Data chart 6 bulan terakhir
        $chartData = [];
        $chartLabels = [];
        
        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $monthName = $date->format('M Y');
            
            $revenue = Pendaftar::whereHas('pembayaran', function($query) {
                $query->where('status', 'VERIFIED');
            })
            ->whereYear('tanggal_daftar', $date->year)
            ->whereMonth('tanggal_daftar', $date->month)
            ->with('pembayaran')
            ->get()
            ->sum(function($pendaftar) {
                return $pendaftar->pembayaran ? $pendaftar->pembayaran->jumlah : 0;
            });
            
            $chartLabels[] = $monthName;
            $chartData[] = $revenue;
        }
        
        return view('keuangan.dashboard', compact(
            'totalPendapatan',
            'menungguVerifikasi', 
            'pembayaranLunas',
            'pembayaranTertunggak',
            'pendingPayments',
            'recentPayments',
            'chartData',
            'chartLabels'
        ));
    }
}
