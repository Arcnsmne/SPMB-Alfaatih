# Halaman Registrasi Siswa - PPDB SMK Bakti Nusantara 666

## Fitur yang Telah Dibuat

### 1. Halaman Registrasi (`/register`)
- **Desain**: Mengikuti template yang sama dengan halaman login
- **Role**: Khusus untuk siswa saja (role 'siswa' dipaksa di backend)
- **Validasi**: 
  - Nama lengkap (hanya huruf dan spasi)
  - Email (format email valid dan unique)
  - No HP (format Indonesia, otomatis dikonversi ke +62)
  - Password (minimal 6 karakter dengan indikator kekuatan)

### 2. Halaman Verifikasi OTP (`/verify-otp`)
- **Desain**: Konsisten dengan template login/register
- **Fitur**:
  - Input OTP 6 digit
  - Auto-submit ketika 6 digit terisi
  - Validasi OTP dan expired time
  - Hanya untuk role siswa

### 3. Keamanan
- **Middleware**: Guest only (user yang sudah login tidak bisa akses)
- **Validasi Backend**: Role dipaksa menjadi 'siswa'
- **OTP**: Expired dalam 10 menit
- **Email**: Kirim OTP otomatis setelah registrasi

### 4. User Experience
- **Loading State**: Button berubah saat proses submit
- **Password Toggle**: Show/hide password
- **Phone Formatting**: Otomatis format nomor Indonesia
- **Real-time Validation**: Validasi input saat mengetik
- **Responsive Design**: Mobile-friendly

## File yang Dimodifikasi

1. `resources/views/auth/register.blade.php` - Halaman registrasi lengkap
2. `resources/views/auth/verify_otp.blade.php` - Halaman verifikasi OTP
3. `resources/views/auth/login.blade.php` - Tambah link registrasi
4. `app/Http/Controllers/Auth/RegisterController.php` - Logic registrasi
5. `app/Http/Controllers/auth/VerifiyOTPController.php` - Logic verifikasi OTP
6. `routes/web.php` - Route dengan middleware guest

## Cara Penggunaan

1. User mengakses `/register`
2. Mengisi form registrasi (otomatis role siswa)
3. Sistem kirim OTP ke email
4. User verifikasi OTP di `/verify-otp`
5. Akun aktif, redirect ke login
6. User login dan masuk ke dashboard siswa

## Keunggulan

- ✅ Desain konsisten dengan template existing
- ✅ Khusus untuk role siswa saja
- ✅ Validasi lengkap client & server side
- ✅ UX yang smooth dengan loading states
- ✅ Security dengan middleware dan validasi role
- ✅ Mobile responsive
- ✅ Auto-format nomor HP Indonesia