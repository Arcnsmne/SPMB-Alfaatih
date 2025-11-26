<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Pengguna;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        // Ambil user berdasarkan email
        $user = Pengguna::where('email', $request->email)->first();

        // Jika user tidak ditemukan
        if (!$user) {
            return back()->withErrors(['email' => 'Email atau password salah.']);
        }

        // Jika akun tidak aktif
        if ($user->aktif != 1) {  
            return redirect()->route('verify.otp', ['email' => $request->email])
                           ->withErrors(['email' => 'Akun belum diverifikasi. Silakan verifikasi dengan kode OTP.']);
        }

        // Cek password
        if (!Hash::check($request->password, $user->password_hash)) {
            return back()->withErrors(['email' => 'Email atau password salah.']);
        }

        // Login manual tanpa Auth::attempt()
        Auth::login($user);

        $request->session()->regenerate();

        return $this->redirectByRole($user->role);
    }

    protected function redirectByRole($role)
    {
        $routes = [
            'admin'   => 'admin.dashboard',
            'keuangan' => 'keuangan.dashboard',
            'kepsek' => 'kepsek.dashboard',
            'pendaftar'   => 'siswa.dashboard',
            'verifikator_adm' => 'verifikator_adm.dashboard'
        ];

        return redirect()->route($routes[$role] ?? 'login');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->to('/login')->with('success', 'Anda telah berhasil logout.');
    }
}
