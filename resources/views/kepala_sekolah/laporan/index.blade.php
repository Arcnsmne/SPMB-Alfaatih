@extends('layout.kepalasekolah')

@section('title', 'Laporan & Rekap - Kepala Sekolah')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Laporan & Rekap</h3>
                <p class="text-subtitle text-muted">Laporan komprehensif dan analisis data penerimaan siswa</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/kepala-sekolah">Kepala Sekolah</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Laporan & Rekap</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <!-- Statistik Overview -->
    <section class="section">
        <div class="row">
            <div class="col-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 class="text-muted font-semibold">Total Pendaftar</h6>
                                <h4 class="font-extrabold mb-0">156</h4>
                                <small class="text-success">+12% dari target</small>
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
                                <h6 class="text-muted font-semibold">Pendapatan</h6>
                                <h4 class="font-extrabold mb-0">Rp 355Jt</h4>
                                <small class="text-success">91% completion</small>
                            </div>
                            <div class="stats-icon green">
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
                                <h4 class="font-extrabold mb-0">24</h4>
                                <small>Different schools</small>
                            </div>
                            <div class="stats-icon purple">
                                <i class="bi bi-building"></i>
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
                                <h6 class="text-muted font-semibold">Wilayah</h6>
                                <h4 class="font-extrabold mb-0">18</h4>
                                <small>Kecamatan</small>
                            </div>
                            <div class="stats-icon orange">
                                <i class="bi bi-map"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Generator Laporan -->
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Generator Laporan</h4>
                <p class="text-subtitle text-muted">Buat laporan sesuai kebutuhan</p>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="jenisLaporan" class="form-label">Jenis Laporan</label>
                            <select class="form-select" id="jenisLaporan">
                                <option value="rekap_harian">Rekap Harian</option>
                                <option value="rekap_mingguan">Rekap Mingguan</option>
                                <option value="rekap_bulanan" selected>Rekap Bulanan</option>
                                <option value="rekap_tahunan">Rekap Tahunan</option>
                                <option value="analisis_sekolah">Analisis Sekolah Asal</option>
                                <option value="analisis_wilayah">Analisis Wilayah</option>
                                <option value="laporan_keuangan">Laporan Keuangan</option>
                                <option value="laporan_pendaftaran">Laporan Pendaftaran</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="periodeLaporan" class="form-label">Periode</label>
                            <select class="form-select" id="periodeLaporan">
                                <option value="mei_2024" selected>Mei 2024</option>
                                <option value="april_2024">April 2024</option>
                                <option value="maret_2024">Maret 2024</option>
                                <option value="q1_2024">Q1 2024</option>
                                <option value="q2_2024">Q2 2024</option>
                                <option value="2024">Tahun 2024</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="formatLaporan" class="form-label">Format</label>
                            <select class="form-select" id="formatLaporan">
                                <option value="pdf" selected>PDF</option>
                                <option value="excel">Excel</option>
                                <option value="word">Word</option>
                                <option value="presentasi">Presentasi</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="kustomisasiLaporan" class="form-label">Kustomisasi</label>
                            <select class="form-select" id="kustomisasiLaporan">
                                <option value="ringkas" selected>Ringkas</option>
                                <option value="detail">Detail Lengkap</option>
                                <option value="grafik">Dengan Grafik</option>
                                <option value="analisis">Dengan Analisis</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="form-label">&nbsp;</label>
                            <div class="d-grid gap-2">
                                <button class="btn btn-primary">
                                    <i class="bi bi-gear me-1"></i> Generate
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Laporan Cepat -->
    <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Laporan Cepat</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 col-6">
                                <div class="card quick-action-card">
                                    <div class="card-body text-center">
                                        <div class="action-icon mx-auto bg-primary">
                                            <i class="bi bi-file-text text-white"></i>
                                        </div>
                                        <h6>Rekap Harian</h6>
                                        <p class="text-muted small">Laporan aktivitas hari ini</p>
                                        <button class="btn btn-sm btn-outline-primary">Generate</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-6">
                                <div class="card quick-action-card">
                                    <div class="card-body text-center">
                                        <div class="action-icon mx-auto bg-success">
                                            <i class="bi bi-cash-coin text-white"></i>
                                        </div>
                                        <h6>Laporan Keuangan</h6>
                                        <p class="text-muted small">Ringkasan pembayaran</p>
                                        <button class="btn btn-sm btn-outline-success">Generate</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-6">
                                <div class="card quick-action-card">
                                    <div class="card-body text-center">
                                        <div class="action-icon mx-auto bg-info">
                                            <i class="bi bi-building text-white"></i>
                                        </div>
                                        <h6>Analisis Sekolah</h6>
                                        <p class="text-muted small">Data sekolah asal</p>
                                        <button class="btn btn-sm btn-outline-info">Generate</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-6">
                                <div class="card quick-action-card">
                                    <div class="card-body text-center">
                                        <div class="action-icon mx-auto bg-warning">
                                            <i class="bi bi-map text-white"></i>
                                        </div>
                                        <h6>Analisis Wilayah</h6>
                                        <p class="text-muted small">Distribusi geografis</p>
                                        <button class="btn btn-sm btn-outline-warning">Generate</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Laporan Bulanan -->
    <section class="section">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Rekap Bulanan - Mei 2024</h4>
                    <div class="btn-group">
                        <button class="btn btn-success">
                            <i class="bi bi-file-earmark-excel me-1"></i> Excel
                        </button>
                        <button class="btn btn-danger">
                            <i class="bi bi-file-earmark-pdf me-1"></i> PDF
                        </button>
                        <button class="btn btn-outline-primary">
                            <i class="bi bi-printer me-1"></i> Print
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <!-- Statistik Bulanan -->
                <div class="row mb-4">
                    <div class="col-md-3">
                        <div class="card bg-light">
                            <div class="card-body text-center py-3">
                                <h6 class="text-muted">Pendaftar Baru</h6>
                                <h4 class="text-primary">156</h4>
                                <small>+12% dari bulan lalu</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-light">
                            <div class="card-body text-center py-3">
                                <h6 class="text-muted">Pembayaran Lunas</h6>
                                <h4 class="text-success">142</h4>
                                <small>91% completion rate</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-light">
                            <div class="card-body text-center py-3">
                                <h6 class="text-muted">Total Pendapatan</h6>
                                <h4 class="text-success">Rp 355Jt</h4>
                                <small>Dari 142 siswa</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-light">
                            <div class="card-body text-center py-3">
                                <h6 class="text-muted">Rata-rata per Siswa</h6>
                                <h4 class="text-info">Rp 2.5Jt</h4>
                                <small>Standard fee</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Grafik Trend -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>Trend Pendaftaran Bulan Mei 2024</h5>
                            </div>
                            <div class="card-body">
                                <div class="placeholder-chart" style="min-height: 300px;">
                                    <div class="text-center text-muted">
                                        <i class="bi bi-graph-up" style="font-size: 3rem;"></i>
                                        <p class="mt-2">Grafik Trend Pendaftaran Harian</p>
                                        <small>Line chart menunjukkan perkembangan pendaftaran per hari di bulan Mei</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tabel Rekap -->
                <div class="row">
                    <div class="col-12">
                        <h5 class="mb-3">Rekap Detail Bulanan</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th>Metric</th>
                                        <th>Total</th>
                                        <th>Target</th>
                                        <th>Pencapaian</th>
                                        <th>Growth vs Bulan Lalu</th>
                                        <th>Growth vs Tahun Lalu</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><strong>Pendaftar Baru</strong></td>
                                        <td>156</td>
                                        <td>140</td>
                                        <td><span class="badge bg-success">111%</span></td>
                                        <td class="text-success">+12%</td>
                                        <td class="text-success">+18%</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Pembayaran Lunas</strong></td>
                                        <td>142</td>
                                        <td>135</td>
                                        <td><span class="badge bg-success">105%</span></td>
                                        <td class="text-success">+8%</td>
                                        <td class="text-success">+15%</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Total Pendapatan</strong></td>
                                        <td>Rp 355,000,000</td>
                                        <td>Rp 337,500,000</td>
                                        <td><span class="badge bg-success">105%</span></td>
                                        <td class="text-success">+10%</td>
                                        <td class="text-success">+22%</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Sekolah Asal</strong></td>
                                        <td>24</td>
                                        <td>20</td>
                                        <td><span class="badge bg-success">120%</span></td>
                                        <td class="text-success">+3 sekolah</td>
                                        <td class="text-success">+5 sekolah</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Wilayah Baru</strong></td>
                                        <td>3</td>
                                        <td>2</td>
                                        <td><span class="badge bg-success">150%</span></td>
                                        <td class="text-success">+1 wilayah</td>
                                        <td class="text-success">+2 wilayah</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Analisis Performa -->
                <div class="row mt-4">
                    <div class="col-12 col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h5>Top 5 Sekolah Asal</h5>
                            </div>
                            <div class="card-body">
                                <div class="list-group">
                                    <div class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="mb-1">SMP Negeri 1 Jakarta</h6>
                                            <small class="text-muted">Gambir - Jakarta Pusat</small>
                                        </div>
                                        <span class="badge bg-primary rounded-pill">18 siswa</span>
                                    </div>
                                    <div class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="mb-1">SMP Islam Terpadu</h6>
                                            <small class="text-muted">Menteng - Jakarta Pusat</small>
                                        </div>
                                        <span class="badge bg-primary rounded-pill">15 siswa</span>
                                    </div>
                                    <div class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="mb-1">SMP Kristen Penabur</h6>
                                            <small class="text-muted">Tanah Abang - Jakarta Pusat</small>
                                        </div>
                                        <span class="badge bg-primary rounded-pill">12 siswa</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h5>Top 5 Wilayah</h5>
                            </div>
                            <div class="card-body">
                                <div class="list-group">
                                    <div class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="mb-1">Gambir</h6>
                                            <small class="text-muted">Jakarta Pusat</small>
                                        </div>
                                        <span class="badge bg-success rounded-pill">22 siswa</span>
                                    </div>
                                    <div class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="mb-1">Menteng</h6>
                                            <small class="text-muted">Jakarta Pusat</small>
                                        </div>
                                        <span class="badge bg-success rounded-pill">18 siswa</span>
                                    </div>
                                    <div class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="mb-1">Kebayoran Baru</h6>
                                            <small class="text-muted">Jakarta Selatan</small>
                                        </div>
                                        <span class="badge bg-success rounded-pill">15 siswa</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Insights & Rekomendasi -->
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>Insights & Rekomendasi Strategis</h5>
                            </div>
                            <div class="card-body">
                                <div class="alert alert-success">
                                    <h6><i class="bi bi-check-circle me-2"></i>Pencapaian Positif</h6>
                                    <ul class="mb-0">
                                        <li>Melebihi target pendaftar sebesar 11%</li>
                                        <li>Pertumbuhan 18% dibandingkan tahun lalu</li>
                                        <li>Ekspansi ke 3 wilayah baru berhasil</li>
                                        <li>Retensi dari sekolah feeder meningkat</li>
                                    </ul>
                                </div>
                                <div class="alert alert-warning">
                                    <h6><i class="bi bi-lightbulb me-2"></i>Rekomendasi</h6>
                                    <ul class="mb-0">
                                        <li>Intensifkan marketing di Jakarta Selatan dan Barat</li>
                                        <li>Perluas kerjasama dengan sekolah di wilayah Cilandak</li>
                                        <li>Optimasi proses pembayaran untuk mengurangi pending</li>
                                        <li>Develop program khusus untuk sekolah dengan potensi tinggi</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Riwayat Laporan -->
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Riwayat Laporan Tersimpan</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover" id="tableRiwayatLaporan">
                        <thead>
                            <tr>
                                <th width="100">Tanggal</th>
                                <th>Nama Laporan</th>
                                <th width="120">Jenis</th>
                                <th width="100">Format</th>
                                <th width="120">Ukuran</th>
                                <th width="100">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>20/05/2024</td>
                                <td>
                                    <strong>Rekap Bulanan Mei 2024</strong><br>
                                    <small class="text-muted">Laporan komprehensif bulan Mei</small>
                                </td>
                                <td><span class="badge bg-primary">Bulanan</span></td>
                                <td>PDF</td>
                                <td>2.4 MB</td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-download"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-success">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>15/05/2024</td>
                                <td>
                                    <strong>Analisis Sekolah Asal</strong><br>
                                    <small class="text-muted">Data detail sekolah feeder</small>
                                </td>
                                <td><span class="badge bg-info">Analisis</span></td>
                                <td>Excel</td>
                                <td>1.8 MB</td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-download"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-success">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>10/05/2024</td>
                                <td>
                                    <strong>Laporan Keuangan Mingguan</strong><br>
                                    <small class="text-muted">Minggu kedua Mei 2024</small>
                                </td>
                                <td><span class="badge bg-success">Mingguan</span></td>
                                <td>PDF</td>
                                <td>1.2 MB</td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-download"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-success">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>01/05/2024</td>
                                <td>
                                    <strong>Rekap April 2024</strong><br>
                                    <small class="text-muted">Laporan akhir bulan April</small>
                                </td>
                                <td><span class="badge bg-primary">Bulanan</span></td>
                                <td>PDF</td>
                                <td>2.1 MB</td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-download"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-success">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

<style>
    .table th {
        background-color: #f8f9fa;
        font-weight: 600;
    }
    
    .table-bordered th,
    .table-bordered td {
        border: 1px solid #dee2e6;
    }
    
    .badge {
        font-size: 0.75rem;
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
    
    .stats-icon.blue { background: rgba(13, 110, 253, 0.1); color: #0d6efd; }
    .stats-icon.green { background: rgba(25, 135, 84, 0.1); color: #198754; }
    .stats-icon.purple { background: rgba(102, 16, 242, 0.1); color: #6610f2; }
    .stats-icon.orange { background: rgba(253, 126, 20, 0.1); color: #fd7e14; }
    
    .list-group-item {
        border-left: none;
        border-right: none;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Inisialisasi DataTables
        $('#tableRiwayatLaporan').DataTable({
            "pageLength": 10,
            "ordering": true,
            "order": [[0, 'desc']],
            "language": {
                "search": "Cari:",
                "lengthMenu": "Tampilkan _MENU_ data per halaman",
                "zeroRecords": "Tidak ada data yang ditemukan",
                "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
                "infoEmpty": "Tidak ada data",
                "infoFiltered": "(disaring dari _MAX_ total data)",
                "paginate": {
                    "first": "Pertama",
                    "last": "Terakhir",
                    "next": "Selanjutnya",
                    "previous": "Sebelumnya"
                }
            }
        });

        // Generate laporan
        document.querySelector('.btn-primary').addEventListener('click', function() {
            const jenisLaporan = document.getElementById('jenisLaporan').value;
            const periode = document.getElementById('periodeLaporan').value;
            const format = document.getElementById('formatLaporan').value;
            const kustomisasi = document.getElementById('kustomisasiLaporan').value;
            
            console.log('Generate laporan:', { jenisLaporan, periode, format, kustomisasi });
            // Logic generate laporan akan ditambahkan di sini
        });

        // Laporan cepat
        const quickReportButtons = document.querySelectorAll('.quick-action-card .btn');
        quickReportButtons.forEach(button => {
            button.addEventListener('click', function() {
                const reportType = this.closest('.card').querySelector('h6').textContent;
                console.log('Generate laporan cepat:', reportType);
                // Logic laporan cepat akan ditambahkan di sini
            });
        });

        // Export buttons
        document.querySelector('.btn-success').addEventListener('click', function() {
            console.log('Export ke Excel');
            // Logic export Excel akan ditambahkan di sini
        });

        document.querySelector('.btn-danger').addEventListener('click', function() {
            console.log('Export ke PDF');
            // Logic export PDF akan ditambahkan di sini
        });

        document.querySelector('.btn-outline-primary').addEventListener('click', function() {
            console.log('Print laporan');
            // Logic print akan ditambahkan di sini
        });

        // Riwayat laporan actions
        const downloadButtons = document.querySelectorAll('.btn-outline-primary');
        downloadButtons.forEach(button => {
            if (button.querySelector('.bi-download')) {
                button.addEventListener('click', function() {
                    const reportName = this.closest('tr').querySelector('strong').textContent;
                    console.log('Download laporan:', reportName);
                    // Logic download akan ditambahkan di sini
                });
            }
        });

        const viewButtons = document.querySelectorAll('.btn-outline-success');
        viewButtons.forEach(button => {
            if (button.querySelector('.bi-eye')) {
                button.addEventListener('click', function() {
                    const reportName = this.closest('tr').querySelector('strong').textContent;
                    console.log('Lihat laporan:', reportName);
                    // Logic view akan ditambahkan di sini
                });
            }
        });
    });
</script>
@endsection