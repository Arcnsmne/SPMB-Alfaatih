<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request; // Tetap menggunakan Request $request untuk validasi dan data
use App\Models\Gelombang;
use Carbon\Carbon;

class GelombangController extends Controller
{
    /**
     * Menampilkan daftar semua data gelombang. (Read)
     */
    public function index()
    {
        $gelombangs = Gelombang::all();
        // Mengirim data ke view Blade yang kini akan memanggil modal
        return view('admin.gelombang.index', compact('gelombangs'));
    }

    /**
     * Menghilangkan view create karena form ada di modal index.
     * Metode ini tetap dibutuhkan oleh Resource Route untuk POST (store)
     * tetapi tidak perlu me-return view.
     */
    public function create()
    {
        // Redirect ke index, atau biarkan kosong, karena form diakses via modal di index
        return redirect()->route('admin.gelombang.index');
    }

    /**
     * Menyimpan data gelombang baru. (Store)
     */
    public function store(Request $request)
    {
        // 1. Validasi Data Lengkap
        $request->validate([
            'nama'          => 'required|string|max:255|unique:gelombang,nama',
            'tahun'         => 'required|integer|min:2000|max:2100',
            'tgl_mulai'     => 'required|date',
            'tgl_selesai'   => 'required|date|after_or_equal:tgl_mulai',
            'kuota'         => 'required|integer|min:1',
            'biaya_daftar'  => 'required|numeric|min:0',
        ], [
            'nama.unique' => 'Nama gelombang sudah ada, silakan gunakan nama lain.',
            'tgl_selesai.after_or_equal' => 'Tanggal selesai harus sama atau setelah tanggal mulai.'
        ]);

        // 2. Simpan ke Database dengan data yang sudah divalidasi
        Gelombang::create([
            'nama' => $request->nama,
            'tahun' => $request->tahun,
            'tgl_mulai' => $request->tgl_mulai,
            'tgl_selesai' => $request->tgl_selesai,
            'kuota' => $request->kuota,
            'biaya_daftar' => $request->biaya_daftar,
        ]);

        return redirect()->route('admin.gelombang.index')->with('success', 'Data gelombang berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail gelombang (untuk API atau modal)
     */
    public function show(Gelombang $gelombang)
    {
        return response()->json($gelombang);
    }

    /**
     * Menghilangkan view edit karena form ada di modal index.
     * Metode ini tetap dibutuhkan oleh Resource Route untuk PUT/PATCH (update)
     * tetapi tidak perlu me-return view.
     */
    public function edit(Gelombang $gelombang)
    {
        // Redirect ke index, atau biarkan kosong, karena form diakses via modal di index
        return redirect()->route('admin.gelombang.index');
    }

    /**
     * Memperbarui data gelombang yang ada. (Update)
     */
    public function update(Request $request, Gelombang $gelombang)
    {
        // 1. Validasi Data Lengkap
        $request->validate([
            'nama'          => 'required|string|max:255|unique:gelombang,nama,' . $gelombang->id,
            'tahun'         => 'required|integer|min:2000|max:2100',
            'tgl_mulai'     => 'required|date',
            'tgl_selesai'   => 'required|date|after_or_equal:tgl_mulai',
            'kuota'         => 'required|integer|min:1',
            'biaya_daftar'  => 'required|numeric|min:0',
        ], [
            'nama.unique' => 'Nama gelombang sudah ada, silakan gunakan nama lain.',
            'tgl_selesai.after_or_equal' => 'Tanggal selesai harus sama atau setelah tanggal mulai.'
        ]);

        // 2. Update Data dengan data yang sudah divalidasi
        $gelombang->update([
            'nama' => $request->nama,
            'tahun' => $request->tahun,
            'tgl_mulai' => $request->tgl_mulai,
            'tgl_selesai' => $request->tgl_selesai,
            'kuota' => $request->kuota,
            'biaya_daftar' => $request->biaya_daftar,
        ]);

        return redirect()->route('admin.gelombang.index')->with('success', 'Data gelombang berhasil diperbarui.');
    }

    public function destroy(Gelombang $gelombang)
    {
        $gelombang->delete();
        return redirect()->route('admin.gelombang.index')->with('success', 'Data gelombang berhasil dihapus.');
    }
}