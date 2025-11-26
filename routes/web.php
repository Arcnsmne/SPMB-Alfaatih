<?php
use App\Http\Controllers\GelombangController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\WilayahController;

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Keuangan\KeuanganDashboardController;
use App\Http\Controllers\Kepsek\KepsekDashboardController;
use App\Http\Controllers\Kepsek\KepsekController;
use App\Http\Controllers\calonsiswa\CalonSiswaDashboardController;
use App\Http\Controllers\VerifikatorAdm\VerifikatorAdmDashboardController;
use App\Http\Controllers\VerifikatorAdm\DataVerifikasiController;
use App\Http\Controllers\VerifikatorAdm\VerifikasiController;
use App\Http\Controllers\Auth\RegisterController;

use App\Http\Controllers\calonsiswa\PendaftarDataSiswaController;
use App\Http\Controllers\calonsiswa\BerkasController;
use App\Http\Controllers\calonsiswa\PembayaranController;
use App\Http\Controllers\calonsiswa\SiswaFormController;
use App\Http\Controllers\VerifikatorAdm\VerifikasiBerkasController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('user_end.index');
});

Route::get('/dashboard', function () {
    return redirect('/admin/dashboard');
})->middleware('auth');

// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('peta-sebaran', [\App\Http\Controllers\Admin\PetaSebaranController::class, 'index'])->name('peta_sebaran');
    Route::get('peta-sebaran/data', [\App\Http\Controllers\Admin\PetaSebaranController::class, 'getData'])->name('peta_sebaran.data');
    Route::resource('jurusan', JurusanController::class);
    Route::resource('gelombang', GelombangController::class);
    Route::resource('pengguna', PenggunaController::class);
    Route::resource('wilayah', WilayahController::class);

});

// Keuangan Routes
Route::middleware(['auth', 'role:keuangan'])->prefix('keuangan')->name('keuangan.')->group(function () {
    Route::get('dashboard', [KeuanganDashboardController::class, 'index'])->name('dashboard');
    Route::get('verifikasi-pembayaran', [\App\Http\Controllers\Keuangan\VerifikasiPembayaranController::class, 'index'])->name('verifikasi_pembayaran');
    Route::get('verifikasi-pembayaran/{id}', [\App\Http\Controllers\Keuangan\VerifikasiPembayaranController::class, 'show'])->name('verifikasi_pembayaran.show');
    Route::post('verifikasi-pembayaran/{id}/selesai', [\App\Http\Controllers\Keuangan\VerifikasiPembayaranController::class, 'verifikasi'])->name('verifikasi_pembayaran.selesai');
    Route::get('rekap', [\App\Http\Controllers\Keuangan\RekapPembayaranController::class, 'index'])->name('rekap');
    Route::get('laporan', [\App\Http\Controllers\Keuangan\LaporanKeuanganController::class, 'index'])->name('laporan');
});

// Kepala Sekolah Routes
Route::middleware(['auth', 'role:kepsek'])->prefix('kepsek')->name('kepsek.')->group(function () {
    Route::get('dashboard', [KepsekController::class, 'index'])->name('dashboard');
    Route::get('calon-siswa', [KepsekController::class, 'calonSiswa'])->name('calon_siswa');
    Route::get('calon-siswa-index', [KepsekController::class, 'calonSiswa'])->name('calon_siswa.index');
    Route::get('calon-siswa-selesai', [KepsekController::class, 'calonSiswaSelesai'])->name('calon_siswa_selesai');
    Route::get('daftar-pembayaran', [KepsekController::class, 'daftarPembayaran'])->name('daftar_pembayaran');
    Route::get('rekap-pembayaran', [KepsekController::class, 'rekapPembayaran'])->name('rekap_pembayaran');
    Route::get('asal-sekolah', [KepsekController::class, 'asalSekolah'])->name('asal_sekolah');
    Route::get('asal-wilayah', [KepsekController::class, 'asalWilayah'])->name('asal_wilayah');
});


    
   

// Verifikator Administrasi Routes
Route::middleware(['auth', 'role:verifikator_adm'])->prefix('verifikator_adm')->name('verifikator_adm.')->group(function () {
    Route::get('dashboard', [VerifikatorAdmDashboardController::class, 'index'])->name('dashboard');
    Route::get('data-verifikasi', [DataVerifikasiController::class, 'index'])->name('data_verifikasi');
    Route::get('verifikasi-formulir', [DataVerifikasiController::class, 'index'])->name('verifikasi_formulir');
    Route::get('verifikasi-formulir/{id}', [VerifikasiController::class, 'show'])->name('verifikasi_formulir.show');
    Route::post('verifikasi-formulir/{id}/selesai', [VerifikasiController::class, 'selesai'])->name('verifikasi_formulir.selesai');
    Route::get('verifikasi-berkas', [VerifikasiBerkasController::class, 'index'])->name('verifikasi_berkas');
    Route::get('verifikasi-berkas/{id}', [VerifikasiBerkasController::class, 'show'])->name('verifikasi_berkas.show');
    Route::get('verifikasi-berkas/{id}/preview', [VerifikasiBerkasController::class, 'preview'])->name('verifikasi_berkas.preview');
    Route::post('verifikasi-berkas/{id}/selesai', [VerifikasiBerkasController::class, 'verifikasi'])->name('verifikasi_berkas.selesai');
    Route::get('semua-verifikasi', [DataVerifikasiController::class, 'semuaVerifikasi'])->name('semua_verifikasi');
});

// Public Calon Siswa Routes
Route::middleware(['auth', 'role:pendaftar'])->group(function () {
    Route::get('siswa', [CalonSiswaDashboardController::class, 'index'])->name('siswa.dashboard');
    Route::get('calon-siswa', [CalonSiswaDashboardController::class, 'index'])->name('calon_siswa.dashboard');
    Route::get('profil', function () { return view('calon_siswa.profil.index'); });
    Route::get('formulir', [SiswaFormController::class, 'index'])->name('calon_siswa.formulir.simple');
    Route::post('formulir', [SiswaFormController::class, 'store'])->name('calon_siswa.formulir.store');

    Route::get('upload', [\App\Http\Controllers\CalonSiswa\UploadBerkasController::class, 'index'])->name('upload.index');
    Route::post('upload', [\App\Http\Controllers\CalonSiswa\UploadBerkasController::class, 'store'])->name('upload.store');
    Route::delete('upload/{id}', [\App\Http\Controllers\CalonSiswa\UploadBerkasController::class, 'destroy'])->name('upload.destroy');
    Route::get('pembayaran', [\App\Http\Controllers\CalonSiswa\PembayaranController::class, 'index'])->name('pembayaran.index');
    Route::post('pembayaran', [\App\Http\Controllers\CalonSiswa\PembayaranController::class, 'store'])->name('pembayaran.store');
    Route::get('monitoring', [\App\Http\Controllers\calonsiswa\MonitoringController::class, 'index'])->name('monitoring.index');
    Route::get('waiting/{stage}', function ($stage) {
        return view('calon_siswa.waiting_status', compact('stage'));
    })->name('waiting.status');
});





// Auth Routes
Route::get('login', [\App\Http\Controllers\auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [\App\Http\Controllers\auth\LoginController::class, 'login'])->name('login.post');
Route::post('logout', [\App\Http\Controllers\auth\LoginController::class, 'logout'])->name('logout');
Route::get('register', [\App\Http\Controllers\Auth\RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('register', [RegisterController::class, 'register'])->name('register.post');
Route::get('verify-otp', [\App\Http\Controllers\Auth\VerifyOTPController::class, 'showVerifyForm'])->name('verify.otp');
Route::post('verify-otp', [\App\Http\Controllers\Auth\VerifyOTPController::class, 'verify'])->name('verify_otp.post');
Route::post('resend-otp', [\App\Http\Controllers\Auth\VerifyOTPController::class, 'resend'])->name('resend.otp');

// API Routes
Route::prefix('api')->group(function () {
    Route::get('provinces', [WilayahController::class, 'getProvinces']);
    Route::get('regencies/{provinceId}', [WilayahController::class, 'getRegencies']);
    Route::get('districts/{regencyId}', [WilayahController::class, 'getDistricts']);
    Route::get('villages/{districtId}', [WilayahController::class, 'getVillages']);
});

