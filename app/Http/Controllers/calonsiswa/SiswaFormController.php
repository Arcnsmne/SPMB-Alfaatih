<?php

namespace App\Http\Controllers\calonsiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pendaftar;
use App\Models\PendaftarDataSiswa;
use App\Models\Gelombang;
use App\Models\Jurusan;
use Illuminate\Support\Facades\Auth;

class SiswaFormController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $pendaftar = Pendaftar::where('user_id', $user->id)->first();
        
        // Jika sudah ada pendaftar dengan data siswa, tampilkan status
        if ($pendaftar && $pendaftar->dataSiswa) {
            $message = match($pendaftar->status) {
                'ADM_PASS' => 'Formulir telah diverifikasi dan diterima',
                'ADM_REJECT' => 'Formulir ditolak, silakan hubungi admin',
                default => 'Formulir sedang diverifikasi'
            };
            return view('calon_siswa.waiting_verification', [
                'title' => 'Status Formulir',
                'message' => $message,
                'status' => $pendaftar->status
            ]);
        }
        
        $gelombang = Gelombang::where('tgl_mulai', '<=', now())
                              ->where('tgl_selesai', '>=', now())
                              ->get();
        $jurusan = Jurusan::all();
        
        return view('calon_siswa.formulir.simple', compact('gelombang', 'jurusan'));
    }

    public function store(Request $request)
    {
        // Cek apakah user sudah pernah mendaftar
        $existingPendaftar = Pendaftar::where('user_id', Auth::id())->first();
        if ($existingPendaftar) {
            return redirect()->route('siswa.dashboard')
                           ->with('error', 'Anda sudah pernah mendaftar!');
        }
        
        $request->validate([
            'nama' => 'required|string|max:255',
            'jk' => 'required|in:L,P',
            'tmp_lahir' => 'required|string|max:255',
            'tgl_lahir' => 'required|date',
            'nik' => 'required|string|size:16',
            'nisn' => 'required|string|size:10',
            'nama_ayah' => 'required|string|max:255',
            'pekerjaan_ayah' => 'required|string|max:255',
            'hp_ayah' => 'required|string|min:10|max:13',
            'nama_ibu' => 'required|string|max:255',
            'pekerjaan_ibu' => 'required|string|max:255',
            'hp_ibu' => 'required|string|min:10|max:13',
            'gelombang_id' => 'required|exists:gelombang,id',
            'jurusan_id' => 'required|exists:jurusan,id',
            'npsn' => 'required|string|size:8',
            'nama_sekolah' => 'required|string|max:255',
            'kabupaten' => 'required|string|max:255',
            'nilai_rata' => 'required|numeric|min:0|max:100',
            'alamat' => 'required|string',
            'village_id' => 'required|string'
        ]);
$lastNumber = Pendaftar::whereYear('tanggal_daftar', date('Y'))->count() + 1;
        $no_pendaftaran = 'PPDB' . date('Y') . str_pad($lastNumber, 4, '0', STR_PAD_LEFT);

        // Buat pendaftar
        $pendaftar = Pendaftar::create([
            'user_id' => Auth::id(),
            'tanggal_daftar' => now(),
            'no_pendaftaran' =>  $no_pendaftaran,
            'gelombang_id' => $request->gelombang_id,
            'jurusan_id' => $request->jurusan_id,
            'status' => 1,
        ]);

        // Simpan data siswa
        $pendaftar->dataSiswa()->create([
            'nama' => $request->nama,
            'jk' => $request->jk,
            'tmp_lahir' => $request->tmp_lahir,
            'tgl_lahir' => $request->tgl_lahir,
            'nik' => $request->nik,
            'nisn' => $request->nisn,
            'alamat' => $request->alamat,
            'village_id' => $request->village_id,
            'lat' => $request->lat,
            'lng' => $request->lng
        ]);

        // Simpan data orang tua
        $pendaftar->dataOrtu()->create([
            'nama_ayah' => $request->nama_ayah,
            'pekerjaan_ayah' => $request->pekerjaan_ayah,
            'hp_ayah' => $request->hp_ayah,
            'nama_ibu' => $request->nama_ibu,
            'pekerjaan_ibu' => $request->pekerjaan_ibu,
            'hp_ibu' => $request->hp_ibu,
            'wali_nama' => $request->wali_nama,
            'wali_hp' => $request->wali_hp
        ]);

        // Simpan data sekolah
        $pendaftar->asalSekolah()->create([
            'npsn' => $request->npsn,
            'nama_sekolah' => $request->nama_sekolah,
            'kabupaten' => $request->kabupaten,
            'nilai_rata' => $request->nilai_rata
        ]);


        
        return redirect()->route('siswa.dashboard')
                       ->with('success', 'Formulir pendaftaran berhasil disimpan!');
    }



    private function generateNoDaftar()
    {
        $year = date('Y');
        $lastNumber = Pendaftar::whereYear('tanggal_daftar', $year)
                              ->count() + 1;
        
        return $year . str_pad($lastNumber, 4, '0', STR_PAD_LEFT);
    }
}