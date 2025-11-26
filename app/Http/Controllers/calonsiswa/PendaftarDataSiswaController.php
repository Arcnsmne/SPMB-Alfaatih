<?php

namespace App\Http\Controllers\calonsiswa;

use App\Http\Controllers\Controller;
use App\Models\Pendaftar;
use App\Models\PendaftarDataSiswa;
use App\Models\Gelombang;
use App\Models\Jurusan;
use App\Models\Wilayah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PendaftarDataSiswaController extends Controller
{
    public function create()
    {
        return view('calon_siswa.formulir.simple');
    }
    
    public function store(Request $request)
    {
        \Log::info('Form Data:', $request->all());
        
        $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|size:16',
            'nisn' => 'required|string|size:10',
            'jk' => 'required|in:L,P',
            'tmp_lahir' => 'required|string',
            'tgl_lahir' => 'required|date',
            'alamat' => 'required|string',
            'village_id' => 'required',
            'jurusan_id' => 'required|exists:jurusan,id',
            'gelombang_id' => 'required|exists:gelombang,id',
        ]);
        
        // Ambil data wilayah dari API tables
        $village = DB::table('villages')->where('id', $request->village_id)->first();
        $district = DB::table('districts')->where('id', $village->district_id)->first();
        $regency = DB::table('regencies')->where('id', $district->regency_id)->first();
        $province = DB::table('provinces')->where('id', $regency->province_id)->first();
        
        // Cari atau buat data di tabel wilayah
        $wilayah = Wilayah::firstOrCreate([
            'provinsi' => $province->name,
            'kabupaten' => $regency->name,
            'kecamatan' => $district->name,
            'kelurahan' => $village->name,
        ]);
        
        \Log::info('Wilayah Created/Found:', ['id' => $wilayah->id]);
        
        $pendaftar = Pendaftar::create([
            'user_id' => auth()->id(),
            'tanggal_daftar' => now(),
            'no_pendaftaran' => 'REG' . date('Y') . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT),
            'gelombang_id' => $request->gelombang_id,
            'jurusan_id' => $request->jurusan_id,
            'status' => 'SUBMIT'
        ]);
        
        \Log::info('Pendaftar Created:', ['id' => $pendaftar->id, 'status' => $pendaftar->status]);
        
        $dataSiswa = PendaftarDataSiswa::create([
            'pendaftar_id' => $pendaftar->id,
            'nik' => $request->nik,
            'nisn' => $request->nisn,
            'nama' => $request->nama,
            'jk' => $request->jk,
            'tmp_lahir' => $request->tmp_lahir,
            'tgl_lahir' => $request->tgl_lahir,
            'alamat' => $request->alamat,
            'wilayah_id' => $wilayah->id,
            'lat' => $request->lat,
            'lng' => $request->lng,
        ]);
        
        \Log::info('Data Siswa Created:', ['wilayah_id' => $dataSiswa->wilayah_id]);
        
        return redirect()->route('calon_siswa.dashboard')->with('success', 'Formulir berhasil disimpan');
    }
}