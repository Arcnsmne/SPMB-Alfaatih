<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Pendaftar;
use App\Models\PendaftarBerkas;
use App\Models\PendaftarPembayaran;

class CheckPendaftaranStatus
{
    public function handle(Request $request, Closure $next, $step)
    {
        $pendaftar = Pendaftar::where('user_id', auth()->id())->first();
        
        if ($step === 'formulir') {
            if ($pendaftar) {
                if ($pendaftar->status == 'SUBMIT') {
                    return response()->view('calon_siswa.waiting_verification', [
                        'title' => 'Menunggu Verifikasi Formulir',
                        'message' => 'Formulir sedang diverifikasi admin'
                    ]);
                } elseif ($pendaftar->status == 'ADM_PASS') {
                    return response()->view('calon_siswa.already_verified', [
                        'title' => 'Formulir Sudah Disetujui',
                        'message' => 'Silakan lanjut ke upload berkas'
                    ]);
                } elseif ($pendaftar->status == 'ADM_REJECT') {
                    return response()->view('calon_siswa.rejected', [
                        'title' => 'Formulir Ditolak',
                        'message' => 'Hubungi admin untuk info lebih lanjut'
                    ]);
                }
            }
        }
        
        if ($step === 'berkas') {
            if (!$pendaftar) {
                return redirect('/formulir');
            }
            
            if ($pendaftar->status == 'SUBMIT') {
                return response()->view('calon_siswa.waiting_verification', [
                    'title' => 'Menunggu Verifikasi Formulir',
                    'message' => 'Formulir masih diverifikasi admin'
                ]);
            }
            
            if ($pendaftar->status == 'ADM_REJECT') {
                return response()->view('calon_siswa.rejected', [
                    'title' => 'Formulir Ditolak',
                    'message' => 'Hubungi admin untuk info lebih lanjut'
                ]);
            }
            
            $berkas = PendaftarBerkas::where('pendaftar_id', $pendaftar->id)->exists();
            if ($berkas) {
                return response()->view('calon_siswa.already_verified', [
                    'title' => 'Berkas Sudah Diupload',
                    'message' => 'Silakan lanjut ke pembayaran'
                ]);
            }
        }
        
        if ($step === 'pembayaran') {
            if (!$pendaftar) {
                return redirect('/formulir');
            }
            
            if ($pendaftar->status == 'PAID') {
                return response()->view('calon_siswa.already_verified', [
                    'title' => 'Pendaftaran Selesai',
                    'message' => 'Pembayaran sudah diverifikasi. Pendaftaran Anda selesai'
                ]);
            }
            
            if ($pendaftar->status == 'SUBMIT') {
                return response()->view('calon_siswa.waiting_verification', [
                    'title' => 'Menunggu Verifikasi Formulir',
                    'message' => 'Formulir masih diverifikasi admin'
                ]);
            }
            
            if ($pendaftar->status == 'ADM_REJECT') {
                return response()->view('calon_siswa.rejected', [
                    'title' => 'Formulir Ditolak',
                    'message' => 'Hubungi admin untuk info lebih lanjut'
                ]);
            }
            
            $berkas = PendaftarBerkas::where('pendaftar_id', $pendaftar->id)->exists();
            if (!$berkas) {
                return redirect('/upload');
            }
            
            $pembayaran = PendaftarPembayaran::where('pendaftar_id', $pendaftar->id)->first();
            if ($pembayaran) {
                if ($pembayaran->status == 'VERIFIED') {
                    return response()->view('calon_siswa.already_verified', [
                        'title' => 'Pendaftaran Selesai',
                        'message' => 'Pembayaran sudah diverifikasi. Pendaftaran Anda selesai'
                    ]);
                } else {
                    return response()->view('calon_siswa.waiting_verification', [
                        'title' => 'Menunggu Verifikasi Pembayaran',
                        'message' => 'Pembayaran sedang diverifikasi'
                    ]);
                }
            }
        }
        
        return $next($request);
    }
}
