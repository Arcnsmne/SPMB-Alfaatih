<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pendaftar;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PetaSebaranController extends Controller
{
    public function index()
    {
        $jurusanList = Jurusan::all();
        return view('admin.peta_sebaran.index', compact('jurusanList'));
    }

    public function getData(Request $request)
    {
        $query = Pendaftar::with([
            'dataSiswa.district.regency.province', 
            'jurusan'
        ])->whereHas('dataSiswa');

        if ($request->jurusan_id) {
            $query->where('jurusan_id', $request->jurusan_id);
        }

        $pendaftar = $query->get();

        $markers = [];
        $agregasi = [
            'total' => $pendaftar->count(),
            'per_jurusan' => [],
            'per_kecamatan' => []
        ];

        foreach ($pendaftar as $p) {
            if ($p->dataSiswa && $p->dataSiswa->latitude && $p->dataSiswa->longitude) {
                // Get wilayah data
                $kecamatan = $p->dataSiswa->district->name ?? 'Tidak ada';
                $kabupaten = $p->dataSiswa->district->regency->name ?? 'Tidak ada';
                $provinsi = $p->dataSiswa->district->regency->province->name ?? 'Tidak ada';
                
                $markers[] = [
                    'lat' => (float) $p->dataSiswa->latitude,
                    'lng' => (float) $p->dataSiswa->longitude,
                    'nama' => $p->dataSiswa->nama_lengkap,
                    'jurusan' => $p->jurusan->nama ?? 'Tidak ada',
                    'alamat' => $p->dataSiswa->alamat ?? 'Tidak ada',
                    'kecamatan' => $kecamatan,
                    'kabupaten' => $kabupaten,
                    'provinsi' => $provinsi
                ];

                // Agregasi per jurusan
                $jurusan = $p->jurusan->nama ?? 'Tidak ada';
                $agregasi['per_jurusan'][$jurusan] = ($agregasi['per_jurusan'][$jurusan] ?? 0) + 1;

                // Agregasi per kecamatan
                $agregasi['per_kecamatan'][$kecamatan] = ($agregasi['per_kecamatan'][$kecamatan] ?? 0) + 1;
            }
        }

        return response()->json([
            'markers' => $markers,
            'agregasi' => $agregasi
        ]);
    }
}