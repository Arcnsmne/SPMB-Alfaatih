@extends('layout.calonsiswa')

@section('title', 'Dashboard Calon Siswa')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Dashboard Calon Siswa</h3>
                <p class="text-subtitle text-muted">Monitor progres pendaftaran Anda</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/siswa">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Home</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <!-- Content Section -->
    <section class="section">
        <!-- Quick Stats -->
        <div class="row">
            <div class="col-6 col-lg-3 col-md-6">
                <div class="card quick-action-card">
                    <div class="card-body px-4 py-4-5">
                        <div class="row">
                            <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-4 d-flex justify-content-start">
                                <div class="action-icon bg-primary">
                                    <i class="bi bi-check-circle text-white"></i>
                                </div>
                            </div>
                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-8">
                                <h6 class="font-extrabold mb-0">Tahap Selesai</h6>
                                <p class="text-muted font-semibold">{{ $progress['completed'] }} dari {{ $progress['total'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-3 col-md-6">
                <div class="card quick-action-card">
                    <div class="card-body px-4 py-4-5">
                        <div class="row">
                            <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-4 d-flex justify-content-start">
                                <div class="action-icon bg-success">
                                    <i class="bi bi-clock text-white"></i>
                                </div>
                            </div>
                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-8">
                                <h6 class="font-extrabold mb-0">Progress</h6>
                                <p class="text-muted font-semibold">{{ $progress['percentage'] }}%</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-3 col-md-6">
                <div class="card quick-action-card">
                    <div class="card-body px-4 py-4-5">
                        <div class="row">
                            <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-4 d-flex justify-content-start">
                                <div class="action-icon bg-warning">
                                    <i class="bi bi-exclamation-circle text-white"></i>
                                </div>
                            </div>
                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-8">
                                <h6 class="font-extrabold mb-0">Status</h6>
                                <p class="text-muted font-semibold">
                                    {{ $pendaftar ? ucfirst($pendaftar->status ?? 'Dalam Proses') : 'Belum Daftar' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-3 col-md-6">
                <div class="card quick-action-card">
                    <div class="card-body px-4 py-4-5">
                        <div class="row">
                            <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-4 d-flex justify-content-start">
                                <div class="action-icon bg-info">
                                    <i class="bi bi-calendar text-white"></i>
                                </div>
                            </div>
                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-8">
                                <h6 class="font-extrabold mb-0">Batas Waktu</h6>
                                <p class="text-muted font-semibold">
                                    @if($gelombangAktif && $sisaHari > 0)
                                        {{ $sisaHari }} Hari Lagi
                                    @elseif($gelombangAktif && $sisaHari == 0)
                                        Hari Terakhir
                                    @else
                                        Tidak Ada Gelombang Aktif
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Progress Tracking & Quick Actions -->
        <div class="row">
            <!-- Progress Tracking -->
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Progres Pendaftaran</h4>
                    </div>
                    <div class="card-body">
                        @foreach($progress['steps'] as $key => $step)
                        <div class="progress-track">
                            <div class="step-icon {{ $step['completed'] ? 'completed' : 'pending' }}">
                                <i class="bi {{ $step['completed'] ? 'bi-check-lg' : 'bi-clock' }}"></i>
                            </div>
                            <div class="step-content {{ $step['completed'] ? 'completed' : '' }}">
                                <div class="row align-items-center">
                                    <div class="col-md-6">
                                        <h6 class="mb-1">{{ $step['title'] }}</h6>
                                        <p class="text-muted mb-0 small">{{ $step['description'] }}</p>
                                        @if($step['completed'] && $step['date'])
                                        <span class="badge bg-success mt-2">
                                            <i class="bi bi-check-circle me-1"></i>Selesai: {{ \Carbon\Carbon::parse($step['date'])->format('d M Y') }}
                                        </span>
                                        @endif
                                    </div>
                                    <div class="col-md-4">
                                        <div class="progress mb-2" style="height: 8px;">
                                            <div class="progress-bar {{ $step['completed'] ? 'bg-success' : 'bg-secondary' }}" style="width: {{ $step['completed'] ? '100' : '0' }}%"></div>
                                        </div>
                                        <small class="text-muted">{{ $step['completed'] ? '100' : '0' }}% selesai</small>
                                    </div>
                                    <div class="col-md-2 text-end">
                                        <button class="btn {{ $step['completed'] ? 'btn-success' : 'btn-outline-secondary' }} btn-sm" disabled>
                                            <i class="bi {{ $step['completed'] ? 'bi-check-lg' : 'bi-clock' }} me-1"></i>{{ $step['completed'] ? 'Selesai' : 'Menunggu' }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Akses Cepat</h4>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-3">
                            <a href="/formulir" class="btn btn-outline-primary btn-lg d-flex align-items-center justify-content-between py-3">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-file-text me-3 fs-4"></i>
                                    <span>Formulir Pendaftaran</span>
                                </div>
                                <i class="bi bi-arrow-right"></i>
                            </a>
                            
                            <a href="/upload" class="btn btn-outline-success btn-lg d-flex align-items-center justify-content-between py-3">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-cloud-upload me-3 fs-4"></i>
                                    <span>Upload Berkas</span>
                                </div>
                                <i class="bi bi-arrow-right"></i>
                            </a>
                            
                            <a href="/pembayaran" class="btn btn-outline-warning btn-lg d-flex align-items-center justify-content-between py-3">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-credit-card me-3 fs-4"></i>
                                    <span>Pembayaran</span>
                                </div>
                                <i class="bi bi-arrow-right"></i>
                            </a>
                            
                            <a href="/monitoring" class="btn btn-outline-info btn-lg d-flex align-items-center justify-content-between py-3">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-graph-up me-3 fs-4"></i>
                                    <span>Monitoring Progres</span>
                                </div>
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection