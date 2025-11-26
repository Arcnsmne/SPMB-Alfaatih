<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PenggunaController extends Controller
{
    public function index()
{
    $penggunas = Pengguna::orderBy('id', 'desc')->get();

    // Ambil daftar enum dari kolom role
    $column = DB::select("SHOW COLUMNS FROM pengguna WHERE Field = 'role'");
    $enumRoles = $column[0]->Type ?? '';
    preg_match("/^enum\((.*)\)$/", $enumRoles, $matches);
    $roles = isset($matches[1]) ? array_map(fn($v) => trim($v, "'"), explode(',', $matches[1])) : [];

    return view('admin.pengguna.index', compact('penggunas', 'roles'));
}

    public function create()
    {
        return response()->json(['message' => 'Create form']);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'     => 'required|string|max:100',
            'email'    => 'required|email|max:100|unique:pengguna,email',
            'hp'       => 'required|string|max:20',
            'password' => 'required|min:6',
            'role'     => 'required',
            'aktif'    => 'required|in:0,1',
        ]);

        Pengguna::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'hp' => $request->hp,
            'password_hash' => Hash::make($request->password),
            'role' => $request->role,
            'aktif' => $request->aktif,
        ]);
        
        return redirect()->route('admin.pengguna.index')->with('success', 'Pengguna berhasil ditambahkan.');
    }

    public function show($id)
    {
        $pengguna = Pengguna::findOrFail($id);
        return response()->json($pengguna);
    }

    public function edit($id)
    {
        $pengguna = Pengguna::findOrFail($id);
        return response()->json($pengguna);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama'  => 'required|string|max:100',
            'email' => 'required|email|max:100|unique:pengguna,email,' . $id,
            'hp'    => 'required|string|max:20',
            'role'  => 'required',
            'aktif' => 'required|in:0,1',
        ]);

        $pengguna = Pengguna::findOrFail($id);
        $pengguna->update([
            'nama' => $request->nama,
            'email' => $request->email,
            'hp' => $request->hp,
            'role' => $request->role,
            'aktif' => $request->aktif,
        ]);

        return redirect()->route('admin.pengguna.index')->with('success', 'Data pengguna berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pengguna = Pengguna::findOrFail($id);
        $pengguna->delete();

        return redirect()->route('admin.pengguna.index')->with('success', 'Pengguna berhasil dihapus.');
    }
}
