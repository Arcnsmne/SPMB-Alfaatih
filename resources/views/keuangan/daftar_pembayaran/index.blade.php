@extends('layout.keuangan')

@section('title', 'Seluruh Daftar Pembayaran - Sistem Keuangan')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Seluruh Daftar Pembayaran</h3>
                <p class="text-subtitle text-muted">Database lengkap semua transaksi pembayaran</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/keuangan">Keuangan</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Daftar Pembayaran</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <!-- Filter dan Pencarian -->
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Filter & Pencarian</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="filterStatus" class="form-label">Status</label>
                            <select class="form-select" id="filterStatus">
                                <option value="">Semua Status</option>
                                <option value="lunas">Lunas</option>
                                <option value="pending">Menunggu Verifikasi</option>
                                <option value="tertunggak">Tertunggak</option>
                                <option value="ditolak">Ditolak</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="filterMetode" class="form-label">Metode</label>
                            <select class="form-select" id="filterMetode">
                                <option value="">Semua Metode</option>
                                <option value="transfer">Transfer</option>
                                <option value="kartu_kredit">Kartu Kredit</option>
                                <option value="tunai">Tunai</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="filterBulan" class="form-label">Bulan</label>
                            <select class="form-select" id="filterBulan">
                                <option value="">Semua Bulan</option>
                                <option value="1">Januari</option>
                                <option value="2">Februari</option>
                                <option value="3">Maret</option>
                                <option value="4">April</option>
                                <option value="5" selected>Mei</option>
                                <option value="6">Juni</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="filterTahun" class="form-label">Tahun</label>
                            <select class="form-select" id="filterTahun">
                                <option value="2024" selected>2024</option>
                                <option value="2023">2023</option>
                                <option value="2022">2022</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="globalSearch" class="form-label">Pencarian Global</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="globalSearch" placeholder="Cari no. invoice, nama klien...">
                                <button class="btn btn-outline-primary" type="button" id="btnSearch">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12">
                        <button class="btn btn-primary me-2" id="btnApplyFilter">
                            <i class="bi bi-filter me-1"></i> Terapkan Filter
                        </button>
                        <button class="btn btn-outline-secondary" id="btnResetFilter">
                            <i class="bi bi-arrow-clockwise me-1"></i> Reset
                        </button>
                        <div class="btn-group float-end">
                            <button class="btn btn-success">
                                <i class="bi bi-download me-1"></i> Export
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Statistik Cepat -->
    <section class="section">
        <div class="row">
            <div class="col-6 col-lg-2">
                <div class="card">
                    <div class="card-body py-3">
                        <div class="text-center">
                            <h6 class="text-muted">Total Transaksi</h6>
                            <h4 class="fw-bold">156</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-2">
                <div class="card">
                    <div class="card-body py-3">
                        <div class="text-center">
                            <h6 class="text-muted">Total Nilai</h6>
                            <h4 class="fw-bold">Rp 425Jt</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-2">
                <div class="card">
                    <div class="card-body py-3">
                        <div class="text-center">
                            <h6 class="text-muted">Lunas</h6>
                            <h4 class="fw-bold text-success">142</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-2">
                <div class="card">
                    <div class="card-body py-3">
                        <div class="text-center">
                            <h6 class="text-muted">Pending</h6>
                            <h4 class="fw-bold text-warning">8</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-2">
                <div class="card">
                    <div class="card-body py-3">
                        <div class="text-center">
                            <h6 class="text-muted">Tertunggak</h6>
                            <h4 class="fw-bold text-danger">6</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-2">
                <div class="card">
                    <div class="card-body py-3">
                        <div class="text-center">
                            <h6 class="text-muted">Klien Aktif</h6>
                            <h4 class="fw-bold text-info">45</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tabel Master Ledger -->
    <section class="section">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Master Ledger - Semua Pembayaran</h4>
                    <div class="badge bg-primary">Total: Rp 425.750.000</div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover" id="tableMasterLedger">
                        <thead>
                            <tr>
                                <th width="100">Tanggal Bayar</th>
                                <th width="120">No. Invoice</th>
                                <th>Nama Klien</th>
                                <th width="200">Deskripsi</th>
                                <th width="130">Jumlah Tagihan</th>
                                <th width="130">Jumlah Dibayar</th>
                                <th width="100">Status</th>
                                <th width="100">Metode</th>
                                <th width="150">Keterangan</th>
                                <th width="120">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Data Lunas -->
                            <tr>
                                <td>15/05/2024</td>
                                <td>
                                    <a href="#" class="text-primary fw-bold">INV/2024/015</a>
                                </td>
                                <td>PT. Digital Solusi</td>
                                <td>Website Redesign Project</td>
                                <td>Rp 45.000.000</td>
                                <td>Rp 45.000.000</td>
                                <td><span class="badge bg-success">LUNAS</span></td>
                                <td><span class="badge bg-info">Transfer</span></td>
                                <td>-</td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-outline-primary" title="Detail">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-success" title="Download">
                                            <i class="bi bi-download"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>14/05/2024</td>
                                <td>
                                    <a href="#" class="text-primary fw-bold">INV/2024/014</a>
                                </td>
                                <td>CV. Kreatif Indonesia</td>
                                <td>Mobile App Development</td>
                                <td>Rp 28.500.000</td>
                                <td>Rp 28.500.000</td>
                                <td><span class="badge bg-success">LUNAS</span></td>
                                <td><span class="badge bg-success">Kartu Kredit</span></td>
                                <td>-</td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-outline-primary" title="Detail">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-success" title="Download">
                                            <i class="bi bi-download"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Data Pending -->
                            <tr>
                                <td>13/05/2024</td>
                                <td>
                                    <a href="#" class="text-primary fw-bold">INV/2024/013</a>
                                </td>
                                <td>PT. Maju Bersama</td>
                                <td>Consulting Services - Bulan Mei</td>
                                <td>Rp 32.000.000</td>
                                <td>Rp 32.000.000</td>
                                <td><span class="badge bg-warning">MENUNGGU</span></td>
                                <td><span class="badge bg-info">Transfer</span></td>
                                <td>Perlu konfirmasi bukti transfer</td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-outline-warning" title="Verifikasi">
                                            <i class="bi bi-check-circle"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-primary" title="Detail">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Data Tertunggak -->
                            <tr>
                                <td>-</td>
                                <td>
                                    <a href="#" class="text-primary fw-bold">INV/2024/011</a>
                                </td>
                                <td>CV. Anugerah Makmur</td>
                                <td>Social Media Management - Q2</td>
                                <td><strong>Rp 15.750.000</strong></td>
                                <td><strong>Rp 0</strong></td>
                                <td><span class="badge bg-danger">TERTUNGGAK</span></td>
                                <td><span class="badge bg-secondary">-</span></td>
                                <td><small class="text-danger">Jatuh tempo: 10/05/2024</small></td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-outline-danger" title="Reminder">
                                            <i class="bi bi-bell"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-primary" title="Detail">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>-</td>
                                <td>
                                    <a href="#" class="text-primary fw-bold">INV/2024/008</a>
                                </td>
                                <td>PT. Global Jaya</td>
                                <td>Training Workshop</td>
                                <td><strong>Rp 12.000.000</strong></td>
                                <td><strong>Rp 0</strong></td>
                                <td><span class="badge bg-danger">TERTUNGGAK</span></td>
                                <td><span class="badge bg-secondary">-</span></td>
                                <td><small class="text-danger">Jatuh tempo: 05/05/2024</small></td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-outline-danger" title="Reminder">
                                            <i class="bi bi-bell"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-primary" title="Detail">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Data Lainnya -->
                            <tr>
                                <td>10/05/2024</td>
                                <td>
                                    <a href="#" class="text-primary fw-bold">INV/2024/010</a>
                                </td>
                                <td>PT. Sinergi Abadi</td>
                                <td>Maintenance Services</td>
                                <td>Rp 8.500.000</td>
                                <td>Rp 8.500.000</td>
                                <td><span class="badge bg-success">LUNAS</span></td>
                                <td><span class="badge bg-warning">Tunai</span></td>
                                <td>Pembayaran di kantor</td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-outline-primary" title="Detail">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-success" title="Download">
                                            <i class="bi bi-download"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>08/05/2024</td>
                                <td>
                                    <a href="#" class="text-primary fw-bold">INV/2024/009</a>
                                </td>
                                <td>CV. Mandiri Sejahtera</td>
                                <td>Digital Marketing Package</td>
                                <td>Rp 22.000.000</td>
                                <td>Rp 22.000.000</td>
                                <td><span class="badge bg-success">LUNAS</span></td>
                                <td><span class="badge bg-success">Kartu Kredit</span></td>
                                <td>-</td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-outline-primary" title="Detail">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-success" title="Download">
                                            <i class="bi bi-download"></i>
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

    <!-- Pagination Info -->
    <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                Menampilkan 1 sampai 8 dari 156 entri
                            </div>
                            <nav aria-label="Page navigation">
                                <ul class="pagination mb-0">
                                    <li class="page-item disabled">
                                        <a class="page-link" href="#" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>
                                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item">
                                        <a class="page-link" href="#" aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<style>
    .table th {
        background-color: #f8f9fa;
        font-weight: 600;
        font-size: 0.875rem;
    }
    
    .table td {
        font-size: 0.875rem;
        vertical-align: middle;
    }
    
    .badge {
        font-size: 0.7rem;
    }
    
    .btn-group .btn {
        padding: 0.25rem 0.5rem;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Inisialisasi DataTables
        $('#tableMasterLedger').DataTable({
            "pageLength": 10,
            "ordering": true,
            "order": [[0, 'desc']], // Urutkan berdasarkan tanggal bayar descending
            "language": {
                "search": "Cari dalam tabel:",
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

        // Filter functionality
        document.getElementById('btnApplyFilter').addEventListener('click', function() {
            const status = document.getElementById('filterStatus').value;
            const metode = document.getElementById('filterMetode').value;
            const bulan = document.getElementById('filterBulan').value;
            const tahun = document.getElementById('filterTahun').value;
            const search = document.getElementById('globalSearch').value;
            
            console.log('Filter diterapkan:', { status, metode, bulan, tahun, search });
            // Logic filter akan ditambahkan di sini
        });

        document.getElementById('btnResetFilter').addEventListener('click', function() {
            document.getElementById('filterStatus').value = '';
            document.getElementById('filterMetode').value = '';
            document.getElementById('filterBulan').value = '';
            document.getElementById('filterTahun').value = '2024';
            document.getElementById('globalSearch').value = '';
            
            console.log('Filter direset');
            // Logic reset filter akan ditambahkan di sini
        });

        // Quick actions
        const detailButtons = document.querySelectorAll('.btn-outline-primary');
        detailButtons.forEach(button => {
            if (button.querySelector('.bi-eye')) {
                button.addEventListener('click', function() {
                    const invoice = this.closest('tr').querySelector('a').textContent;
                    console.log('Lihat detail:', invoice);
                    // Logic detail akan ditambahkan di sini
                });
            }
        });

        const verifikasiButtons = document.querySelectorAll('.btn-outline-warning');
        verifikasiButtons.forEach(button => {
            button.addEventListener('click', function() {
                const invoice = this.closest('tr').querySelector('a').textContent;
                console.log('Verifikasi:', invoice);
                // Logic verifikasi akan ditambahkan di sini
            });
        });

        const reminderButtons = document.querySelectorAll('.btn-outline-danger');
        reminderButtons.forEach(button => {
            if (button.querySelector('.bi-bell')) {
                button.addEventListener('click', function() {
                    const invoice = this.closest('tr').querySelector('a').textContent;
                    console.log('Kirim reminder untuk:', invoice);
                    // Logic reminder akan ditambahkan di sini
                });
            }
        });
    });
</script>
@endsection