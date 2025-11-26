<?php

namespace App\Http\Controllers\Kepsek;

use App\Http\Controllers\Controller;
use App\Models\Pendaftar;
use App\Models\PendaftarDataSiswa;
use App\Models\PendaftarAsalSekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KepsekController extends Controller
{
    public function index()
    {
        // KPI: Pendaftar vs Kuota
        $totalPendaftar = Pendaftar::count();
        $kuotaTotal = 200; // Bisa diambil dari tabel kuota
        $persentaseKuota = $kuotaTotal > 0 ? round(($totalPendaftar / $kuotaTotal) * 100, 1) : 0;
        
        // KPI: Rasio Terverifikasi
        $terverifikasi = Pendaftar::where('status', 'ADM_PASS')->count();
        $rasioVerifikasi = $totalPendaftar > 0 ? round(($terverifikasi / $totalPendaftar) * 100, 1) : 0;
        
        // Total Pembayaran
        $totalPembayaran = DB::table('pendaftar_pembayaran')
            ->where('status', 'VERIFIED')
            ->sum('jumlah');
            
        // Jumlah Sekolah Asal
        $jumlahSekolah = DB::table('pendaftar_asal_sekolah')
            ->distinct('nama_sekolah')
            ->count();
            
        // Tren Harian (7 hari terakhir)
        $trenHarian = [];
        for ($i = 6; $i >= 0; $i--) {
            $tanggal = now()->subDays($i)->format('Y-m-d');
            $jumlah = Pendaftar::whereDate('tanggal_daftar', $tanggal)->count();
            $trenHarian[] = [
                'tanggal' => now()->subDays($i)->format('d/m'),
                'jumlah' => $jumlah
            ];
        }
        
        // Status Distribution
        $statusDistribution = [
            'selesai' => Pendaftar::where('status', 'ADM_PASS')
                ->whereHas('pembayaran', function($q) {
                    $q->where('status', 'VERIFIED');
                })->count(),
            'proses' => Pendaftar::where('status', 'ADM_PASS')
                ->whereDoesntHave('pembayaran', function($q) {
                    $q->where('status', 'VERIFIED');
                })->count(),
            'belum' => Pendaftar::whereIn('status', ['PENDING', 'ADM_REJECT'])
                ->orWhereNull('status')
                ->count()
        ];
        
        // Recent registrants
        $pendaftarTerbaru = Pendaftar::with(['dataSiswa', 'asalSekolah'])
            ->orderBy('tanggal_daftar', 'desc')
            ->take(4)
            ->get();
            
        // Recent payments
        $pembayaranTerbaru = Pendaftar::with(['dataSiswa', 'pembayaran'])
            ->whereHas('pembayaran')
            ->orderBy('tanggal_daftar', 'desc')
            ->take(4)
            ->get();
        
        return view('kepala_sekolah.dashboard', compact(
            'totalPendaftar',
            'kuotaTotal', 
            'persentaseKuota',
            'terverifikasi',
            'rasioVerifikasi',
            'totalPembayaran',
            'jumlahSekolah',
            'trenHarian',
            'statusDistribution',
            'pendaftarTerbaru',
            'pembayaranTerbaru'
        ));
    }
    public function calonSiswa()
    {
        // Data per jurusan
        $dataJurusan = DB::table('jurusan as j')
            ->leftJoin('pendaftar as p', 'j.id', '=', 'p.jurusan_id')
            ->select(
                'j.nama as jurusan',
                'j.kuota',
                DB::raw('COUNT(p.id) as pendaftar'),
                DB::raw('ROUND((COUNT(p.id) / j.kuota) * 100, 1) as persentase')
            )
            ->groupBy('j.id', 'j.nama', 'j.kuota')
            ->get();
            
        // Summary
        $totalKuota = DB::table('jurusan')->sum('kuota');
        $totalPendaftar = Pendaftar::count();
        $persentaseTotal = $totalKuota > 0 ? round(($totalPendaftar / $totalKuota) * 100, 1) : 0;
        
        return view('kepala_sekolah.calon_siswa.index', compact(
            'dataJurusan',
            'totalKuota', 
            'totalPendaftar',
            'persentaseTotal'
        ));
    }
    
    public function calonSiswaSelesai()
    {
        $pendaftar = Pendaftar::with(['dataSiswa', 'jurusan', 'gelombang', 'pembayaran'])
            ->where('status', 'PAID')
            ->orderBy('tanggal_daftar', 'desc')
            ->get();
            
        return view('kepala_sekolah.calon_siswa.selesai', compact('pendaftar'));
    }
    
    public function daftarPembayaran()
    {
        $pembayaran = Pendaftar::with(['dataSiswa', 'jurusan', 'pembayaran'])
            ->whereHas('pembayaran')
            ->orderBy('tanggal_daftar', 'desc')
            ->get();
            
        return view('kepala_sekolah.pembayaran.index', compact('pembayaran'));
    }
    
    public function rekapPembayaran()
    {
        $rekap = DB::table('pendaftar_pembayaran as pp')
            ->join('pendaftar as p', 'pp.pendaftar_id', '=', 'p.id')
            ->join('jurusan as j', 'p.jurusan_id', '=', 'j.id')
            ->select(
                'j.nama as jurusan',
                DB::raw('COUNT(*) as total_pendaftar'),
                DB::raw('SUM(CASE WHEN pp.status = "VERIFIED" THEN 1 ELSE 0 END) as verified'),
                DB::raw('SUM(CASE WHEN pp.status = "PENDING" THEN 1 ELSE 0 END) as pending'),
                DB::raw('SUM(CASE WHEN pp.status = "REJECTED" THEN 1 ELSE 0 END) as rejected'),
                DB::raw('SUM(CASE WHEN pp.status = "VERIFIED" THEN pp.jumlah ELSE 0 END) as total_verified')
            )
            ->groupBy('j.id', 'j.nama')
            ->get();
            
        return view('kepala_sekolah.pembayaran.rekap', compact('rekap'));
    }
    
    public function asalSekolah()
    {
        $asalSekolah = DB::table('pendaftar_asal_sekolah as pas')
            ->join('pendaftar as p', 'pas.pendaftar_id', '=', 'p.id')
            ->select(
                'pas.nama_sekolah',
                'pas.kabupaten',
                DB::raw('COUNT(*) as jumlah_pendaftar')
            )
            ->groupBy('pas.nama_sekolah', 'pas.kabupaten')
            ->orderBy('jumlah_pendaftar', 'desc')
            ->get();
            
        return view('kepala_sekolah.asal_sekolah.index', compact('asalSekolah'));
    }
    
    public function asalWilayah()
    {
        $asalWilayah = DB::table('pendaftar_data_siswa as pds')
            ->join('pendaftar as p', 'pds.pendaftar_id', '=', 'p.id')
            ->join('wilayah as w', 'pds.wilayah_id', '=', 'w.id')
            ->select(
                'w.provinsi',
                'w.kabupaten',
                DB::raw('COUNT(*) as jumlah_pendaftar')
            )
            ->groupBy('w.provinsi', 'w.kabupaten')
            ->orderBy('jumlah_pendaftar', 'desc')
            ->get();
            
        return view('kepala_sekolah.asal_wilayah.index', compact('asalWilayah'));
    }
}