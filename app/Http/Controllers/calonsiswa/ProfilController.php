<?php

namespace App\Http\Controllers\calonsiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfilController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('calon_siswa.profil.index', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'nama'  => 'required|string|max:255',
            'email' => 'required|email|unique:pengguna,email,' . $user->id,
            'hp'    => 'required|string|min:10|max:13|regex:/^08[0-9]{8,11}$/',
        ]);

        $user->nama  = $request->nama;
        $user->email = $request->email;
        $user->hp    = $request->hp;
        $user->save();

        return back()->with('success', 'Profil berhasil diperbarui.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password_lama' => 'required',
            'password'      => 'required|min:6|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->password_lama, $user->password_hash)) {
            return back()->withErrors(['password_lama' => 'Password lama tidak sesuai.'])->with('tab', 'password');
        }

        $user->password_hash = Hash::make($request->password);
        $user->save();

        return back()->with('success', 'Password berhasil diubah.')->with('tab', 'password');
    }
}
