<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Pengguna;
use Illuminate\Http\Request;
use Carbon\Carbon;

class VerifyOTPController extends Controller
{
    public function showVerifyForm(Request $request)
    {
        $email = $request->get('email');
        return view('auth.verify_otp', compact('email'));
    }

    public function verify(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|numeric|digits:6',
        ]);

        $user = Pengguna::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Email tidak ditemukan.']);
        }

        if ($user->otp != $request->otp) {
            return back()->withErrors(['otp' => 'Kode OTP tidak valid.']);
        }

        if (Carbon::now()->gt($user->otp_expired_at)) {
            return back()->withErrors(['otp' => 'Kode OTP sudah expired.']);
        }

        // Aktivasi akun
        $user->update([
            'aktif' => 1,
            'otp' => null,
            'otp_expired_at' => null,
        ]);

        return redirect()->route('login')->with('success', 'Akun berhasil diaktivasi! Silakan login.');
    }

    public function resendOTP(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = Pengguna::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Email tidak ditemukan.']);
        }

        $otp = rand(100000, 999999);
        $user->update([
            'otp' => $otp,
            'otp_expired_at' => Carbon::now()->addMinutes(10),
        ]);

        // Kirim ulang OTP
        try {
            \Mail::raw("Kode OTP Anda: {$otp}\n\nKode ini berlaku selama 10 menit.", function($message) use ($request) {
                $message->to($request->email)
                        ->subject('Kode OTP Verifikasi Akun SPMB 666');
            });
        } catch (\Exception $e) {
            return back()->withErrors(['email' => 'Gagal mengirim OTP.']);
        }

        return back()->with('success', 'Kode OTP baru telah dikirim ke email Anda.');
    }
}