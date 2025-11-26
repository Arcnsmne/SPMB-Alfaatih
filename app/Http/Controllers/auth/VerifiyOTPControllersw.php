<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengguna;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class VerifyOTPController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showVerifyForm()
    {
        if (!session('email')) {
            return redirect()->route('register')->withErrors(['email' => 'Silakan daftar terlebih dahulu.']);
        }
        
        return view('auth.verify_otp', [
            'email' => session('email')
        ]);
    }

    public function verify(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|digits:6'
        ], [
            'otp.required' => 'Kode OTP wajib diisi',
            'otp.digits' => 'Kode OTP harus 6 digit',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid'
        ]);

        $user = Pengguna::where('email', $request->email)
                        ->where('otp', $request->otp)
                        ->first();

        if (!$user) {
            return back()->withErrors(['otp' => 'Kode OTP salah atau tidak valid!'])->withInput();
        }

        if (Carbon::now()->gt($user->otp_expired_at)) {
            return back()->withErrors(['otp' => 'Kode OTP sudah kadaluarsa! Silakan request OTP baru.'])->withInput();
        }

        // Pastikan hanya role siswa yang bisa verifikasi
        if ($user->role !== 'siswa') {
            return back()->withErrors(['otp' => 'Akun ini bukan untuk siswa!'])->withInput();
        }

        // Aktifkan akun dan clear OTP
        $user->update([
            'aktif' => 1,
            'otp' => null,
            'otp_expired_at' => null
        ]);

        // Clear session email
        $request->session()->forget('email');

        return redirect()->route('login')->with('success', 'Akun berhasil diverifikasi! Silakan login untuk melanjutkan pendaftaran.');
    }

    public function resendOTP(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $user = Pengguna::where('email', $request->email)
                        ->where('aktif', 0)
                        ->where('role', 'siswa')
                        ->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Email tidak ditemukan atau sudah terverifikasi.']);
        }

        // Generate OTP baru
        $newOtp = rand(100000, 999999);
        
        $user->update([
            'otp' => $newOtp,
            'otp_expired_at' => Carbon::now()->addMinutes(10)
        ]);

        // Kirim email OTP baru
        try {
            Mail::send('emails.otp', ['otp' => $newOtp, 'nama' => $user->nama], function ($message) use ($user) {
                $message->to($user->email);
                $message->subject('Kode OTP Baru - PPDB SMK Bakti Nusantara 666');
            });
        } catch (\Exception $e) {
            \Log::error('Gagal mengirim OTP: ' . $e->getMessage());
        }

        return back()->with('success', 'Kode OTP baru telah dikirim ke email Anda.');
    }
}