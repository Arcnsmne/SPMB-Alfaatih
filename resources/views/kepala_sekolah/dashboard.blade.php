@extends('layout.kepalasekolah')

@section('title', 'Dashboard - Kepala Sekolah')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Dashboard Kepala Sekolah</h3>
                <p class="text-subtitle text-muted">Overview pendaftaran dan keuangan sekolah</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/kepala-sekolah">Kepala Sekolah</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <!-- Statistik Utama -->
    <section class="section">
        <div class="row">
            <div class="col-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 class="text-muted font-semibold">Total Calon Siswa</h6>
                                <h4 class="font-extrabold mb-0">{{ $totalPendaftar }}</h4>
                                <small class="{{ $persentaseKuota >= 80 ? 'text-success' : 'text-warning' }}">{{ $persentaseKuota }}% dari kuota ({{ $kuotaTotal }})</small>
                            </div>
                            <div class="stats-icon blue">
                                <i class="bi bi-people-fill"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 class="text-muted font-semibold">Terverifikasi</h6>
                                <h4 class="font-extrabold mb-0">{{ $terverifikasi }}</h4>
                                <small>{{ $rasioVerifikasi }}% rasio verifikasi</small>
                            </div>
                            <div class="stats-icon green">
                                <i class="bi bi-check-circle-fill"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 class="text-muted font-semibold">Total Pembayaran</h6>
                                <h4 class="font-extrabold mb-0">Rp {{ number_format($totalPembayaran / 1000000, 0) }}Jt</h4>
                                <small class="text-success">Pembayaran terverifikasi</small>
                            </div>
                            <div class="stats-icon purple">
                                <i class="bi bi-cash-coin"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 class="text-muted font-semibold">Sekolah Asal</h6>
                                <h4 class="font-extrabold mb-0">{{ $jumlahSekolah }}</h4>
                                <small>Sekolah berbeda</small>
                            </div>
                            <div class="stats-icon orange">
                                <i class="bi bi-building"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Chart dan Data -->
    <section class="section">
        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h4>Progress Pendaftaran Per Minggu</h4>
                    </div>
                    <div class="card-body">
                        <canvas id="trenChart" style="height: 300px;"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4">
                <div class="card h-100">
                    <div class="card-header">
                        <h4>Status Pendaftaran</h4>
                    </div>
                    <div class="card-body d-flex flex-column">
                        <div style="height: 200px; position: relative;">
                            <canvas id="statusChart"></canvas>
                        </div>
                        <div class="mt-3 flex-grow-1">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-success">
                                    <i class="bi bi-check-circle-fill me-1"></i>Selesai
                                </span>
                                <span class="fw-bold">{{ $statusDistribution['selesai'] }} ({{ $totalPendaftar > 0 ? round(($statusDistribution['selesai'] / $totalPendaftar) * 100) : 0 }}%)</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-warning">
                                    <i class="bi bi-clock-fill me-1"></i>Proses
                                </span>
                                <span class="fw-bold">{{ $statusDistribution['proses'] }} ({{ $totalPendaftar > 0 ? round(($statusDistribution['proses'] / $totalPendaftar) * 100) : 0 }}%)</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span class="text-danger">
                                    <i class="bi bi-x-circle-fill me-1"></i>Belum
                                </span>
                                <span class="fw-bold">{{ $statusDistribution['belum'] }} ({{ $totalPendaftar > 0 ? round(($statusDistribution['belum'] / $totalPendaftar) * 100) : 0 }}%)</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Data Terbaru -->
    <section class="section">
        <div class="row">
            <!-- Calon Siswa Terbaru -->
            <div class="col-12 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Calon Siswa Terbaru</h4>
                    </div>
                    <div class="card-body">
                        <div class="list-group">
                            @forelse($pendaftarTerbaru as $pendaftar)
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-1">{{ $pendaftar->dataSiswa->nama ?? 'Nama tidak tersedia' }}</h6>
                                    <small class="text-muted">{{ $pendaftar->asalSekolah->nama_sekolah ?? 'Sekolah tidak tersedia' }} - {{ \Carbon\Carbon::parse($pendaftar->tanggal_daftar)->format('d/m/Y') }}</small>
                                </div>
                                <span class="badge {{ $pendaftar->status == 'ADM_PASS' ? 'bg-success' : ($pendaftar->status == 'ADM_REJECT' ? 'bg-danger' : 'bg-warning') }}">
                                    {{ $pendaftar->status == 'ADM_PASS' ? 'Selesai' : ($pendaftar->status == 'ADM_REJECT' ? 'Ditolak' : 'Proses') }}
                                </span>
                            </div>
                            @empty
                            <div class="list-group-item text-center text-muted">
                                Belum ada pendaftar
                            </div>
                            @endforelse
                        </div>
                        <div class="text-center mt-3">
                            <a href="/kepala-sekolah/calon-siswa" class="btn btn-outline-primary btn-sm">Lihat Semua</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pembayaran Terbaru -->
            <div class="col-12 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Pembayaran Terbaru</h4>
                    </div>
                    <div class="card-body">
                        <div class="list-group">
                            @forelse($pembayaranTerbaru as $pembayaran)
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-1">{{ $pembayaran->no_pendaftaran }}</h6>
                                    <small class="text-muted">{{ $pembayaran->dataSiswa->nama ?? 'Nama tidak tersedia' }} - {{ \Carbon\Carbon::parse($pembayaran->tanggal_daftar)->format('d/m/Y') }}</small>
                                </div>
                                @if($pembayaran->pembayaran)
                                    @if($pembayaran->pembayaran->status == 'VERIFIED')
                                        <span class="badge bg-success">Rp {{ number_format($pembayaran->pembayaran->jumlah, 0, ',', '.') }}</span>
                                    @else
                                        <span class="badge bg-warning">Menunggu</span>
                                    @endif
                                @else
                                    <span class="badge bg-secondary">Belum Bayar</span>
                                @endif
                            </div>
                            @empty
                            <div class="list-group-item text-center text-muted">
                                Belum ada pembayaran
                            </div>
                            @endforelse
                        </div>
                        <div class="text-center mt-3">
                            <a href="/kepala-sekolah/pembayaran" class="btn btn-outline-primary btn-sm">Lihat Semua</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Quick Actions -->
    <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Akses Cepat</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6 col-md-3">
                                <a href="{{ route('kepsek.calon_siswa') }}" class="btn btn-primary w-100 mb-2">
                                    <i class="bi bi-people me-2"></i>Pendaftar vs Kuota
                                </a>
                            </div>
                            <div class="col-6 col-md-3">
                                <a href="{{ route('kepsek.asal_sekolah') }}" class="btn btn-success w-100 mb-2">
                                    <i class="bi bi-building me-2"></i>Asal Sekolah
                                </a>
                            </div>
                            <div class="col-6 col-md-3">
                                <a href="{{ route('kepsek.asal_wilayah') }}" class="btn btn-warning w-100 mb-2">
                                    <i class="bi bi-geo-alt me-2"></i>Asal Wilayah
                                </a>
                            </div>
                            <div class="col-6 col-md-3">
                                <a href="{{ route('kepsek.rekap_pembayaran') }}" class="btn btn-info w-100 mb-2">
                                    <i class="bi bi-bar-chart me-2"></i>Rekap Pembayaran
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
                        
            </div>
        </div>
    </section>
</div>

<style>
    .stats-icon.orange {
        background: rgba(253, 126, 20, 0.1);
        color: #fd7e14;
    }
    
    .quick-action-card {
        transition: transform 0.3s ease;
        border: none;
        box-shadow: 0 2px 10px rgba(0,0,0,0.08);
    }
    
    .quick-action-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 20px rgba(0,0,0,0.15);
    }
    
    .action-icon {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        margin-bottom: 1rem;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Data dari controller
        const trenData = @json($trenHarian);
        const statusData = @json($statusDistribution);
        
        // Tren Harian Chart
        const trenCtx = document.getElementById('trenChart').getContext('2d');
        new Chart(trenCtx, {
            type: 'line',
            data: {
                labels: trenData.map(item => item.tanggal),
                datasets: [{
                    label: 'Pendaftar per Hari',
                    data: trenData.map(item => item.jumlah),
                    borderColor: '#435ebe',
                    backgroundColor: 'rgba(67, 94, 190, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
        
        // Status Distribution Chart
        const statusCtx = document.getElementById('statusChart').getContext('2d');
        new Chart(statusCtx, {
            type: 'doughnut',
            data: {
                labels: ['Selesai', 'Proses', 'Belum'],
                datasets: [{
                    data: [statusData.selesai, statusData.proses, statusData.belum],
                    backgroundColor: ['#28a745', '#ffc107', '#dc3545'],
                    borderWidth: 2,
                    borderColor: '#fff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    });
</script>
@endsection