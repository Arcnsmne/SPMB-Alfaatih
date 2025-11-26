@extends('layout.keuangan')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Rekap Pembayaran</h3>
                <p class="text-subtitle text-muted">Laporan dan statistik pembayaran PPDB</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('keuangan.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Rekap Pembayaran</li>
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
                                    <i class="bi bi-wallet2"></i>
                                </div>
                            </div>
                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                <h6 class="text-muted font-semibold">Total Pendapatan</h6>
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
                                    <i class="bi bi-receipt"></i>
                                </div>
                            </div>
                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                <h6 class="text-muted font-semibold">Total Pembayaran</h6>
                                <h6 class="font-extrabold mb-0">{{ $totalPembayaran }}</h6>
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
                                    <i class="bi bi-check-circle"></i>
                                </div>
                            </div>
                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                <h6 class="text-muted font-semibold">Terverifikasi</h6>
                                <h6 class="font-extrabold mb-0">{{ $pembayaranVerified }}</h6>
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
                                    <i class="bi bi-clock"></i>
                                </div>
                            </div>
                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                <h6 class="text-muted font-semibold">Menunggu</h6>
                                <h6 class="font-extrabold mb-0">{{ $pembayaranPending }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Rekap per Jurusan -->
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Rekap Pembayaran per Jurusan</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Jurusan</th>
                                <th>Jumlah Siswa</th>
                                <th>Total Pembayaran</th>
                                <th>Rata-rata</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($rekapJurusan as $namaJurusan => $data)
                            <tr>
                                <td><strong>{{ $namaJurusan ?? 'Tidak Diketahui' }}</strong></td>
                                <td>{{ $data['jumlah'] }} siswa</td>
                                <td><strong>Rp {{ number_format($data['total'], 0, ',', '.') }}</strong></td>
                                <td>Rp {{ number_format($data['jumlah'] > 0 ? $data['total'] / $data['jumlah'] : 0, 0, ',', '.') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">Belum ada data pembayaran</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <!-- Daftar Semua Pembayaran -->
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Daftar Semua Pembayaran</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover" id="tableRekap">
                        <thead>
                            <tr>
                                <th>No. Pendaftaran</th>
                                <th>Nama Siswa</th>
                                <th>Jurusan</th>
                                <th>Tanggal Daftar</th>
                                <th>Jumlah Bayar</th>
                                <th>Status</th>
                                <th>Verifikator</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pembayaran as $item)
                            <tr>
                                <td><strong>{{ $item->no_pendaftaran }}</strong></td>
                                <td>{{ $item->dataSiswa->nama ?? '-' }}</td>
                                <td>{{ $item->jurusan->nama ?? '-' }}</td>
                                <td>{{ $item->tanggal_daftar ? \Carbon\Carbon::parse($item->tanggal_daftar)->format('d/m/Y') : '-' }}</td>
                                <td><strong>Rp {{ number_format($item->pembayaran->jumlah ?? 0, 0, ',', '.') }}</strong></td>
                                <td>
                                    @if($item->pembayaran)
                                        @if($item->pembayaran->status == 'VERIFIED')
                                            <span class="badge bg-success">TERVERIFIKASI</span>
                                        @elseif($item->pembayaran->status == 'PENDING')
                                            <span class="badge bg-warning">MENUNGGU</span>
                                        @elseif($item->pembayaran->status == 'REJECTED')
                                            <span class="badge bg-danger">DITOLAK</span>
                                        @endif
                                    @endif
                                </td>
                                <td>{{ $item->user_verifikasi_payment ?? '-' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        $('#tableRekap').DataTable({
            "pageLength": 25,
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
    });
</script>
@endsection