@extends('layout.calonsiswa')

@section('title', 'Monitoring Progres')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Monitoring Progres Pendaftaran</h3>
                <p class="text-subtitle text-muted">Pantau perkembangan pendaftaran Anda</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/siswa">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Monitoring</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="row">
        <div class="col-6 col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body px-4 py-4-5">
                    <div class="row">
                        <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-4 d-flex justify-content-start">
                            <div class="stats-icon purple mb-2">
                                <i class="iconly-boldShow"></i>
                            </div>
                        </div>
                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-8">
                            <h6 class="text-muted font-semibold">Status Pendaftaran</h6>
                            <h6 class="font-extrabold mb-0">
                                @if($pendaftar->status == 'DOC_PASS')
                                    <span class="badge bg-success">Berkas Terverifikasi</span>
                                @elseif($pendaftar->status == 'ADM_PASS')
                                    <span class="badge bg-info">Data Terverifikasi</span>
                                @elseif($pendaftar->status == 'DOC_FAIL')
                                    <span class="badge bg-danger">Berkas Ditolak</span>
                                @elseif($pendaftar->status == 'ADM_FAIL')
                                    <span class="badge bg-danger">Data Ditolak</span>
                                @elseif($progress['steps']['pembayaran']['completed'])
                                    <span class="badge bg-warning">Menunggu Verifikasi</span>
                                @else
                                    <span class="badge bg-info">Dalam Proses</span>
                                @endif
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body px-4 py-4-5">
                    <div class="row">
                        <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-4 d-flex justify-content-start">
                            <div class="stats-icon blue mb-2">
                                <i class="iconly-boldProfile"></i>
                            </div>
                        </div>
                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-8">
                            <h6 class="text-muted font-semibold">Tahap Selesai</h6>
                            <h6 class="font-extrabold mb-0">{{ array_sum(array_column($progress['steps'], 'completed')) }} dari {{ count($progress['steps']) }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body px-4 py-4-5">
                    <div class="row">
                        <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-4 d-flex justify-content-start">
                            <div class="stats-icon green mb-2">
                                <i class="iconly-boldTick-Square"></i>
                            </div>
                        </div>
                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-8">
                            <h6 class="text-muted font-semibold">Berkas Terverifikasi</h6>
                            <h6 class="font-extrabold mb-0">{{ count(array_filter($progress['berkas'], fn($b) => $b['valid'] == 1)) }} dari {{ count($progress['berkas']) }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body px-4 py-4-5">
                    <div class="row">
                        <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-4 d-flex justify-content-start">
                            <div class="stats-icon red mb-2">
                                <i class="iconly-boldCalendar"></i>
                            </div>
                        </div>
                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-8">
                            <h6 class="text-muted font-semibold">Estimasi Selesai</h6>
                            <h6 class="font-extrabold mb-0">7 Hari Lagi</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-lg-8">
            <!-- Progress Tracking -->
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Progres Pendaftaran</h4>
                    <p class="card-subtitle">Status lengkap proses pendaftaran Anda</p>
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

        <div class="col-12 col-lg-4">
            <!-- Status Berkas -->
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Status Verifikasi Berkas</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <tbody>
                                @forelse($progress['berkas'] as $berkas)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar {{ $berkas['valid'] == 1 ? 'avatar-success' : ($berkas['valid'] == 0 && $berkas['catatan'] ? 'avatar-danger' : 'avatar-warning') }} me-3">
                                                <i class="bi bi-file-pdf"></i>
                                            </div>
                                            <div>
                                                <h6 class="mb-0">{{ $berkas['jenis'] }}</h6>
                                                <small class="text-muted">
                                                    @if($berkas['valid'] == 1)
                                                        Terverifikasi
                                                    @elseif($berkas['valid'] == 0 && $berkas['catatan'])
                                                        Perlu Revisi
                                                    @else
                                                        Dalam Pengecekan
                                                    @endif
                                                </small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-end">
                                        @if($berkas['valid'] == 1)
                                            <span class="badge bg-success">Diterima</span>
                                        @elseif($berkas['valid'] == 0 && $berkas['catatan'])
                                            <span class="badge bg-danger">Ditolak</span>
                                        @else
                                            <span class="badge bg-warning">Proses</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="2" class="text-center text-muted">
                                        Belum ada berkas yang diupload
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Timeline Aktivitas -->
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Aktivitas Terbaru</h4>
                </div>
                <div class="card-body">
                    <div class="activity-list">
                        <div class="activity-item">
                            <div class="activity-icon success">
                                <i class="bi bi-cloud-upload"></i>
                            </div>
                            <div class="activity-content">
                                <h6>Upload Berkas Selesai</h6>
                                <p class="text-muted mb-0">Semua dokumen telah diupload</p>
                                <small class="text-muted">2 jam lalu</small>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="activity-icon primary">
                                <i class="bi bi-check-circle"></i>
                            </div>
                            <div class="activity-content">
                                <h6>Formulir Diverifikasi</h6>
                                <p class="text-muted mb-0">Data formulir telah diterima</p>
                                <small class="text-muted">1 hari lalu</small>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="activity-icon warning">
                                <i class="bi bi-exclamation-triangle"></i>
                            </div>
                            <div class="activity-content">
                                <h6>Berkas Perlu Revisi</h6>
                                <p class="text-muted mb-0">Surat keterangan sehat ditolak</p>
                                <small class="text-muted">1 hari lalu</small>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="activity-icon info">
                                <i class="bi bi-info-circle"></i>
                            </div>
                            <div class="activity-content">
                                <h6>Pembayaran Diterima</h6>
                                <p class="text-muted mb-0">Biaya pendaftaran telah diverifikasi</p>
                                <small class="text-muted">2 hari lalu</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Informasi Penting -->
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Informasi Penting</h4>
                </div>
                <div class="card-body">
                    <div class="alert alert-warning">
                        <h6><i class="bi bi-exclamation-triangle me-2"></i>Perhatian!</h6>
                        <p class="mb-0">Surat keterangan sehat Anda ditolak. Silakan upload ulang dengan format yang benar.</p>
                    </div>
                    <div class="alert alert-info">
                        <h6><i class="bi bi-calendar-event me-2"></i>Jadwal Tes</h6>
                        <p class="mb-0">Tes seleksi akan dilaksanakan pada <strong>25 Januari 2024</strong>.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .progress-track {
        position: relative;
        padding-left: 40px;
        margin-bottom: 25px;
    }
    
    .progress-track::before {
        content: '';
        position: absolute;
        left: 15px;
        top: 0;
        width: 2px;
        height: 100%;
        background: #dee2e6;
    }
    
    .progress-track:last-child::before {
        display: none;
    }
    
    .step-icon {
        position: absolute;
        left: 0;
        top: 0;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 2;
        font-size: 0.875rem;
    }
    
    .step-icon.completed {
        background: #198754;
        color: white;
    }
    
    .step-icon.current {
        background: #0d6efd;
        color: white;
    }
    
    .step-icon.pending {
        background: #6c757d;
        color: white;
    }
    
    .step-content {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 10px;
        border-left: 4px solid #dee2e6;
    }
    
    .step-content.completed {
        border-left-color: #198754;
    }
    
    .step-content.current {
        border-left-color: #0d6efd;
        background: #e3f2fd;
    }
    
    .activity-list {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }
    
    .activity-item {
        display: flex;
        align-items: flex-start;
        gap: 1rem;
        padding: 1rem;
        border-radius: 8px;
        background: #f8f9fa;
    }
    
    .activity-icon {
        width: 40px;
        height: 40px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    
    .activity-icon.success {
        background: #e8f5e8;
        color: #27ae60;
    }
    
    .activity-icon.primary {
        background: #e3f2fd;
        color: #0d6efd;
    }
    
    .activity-icon.warning {
        background: #fff3e0;
        color: #e67e22;
    }
    
    .activity-icon.info {
        background: #e3f2fd;
        color: #17a2b8;
    }
    
    .activity-content {
        flex: 1;
    }
    
    .activity-content h6 {
        margin-bottom: 0.25rem;
        font-weight: 600;
    }
    
    .stats-icon {
        width: 50px;
        height: 50px;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .stats-icon.purple {
        background: #e0e7ff;
        color: #6366f1;
    }
    
    .stats-icon.blue {
        background: #dbeafe;
        color: #3b82f6;
    }
    
    .stats-icon.green {
        background: #dcfce7;
        color: #16a34a;
    }
    
    .stats-icon.red {
        background: #fef2f2;
        color: #dc2626;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Auto refresh progress setiap 30 detik
        setInterval(() => {
            console.log('Memperbarui status progres...');
            // Di sini bisa ditambahkan AJAX call untuk update real-time
        }, 30000);
        
        // Simulasi notifikasi untuk berkas yang perlu revisi
        const rejectedDoc = document.querySelector('.avatar-danger').closest('tr');
        rejectedDoc.addEventListener('click', function() {
            alert('Surat keterangan sehat Anda ditolak. Silakan upload ulang dengan format yang benar.\n\nAlasan: Format surat tidak sesuai, mohon gunakan format dari puskesmas/rumah sakit.');
        });
    });
</script>
@endsection