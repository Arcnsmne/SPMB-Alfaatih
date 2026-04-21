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
            'hp' => 'required|string|min:10|max:13|regex:/^08[0-9]{8,11}$/',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // $otp = rand(100000, 999999); // OTP dinonaktifkan sementara
        
        $user = Pengguna::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'hp' => $request->hp,
            'password_hash' => Hash::make($request->password),
            'role' => 'pendaftar',
            'aktif' => 1, // OTP dinonaktifkan sementara
            'otp' => null,
            'otp_expired_at' => null,
        ]);

        // OTP dinonaktifkan sementara
        // try {
        //     Mail::raw("Kode OTP Anda: {$otp}\n\nKode ini berlaku selama 10 menit.", function($message) use ($request) {
        //         $message->to($request->email)
        //                 ->subject('Kode OTP Verifikasi Akun SPMB 666');
        //     });
        // } catch (\Exception $e) {
        //     // Jika email gagal, tetap lanjut ke OTP page
        // }

        return redirect()->route('login')
                        ->with('success', 'Registrasi berhasil! Silakan login.');
    }
}