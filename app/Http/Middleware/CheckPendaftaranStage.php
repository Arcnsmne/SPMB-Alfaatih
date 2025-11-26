<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Pendaftar;
use Illuminate\Support\Facades\Auth;

class CheckPendaftaranStage
{
    public function handle(Request $request, Closure $next, $stage)
    {
        $user = Auth::user();
        $pendaftar = Pendaftar::with(['dataSiswa', 'berkas', 'pembayaran'])->where('user_id', $user->id)->first();
        
        switch ($stage) {
            case 'formulir':
                // Formulir bisa diakses jika belum ada data siswa
                if ($pendaftar && $pendaftar->dataSiswa) {
                    return redirect('/siswa')->with('info', 'Formulir sudah diisi, silakan lanjut ke tahap berikutnya');
                }
                break;
                
            case 'berkas':
                // Berkas bisa diakses jika formulir sudah diisi tapi belum upload berkas
                if (!$pendaftar || !$pendaftar->dataSiswa) {
                    return redirect('/formulir')->with('error', 'Silakan isi formulir terlebih dahulu');
                }
                break;
                
            case 'pembayaran':
                // Pembayaran bisa diakses jika berkas sudah diupload
                if (!$pendaftar || !$pendaftar->berkas || $pendaftar->berkas->count() == 0) {
                    return redirect('/upload')->with('error', 'Silakan upload berkas terlebih dahulu');
                }
                break;
        }
        
        return $next($request);
    }
}