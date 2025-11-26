<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Jurusan;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    public function index()
    {
        $jurusans = Jurusan::all();
        return view('admin.jurusan.index', compact('jurusans'));
    }

    public function create()
    {
        return redirect()->route('admin.jurusan.index');
    }

    public function show(Jurusan $jurusan)
    {
        return response()->json($jurusan);
    }

    public function edit(Jurusan $jurusan)
    {
        return redirect()->route('admin.jurusan.index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode' => 'required|string|max:10|unique:jurusan,kode',
            'nama' => 'required|string|max:100',
            'kuota' => 'required|integer|min:1',
        ]);

        Jurusan::create($validated);
        return redirect()->back()->with('success', 'Jurusan berhasil ditambahkan!');
    }

    public function update(Request $request, Jurusan $jurusan)
    {
        $validated = $request->validate([
            'kode' => 'required|string|max:10|unique:jurusan,kode,' . $jurusan->id,
            'nama' => 'required|string|max:100',
            'kuota' => 'required|integer|min:1',
        ]);

        $jurusan->update($validated);
        return redirect()->back()->with('success', 'Jurusan berhasil diperbarui!');
    }

    public function destroy(Jurusan $jurusan)
    {
        $jurusan->delete();
        return redirect()->back()->with('success', 'Jurusan berhasil dihapus!');
    }
}
