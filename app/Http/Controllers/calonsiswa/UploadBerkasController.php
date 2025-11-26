<?php

namespace App\Http\Controllers\CalonSiswa;

use App\Http\Controllers\Controller;
use App\Models\Pendaftar;
use App\Models\PendaftarBerkas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UploadBerkasController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $pendaftar = Pendaftar::where('user_id', $user->id)->first();
        
        if (!$pendaftar || !$pendaftar->dataSiswa) {
            return redirect('/formulir')->with('error', 'Silakan isi formulir terlebih dahulu');
        }
        
        // Jika sudah upload berkas, tampilkan status
        $berkas = PendaftarBerkas::where('pendaftar_id', $pendaftar->id)->get();
        if ($berkas->count() > 0) {
            $message = match($pendaftar->status) {
                'ADM_PASS' => 'Berkas telah diverifikasi dan diterima',
                'ADM_REJECT' => 'Berkas ditolak, silakan hubungi admin',
                default => 'Berkas sedang diverifikasi'
            };
            return view('calon_siswa.waiting_verification', [
                'title' => 'Status Berkas',
                'message' => $message,
                'status' => $pendaftar->status
            ]);
        }
        
        return view('calon_siswa.upload_berkas.index', compact('pendaftar', 'berkas'));
    }
    
    public function store(Request $request)
    {
        $user = Auth::user();
        $pendaftar = Pendaftar::where('user_id', $user->id)->first();
        
        if (!$pendaftar) {
            return back()->with('error', 'Data pendaftar tidak ditemukan');
        }
        
        $jenisOptions = ['IJAZAH', 'RAPOR', 'KIP', 'KKS', 'AKTA', 'KK'];
        $uploadCount = 0;
        
        foreach ($jenisOptions as $jenis) {
            $fileKey = 'file_' . $jenis;
            
            if ($request->hasFile($fileKey)) {
                $file = $request->file($fileKey);
                
                // Validate each file
                if (!in_array($file->getClientOriginalExtension(), ['pdf', 'jpg', 'jpeg', 'png'])) {
                    continue;
                }
                
                if ($file->getSize() > 2048 * 1024) { // 2MB
                    continue;
                }
                
                $filename = time() . '_' . $jenis . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('berkas', $filename, 'public');
                
                PendaftarBerkas::create([
                    'pendaftar_id' => $pendaftar->id,
                    'jenis' => $jenis,
                    'nama_file' => $filename,
                    'url' => $path,
                    'ukuran_kb' => round($file->getSize() / 1024)
                ]);
                
                $uploadCount++;
            }
        }
        
        if ($uploadCount > 0) {
            return back()->with('success', $uploadCount . ' berkas berhasil diupload');
        } else {
            return back()->with('error', 'Tidak ada berkas yang diupload');
        }
    }
    
    public function destroy($id)
    {
        $berkas = PendaftarBerkas::findOrFail($id);
        
        if (Storage::disk('public')->exists($berkas->url)) {
            Storage::disk('public')->delete($berkas->url);
        }
        
        $berkas->delete();
        
        return back()->with('success', 'Berkas berhasil dihapus');
    }
}