<?php

namespace App\Http\Controllers\calonsiswa;

use App\Http\Controllers\Controller;
use App\Models\PendaftarBerkas;
use App\Models\Pendaftar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BerkasController extends Controller
{
    public function upload(Request $request)
    {
        $pendaftar = Pendaftar::where('user_id', auth()->id())->first();
        
        // Cek apakah berkas sudah pernah diupload
        $berkasExists = PendaftarBerkas::where('pendaftar_id', $pendaftar->id)->exists();
        if ($berkasExists) {
            return redirect()->back()->with('error', 'Berkas sudah pernah diupload sebelumnya');
        }
        
        $request->validate([
            'IJAZAH' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'RAPOR' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'KIP' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'KKS' => 'required|file|mimes:jpg,jpeg,png|max:1024',
            'AKTA' => 'required|file|mimes:pdf|max:5120',
            'KK' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);
        
        $files = [
            'IJAZAH' => 'IJAZAH',
            'RAPOR' => 'RAPOR',
            'KIP' => 'KIP',
            'KKS' => 'KKS',
            'AKTA' => 'AKTA',
            'KK' => 'KK',
        ];

        foreach ($files as $key => $jenis) {
            if ($request->hasFile($key)) {
                $file = $request->file($key);
                $path = $file->store('berkas', 'public');
                
                PendaftarBerkas::create([
                    'pendaftar_id' => $pendaftar->id,
                    'jenis' => $jenis,
                    'nama_file' => $file->getClientOriginalName(),
                    'url' => $path,
                    'ukuran_kb' => round($file->getSize() / 1024, 2),
                    'valid' => 0,
                    'catatan' => null
                ]);
            }
        }
        
        return response()->view('calon_siswa.waiting_verification', [
            'title' => 'Menunggu Verifikasi Berkas',
            'message' => 'Berkas berhasil diupload dan sedang diverifikasi admin'
        ]);
    }
}
