<?php

namespace App\Http\Controllers\calonsiswa;

use App\Http\Controllers\Controller;
use App\Models\Pendaftar;
use App\Models\Gelombang;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CalonSiswaDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Cari data pendaftar berdasarkan user_id
        $pendaftar = Pendaftar::with(['dataSiswa', 'berkas', 'pembayaran', 'gelombang', 'jurusan'])
                              ->where('user_id', $user->id)
                              ->first();
        
        // Hitung progres berdasarkan data yang ada
        $progress = $this->calculateProgress($pendaftar);
        
        // Ambil gelombang aktif
        $gelombangAktif = Gelombang::where('tgl_mulai', '<=', Carbon::now())
                                  ->where('tgl_selesai', '>=', Carbon::now())
                                  ->first();
        
        // Hitung sisa hari pendaftaran
        $sisaHari = $gelombangAktif ? Carbon::now()->diffInDays($gelombangAktif->tgl_selesai, false) : 0;
        
        return view('calon_siswa.dashboard', compact('pendaftar', 'progress', 'gelombangAktif', 'sisaHari'));
    }
    
    public function getVerificationStatus($pendaftar)
    {
        if (!$pendaftar) return 'Belum Mendaftar';
        
        $hasFormulir = $pendaftar->dataSiswa ? true : false;
        $hasBerkas = $pendaftar->berkas->count() > 0;
        $hasPembayaran = $pendaftar->pembayaran ? true : false;
        
        if ($hasPembayaran && $hasBerkas && $hasFormulir) {
            return $pendaftar->status == 'terverifikasi' ? 'Terverifikasi' : 'Menunggu Verifikasi';
        } elseif ($hasPembayaran) {
            return 'Pembayaran Disubmit';
        } elseif ($hasBerkas) {
            return 'Berkas Disubmit';
        } elseif ($hasFormulir) {
            return 'Formulir Disubmit';
        }
        
        return 'Belum Lengkap';
    }
    
    private function calculateProgress($pendaftar)
    {
        $steps = [
            'registrasi' => [
                'completed' => true,
                'date' => $pendaftar ? $pendaftar->tanggal_daftar : null,
                'title' => 'Registrasi Akun',
                'description' => 'Membuat akun calon siswa'
            ],
            'formulir' => [
                'completed' => $pendaftar && $pendaftar->dataSiswa ? true : false,
                'date' => $pendaftar && $pendaftar->dataSiswa ? $pendaftar->tanggal_daftar : null,
                'title' => 'Pengisian Formulir',
                'description' => 'Mengisi biodata lengkap'
            ],
            'berkas' => [
                'completed' => $pendaftar && $pendaftar->berkas && $pendaftar->berkas->count() > 0,
                'date' => $pendaftar && $pendaftar->berkas && $pendaftar->berkas->count() > 0 ? $pendaftar->berkas->first()->created_at ?? $pendaftar->tanggal_daftar : null,
                'title' => 'Upload Berkas',
                'description' => 'Mengunggah dokumen persyaratan'
            ],
            'pembayaran' => [
                'completed' => $pendaftar && $pendaftar->pembayaran ? true : false,
                'date' => $pendaftar && $pendaftar->pembayaran ? $pendaftar->pembayaran->created_at ?? $pendaftar->tanggal_daftar : null,
                'title' => 'Pembayaran',
                'description' => 'Upload bukti pembayaran'
            ],
            'verifikasi_data' => [
                'completed' => $pendaftar && $pendaftar->status == 'ADM_PASS',
                'date' => $pendaftar && $pendaftar->status == 'ADM_PASS' ? $pendaftar->tgl_verifikasi_adm : null,
                'title' => 'Verifikasi Data',
                'description' => 'Verifikasi data formulir oleh admin'
            ],
            'verifikasi_berkas' => [
                'completed' => $pendaftar && $pendaftar->status == 'ADM_PASS',
                'date' => $pendaftar && $pendaftar->status == 'ADM_PASS' ? $pendaftar->tgl_verifikasi_adm : null,
                'title' => 'Verifikasi Berkas',
                'description' => 'Verifikasi dokumen oleh admin'
            ],
            'verifikasi_pembayaran' => [
                'completed' => $pendaftar && $pendaftar->pembayaran && $pendaftar->pembayaran->status == 'VERIFIED',
                'date' => $pendaftar ? $pendaftar->tgl_verifikasi_payment : null,
                'title' => 'Verifikasi Pembayaran',
                'description' => 'Verifikasi pembayaran oleh bagian keuangan'
            ]
        ];
        
        $completed = array_sum(array_column($steps, 'completed'));
        $total = count($steps);
        
        return [
            'steps' => $steps,
            'completed' => $completed,
            'total' => $total,
            'percentage' => round(($completed / $total) * 100)
        ];
    }
}
