<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class RegisterController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:pengguna',
            'hp' => 'required|string|max:20',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $otp = rand(100000, 999999);
        
        $user = Pengguna::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'hp' => $request->hp,
            'password_hash' => Hash::make($request->password),
            'role' => 'pendaftar',
            'aktif' => 0,
            'otp' => $otp,
            'otp_expired_at' => Carbon::now()->addMinutes(10),
        ]);

        // Kirim OTP via email (simulasi)
        try {
            Mail::raw("Kode OTP Anda: {$otp}\n\nKode ini berlaku selama 10 menit.", function($message) use ($request) {
                $message->to($request->email)
                        ->subject('Kode OTP Verifikasi Akun SPMB 666');
            });
        } catch (\Exception $e) {
            // Jika email gagal, tetap lanjut ke OTP page
        }

        return redirect()->route('verify.otp', ['email' => $request->email])
                        ->with('success', 'Registrasi berhasil! Silakan cek email untuk kode OTP.');
    }
}