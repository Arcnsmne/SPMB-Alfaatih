@extends('layout.keuangan')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Dashboard Keuangan</h3>
                <p class="text-subtitle text-muted">Ringkasan dan monitoring sistem keuangan</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/keuangan">Keuangan</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <!-- Statistik Cards -->
    <section class="section">
        <div class="row">
            <div class="col-6 col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body px-4 py-4-5">
                        <div class="row">
                            <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                <div class="stats-icon purple mb-2">
                                    <i class="iconly-boldWallet"></i>
                                </div>
                            </div>
                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                <h6 class="text-muted font-semibold">Total Pendapatan Bulan Ini</h6>
                                <h6 class="font-extrabold mb-0">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body px-4 py-4-5">
                        <div class="row">
                            <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                <div class="stats-icon blue mb-2">
                                    <i class="iconly-boldTime-Circle"></i>
                                </div>
                            </div>
                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                <h6 class="text-muted font-semibold">Menunggu Verifikasi</h6>
                                <h6 class="font-extrabold mb-0">{{ $menungguVerifikasi }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body px-4 py-4-5">
                        <div class="row">
                            <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                <div class="stats-icon green mb-2">
                                    <i class="iconly-boldTick-Square"></i>
                                </div>
                            </div>
                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                <h6 class="text-muted font-semibold">Pembayaran Lunas</h6>
                                <h6 class="font-extrabold mb-0">{{ $pembayaranLunas }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body px-4 py-4-5">
                        <div class="row">
                            <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                <div class="stats-icon red mb-2">
                                    <i class="iconly-boldClose-Square"></i>
                                </div>
                            </div>
                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                <h6 class="text-muted font-semibold">Pembayaran Tertunggak</h6>
                                <h6 class="font-extrabold mb-0">{{ $pembayaranTertunggak }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Chart dan Data Terbaru -->
    <section class="section">
        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h4>Grafik Pendapatan 6 Bulan Terakhir</h4>
                    </div>
                    <div class="card-body">
                        <canvas id="revenueChart" style="height: 300px;"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h4>Pembayaran Perlu Verifikasi</h4>
                    </div>
                    <div class="card-body">
                        @forelse($pendingPayments as $payment)
                        <div class="alert alert-light-warning alert-dismissible show fade mb-2">
                            <div class="alert-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong>{{ $payment->no_pendaftaran }}</strong><br>
                                        <small>{{ $payment->dataSiswa->nama ?? '-' }}</small><br>
                                        <span class="badge bg-warning">Rp {{ number_format($payment->pembayaran->jumlah ?? 0, 0, ',', '.') }}</span>
                                    </div>
                                    <a href="{{ route('keuangan.verifikasi_pembayaran.show', $payment->id) }}" class="btn btn-sm btn-primary">Verifikasi</a>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-3">
                            <i class="bi bi-check-circle text-success" style="font-size: 2rem;"></i>
                            <p class="text-muted mt-2">Tidak ada pembayaran yang menunggu verifikasi</p>
                        </div>
                        @endforelse

                        <div class="text-center mt-3">
                            <a href="{{ route('keuangan.verifikasi_pembayaran') }}" class="btn btn-outline-primary btn-sm">Lihat Semua</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tabel Pembayaran Terbaru -->
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4>Pembayaran Terbaru</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover" id="table1">
                        <thead>
                            <tr>
                                <th>No. Pendaftaran</th>
                                <th>Nama Siswa</th>
                                <th>Tanggal</th>
                                <th>Jumlah</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentPayments as $payment)
                            <tr>
                                <td><strong>{{ $payment->no_pendaftaran }}</strong></td>
                                <td>{{ $payment->dataSiswa->nama ?? '-' }}</td>
                                <td>{{ $payment->tanggal_daftar ? \Carbon\Carbon::parse($payment->tanggal_daftar)->format('d/m/Y') : '-' }}</td>
                                <td>Rp {{ number_format($payment->pembayaran->jumlah ?? 0, 0, ',', '.') }}</td>
                                <td>
                                    @if($payment->pembayaran)
                                        @if($payment->pembayaran->status == 'VERIFIED')
                                            <span class="badge bg-success">LUNAS</span>
                                        @elseif($payment->pembayaran->status == 'PENDING')
                                            <span class="badge bg-warning">MENUNGGU</span>
                                        @elseif($payment->pembayaran->status == 'REJECTED')
                                            <span class="badge bg-danger">DITOLAK</span>
                                        @endif
                                    @else
                                        <span class="badge bg-secondary">BELUM BAYAR</span>
                                    @endif
                                </td>
                                <td>
                                    @if($payment->pembayaran && $payment->pembayaran->status == 'PENDING')
                                        <a href="{{ route('keuangan.verifikasi_pembayaran.show', $payment->id) }}" class="btn btn-sm btn-primary">Verifikasi</a>
                                    @else
                                        <a href="#" class="btn btn-sm btn-outline-primary">Detail</a>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">Belum ada data pembayaran</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="text-center mt-3">
                    <a href="/keuangan/daftar-pembayaran" class="btn btn-primary">Lihat Semua Pembayaran</a>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Script untuk chart -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Data dari controller
        const chartLabels = @json($chartLabels);
        const chartData = @json($chartData);
        
        // Konfigurasi chart
        const ctx = document.getElementById('revenueChart').getContext('2d');
        const revenueChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: chartLabels,
                datasets: [{
                    label: 'Pendapatan (Rp)',
                    data: chartData,
                    borderColor: '#435ebe',
                    backgroundColor: 'rgba(67, 94, 190, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: '#435ebe',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 6
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
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'Rp ' + new Intl.NumberFormat('id-ID').format(value);
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                },
                elements: {
                    point: {
                        hoverRadius: 8
                    }
                }
            }
        });
    });
</script>
@endsection