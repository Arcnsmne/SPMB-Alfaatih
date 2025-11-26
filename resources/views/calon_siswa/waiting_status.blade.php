@extends('layout.calonsiswa')

@section('title', 'Status Pendaftaran')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Status Pendaftaran</h3>
                <p class="text-subtitle text-muted">Informasi tahapan pendaftaran Anda</p>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body text-center py-5">
                        @if($stage == 'formulir_waiting')
                            <div class="mb-4">
                                <i class="bi bi-clock-history text-warning" style="font-size: 4rem;"></i>
                            </div>
                            <h4 class="text-warning mb-3">Formulir Telah Disubmit</h4>
                            <p class="text-muted mb-4">
                                Formulir pendaftaran Anda telah berhasil disubmit. 
                                Silakan lanjut ke tahap berikutnya yaitu upload berkas persyaratan.
                            </p>
                            <a href="/upload" class="btn btn-success btn-lg">
                                <i class="bi bi-cloud-upload me-2"></i>Upload Berkas
                            </a>
                        @elseif($stage == 'berkas_waiting')
                            <div class="mb-4">
                                <i class="bi bi-clock-history text-warning" style="font-size: 4rem;"></i>
                            </div>
                            <h4 class="text-warning mb-3">Berkas Telah Diupload</h4>
                            <p class="text-muted mb-4">
                                Berkas persyaratan Anda telah berhasil diupload. 
                                Silakan lanjut ke tahap pembayaran untuk menyelesaikan pendaftaran.
                            </p>
                            <a href="/pembayaran" class="btn btn-warning btn-lg">
                                <i class="bi bi-credit-card me-2"></i>Lakukan Pembayaran
                            </a>
                        @elseif($stage == 'pembayaran_waiting')
                            <div class="mb-4">
                                <i class="bi bi-hourglass-split text-info" style="font-size: 4rem;"></i>
                            </div>
                            <h4 class="text-info mb-3">Menunggu Verifikasi</h4>
                            <p class="text-muted mb-4">
                                Pembayaran Anda telah disubmit dan sedang dalam proses verifikasi oleh admin. 
                                Mohon tunggu konfirmasi lebih lanjut.
                            </p>
                            <div class="alert alert-info">
                                <i class="bi bi-info-circle me-2"></i>
                                Proses verifikasi biasanya memakan waktu 1-2 hari kerja.
                            </div>
                        @elseif($stage == 'selesai')
                            <div class="mb-4">
                                <i class="bi bi-check-circle text-success" style="font-size: 4rem;"></i>
                            </div>
                            <h4 class="text-success mb-3">Pendaftaran Selesai</h4>
                            <p class="text-muted mb-4">
                                Selamat! Pendaftaran Anda telah selesai dan diterima. 
                                Silakan tunggu informasi lebih lanjut mengenai jadwal tes atau orientasi.
                            </p>
                            <div class="alert alert-success">
                                <i class="bi bi-check-circle me-2"></i>
                                Anda akan dihubungi melalui email atau telepon untuk informasi selanjutnya.
                            </div>
                        @elseif($stage == 'ditolak')
                            <div class="mb-4">
                                <i class="bi bi-x-circle text-danger" style="font-size: 4rem;"></i>
                            </div>
                            <h4 class="text-danger mb-3">Pendaftaran Ditolak</h4>
                            <p class="text-muted mb-4">
                                Maaf, pendaftaran Anda tidak dapat diproses lebih lanjut. 
                                Silakan hubungi admin untuk informasi lebih detail.
                            </p>
                            <div class="alert alert-danger">
                                <i class="bi bi-exclamation-triangle me-2"></i>
                                Hubungi admin di nomor telepon atau email yang tersedia untuk penjelasan lebih lanjut.
                            </div>
                        @endif
                        
                        <div class="mt-4">
                            <a href="/siswa" class="btn btn-outline-primary">
                                <i class="bi bi-arrow-left me-2"></i>Kembali ke Dashboard
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection