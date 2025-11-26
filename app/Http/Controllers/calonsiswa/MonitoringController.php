<?php

namespace App\Http\Controllers\calonsiswa;

use App\Http\Controllers\Controller;
use App\Models\Pendaftar;
use Carbon\Carbon;

class MonitoringController extends Controller
{
    public function index()
    {
        $pendaftar = Pendaftar::with(['dataSiswa', 'berkas', 'pembayaran', 'gelombang', 'jurusan'])
                              ->where('user_id', auth()->id())
                              ->first();
        
        if (!$pendaftar) {
            return redirect()->route('calon_siswa.formulir.simple')
                           ->with('error', 'Silakan isi formulir pendaftaran terlebih dahulu');
        }
        
        $progress = $this->calculateDetailedProgress($pendaftar);
        
        return view('calon_siswa.monitoring.index', compact('pendaftar', 'progress'));
    }
    
    private function calculateDetailedProgress($pendaftar)
    {
        $steps = [
            'registrasi' => [
                'completed' => true,
                'date' => $pendaftar->tanggal_daftar,
                'title' => 'Registrasi Akun',
                'description' => 'Membuat akun calon siswa'
            ],
            'formulir' => [
                'completed' => $pendaftar->dataSiswa ? true : false,
                'date' => $pendaftar->dataSiswa ? $pendaftar->tanggal_daftar : null,
                'title' => 'Pengisian Formulir',
                'description' => 'Mengisi biodata lengkap'
            ],
            'berkas' => [
                'completed' => $pendaftar->berkas->count() > 0,
                'date' => $pendaftar->berkas->count() > 0 ? $pendaftar->berkas->first()->created_at ?? $pendaftar->tanggal_daftar : null,
                'title' => 'Upload Berkas',
                'description' => 'Mengunggah dokumen persyaratan'
            ],
            'pembayaran' => [
                'completed' => $pendaftar->pembayaran ? true : false,
                'date' => $pendaftar->pembayaran ? $pendaftar->pembayaran->created_at ?? $pendaftar->tanggal_daftar : null,
                'title' => 'Pembayaran',
                'description' => 'Upload bukti pembayaran'
            ],
            'verifikasi_data' => [
                'completed' => in_array($pendaftar->status, ['ADM_PASS', 'DOC_PASS', 'DOC_FAIL']),
                'date' => $pendaftar->tgl_verifikasi_adm,
                'title' => 'Verifikasi Data',
                'description' => 'Verifikasi data formulir oleh verifikator'
            ],
            'verifikasi_berkas' => [
                'completed' => in_array($pendaftar->status, ['DOC_PASS', 'DOC_FAIL']),
                'date' => $pendaftar->tgl_verifikasi_berkas,
                'title' => 'Verifikasi Berkas',
                'description' => 'Verifikasi dokumen oleh verifikator'
            ],
            'verifikasi_pembayaran' => [
                'completed' => $pendaftar->pembayaran && $pendaftar->pembayaran->status == 'VERIFIED',
                'date' => $pendaftar->tgl_verifikasi_payment,
                'title' => 'Verifikasi Pembayaran',
                'description' => 'Verifikasi pembayaran oleh bagian keuangan'
            ]
        ];
        
        $berkasStatus = [];
        foreach ($pendaftar->berkas as $berkas) {
            $berkasStatus[] = [
                'jenis' => $berkas->jenis,
                'nama_file' => $berkas->nama_file,
                'valid' => $berkas->valid,
                'catatan' => $berkas->catatan
            ];
        }
        
        return [
            'steps' => $steps,
            'berkas' => $berkasStatus,
            'status_pembayaran' => $pendaftar->pembayaran ? $pendaftar->pembayaran->status : null
        ];
    }
}