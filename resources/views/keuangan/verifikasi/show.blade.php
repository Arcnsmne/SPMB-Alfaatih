@extends('layout.keuangan')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Verifikasi Pembayaran</h3>
                <p class="text-subtitle text-muted">Verifikasi bukti pembayaran pendaftar</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('keuangan.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('keuangan.verifikasi_pembayaran') }}">Verifikasi</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $pendaftar->no_pendaftaran }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Data Pendaftar - {{ $pendaftar->no_pendaftaran }}</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6>Informasi Pendaftar</h6>
                        <table class="table table-borderless">
                            <tr>
                                <td width="150"><strong>No. Pendaftaran</strong></td>
                                <td>: {{ $pendaftar->no_pendaftaran }}</td>
                            </tr>
                            <tr>
                                <td><strong>Nama Lengkap</strong></td>
                                <td>: {{ $pendaftar->dataSiswa->nama ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td><strong>NISN</strong></td>
                                <td>: {{ $pendaftar->dataSiswa->nisn ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Jurusan</strong></td>
                                <td>: {{ $pendaftar->jurusan->nama ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Gelombang</strong></td>
                                <td>: {{ $pendaftar->gelombang->nama ?? '-' }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h6>Informasi Pembayaran</h6>
                        @if($pendaftar->pembayaran)
                        <table class="table table-borderless">
                            <tr>
                                <td width="150"><strong>Jumlah Bayar</strong></td>
                                <td>: <strong>Rp {{ number_format($pendaftar->pembayaran->jumlah ?? 0, 0, ',', '.') }}</strong></td>
                            </tr>
                            <tr>
                                <td><strong>Bank</strong></td>
                                <td>: {{ $pendaftar->pembayaran->bank ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Nama Pengirim</strong></td>
                                <td>: {{ $pendaftar->pembayaran->nama_pengirim ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td><strong>No. Rekening</strong></td>
                                <td>: {{ $pendaftar->pembayaran->no_rekening ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Tanggal Upload</strong></td>
                                <td>: {{ $pendaftar->pembayaran->created_at ? $pendaftar->pembayaran->created_at->format('d/m/Y H:i') : '-' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Status</strong></td>
                                <td>: 
                                    @if($pendaftar->pembayaran->status == 'PENDING')
                                        <span class="badge bg-warning">Menunggu Verifikasi</span>
                                    @elseif($pendaftar->pembayaran->status == 'VERIFIED')
                                        <span class="badge bg-success">Terverifikasi</span>
                                    @elseif($pendaftar->pembayaran->status == 'REJECTED')
                                        <span class="badge bg-danger">Ditolak</span>
                                    @endif
                                </td>
                            </tr>
                        </table>
                        @else
                        <p class="text-muted">Belum ada data pembayaran</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        @if($pendaftar->pembayaran && $pendaftar->pembayaran->bukti_transfer)
        <div class="card mt-4">
            <div class="card-header">
                <h4 class="card-title">Bukti Transfer</h4>
            </div>
            <div class="card-body text-center">
                <img src="{{ asset('storage/' . $pendaftar->pembayaran->bukti_transfer) }}" 
                     alt="Bukti Transfer" 
                     class="img-fluid rounded border" 
                     style="max-height: 500px;">
                <div class="mt-3">
                    <a href="{{ asset('storage/' . $pendaftar->pembayaran->bukti_transfer) }}" 
                       target="_blank" 
                       class="btn btn-outline-primary">
                        <i class="bi bi-arrows-fullscreen me-1"></i> Lihat Full Size
                    </a>
                </div>
            </div>
        </div>
        @endif

        @if($pendaftar->pembayaran && $pendaftar->pembayaran->status == 'PENDING')
        <div class="card mt-4">
            <div class="card-header">
                <h4 class="card-title">Aksi Verifikasi</h4>
            </div>
            <div class="card-body">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="d-flex justify-content-between gap-3">
                            <a href="{{ route('keuangan.verifikasi_pembayaran') }}" class="btn btn-outline-secondary flex-fill">
                                <i class="bi bi-arrow-left me-2"></i>Kembali
                            </a>
                            
                            <form action="{{ route('keuangan.verifikasi_pembayaran.selesai', $pendaftar->id) }}" method="POST" class="flex-fill">
                                @csrf
                                <input type="hidden" name="status" value="REJECTED">
                                <button type="submit" class="btn btn-outline-danger w-100" 
                                        onclick="return confirm('Apakah Anda yakin ingin menolak pembayaran ini?')">
                                    <i class="bi bi-x-circle me-2"></i>Tidak Disetujui
                                </button>
                            </form>
                            
                            <form action="{{ route('keuangan.verifikasi_pembayaran.selesai', $pendaftar->id) }}" method="POST" class="flex-fill">
                                @csrf
                                <input type="hidden" name="status" value="VERIFIED">
                                <button type="submit" class="btn btn-success w-100"
                                        onclick="return confirm('Apakah Anda yakin ingin menyetujui pembayaran ini?')">
                                    <i class="bi bi-check-circle me-2"></i>Disetujui
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </section>
</div>
@endsection