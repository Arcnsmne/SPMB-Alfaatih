<?php

namespace App\Http\Controllers\Keuangan;

use App\Http\Controllers\Controller;
use App\Models\Pendaftar;
use App\Models\PendaftarPembayaran;
use Carbon\Carbon;

class LaporanKeuanganController extends Controller
{
    public function index()
    {
        // Statistik bulanan (12 bulan terakhir)
        $monthlyData = [];
        for ($i = 11; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
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
            
            $monthlyData[] = [
                'month' => $date->format('M Y'),
                'revenue' => $revenue,
                'count' => Pendaftar::whereHas('pembayaran', function($query) {
                    $query->where('status', 'VERIFIED');
                })
                ->whereYear('tanggal_daftar', $date->year)
                ->whereMonth('tanggal_daftar', $date->month)
                ->count()
            ];
        }
        
        // Summary statistics
        $totalRevenue = PendaftarPembayaran::where('status', 'VERIFIED')->sum('jumlah');
        $totalTransactions = PendaftarPembayaran::where('status', 'VERIFIED')->count();
        $averageTransaction = $totalTransactions > 0 ? $totalRevenue / $totalTransactions : 0;
        
        // Status breakdown
        $statusBreakdown = [
            'verified' => PendaftarPembayaran::where('status', 'VERIFIED')->count(),
            'pending' => PendaftarPembayaran::where('status', 'PENDING')->count(),
            'rejected' => PendaftarPembayaran::where('status', 'REJECTED')->count()
        ];
        
        return view('keuangan.laporan.index', compact(
            'monthlyData',
            'totalRevenue',
            'totalTransactions',
            'averageTransaction',
            'statusBreakdown'
        ));
    }
}