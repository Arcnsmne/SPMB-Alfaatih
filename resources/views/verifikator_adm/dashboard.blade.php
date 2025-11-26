@extends('layout.verifikator_adm')

@section('title', 'Dashboard Verifikator')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Dashboard Verifikator Administrasi</h3>
                <p class="text-subtitle text-muted">Monitor dan verifikasi berkas pendaftaran</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('verifikator_adm.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Home</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="row">
        <div class="col-6 col-lg-3 col-md-6">
            <div class="card stats-card">
                <div class="card-body">
                    <div class="stats-icon" style="background: #e3f2fd; color: #2196f3;">
                        <i class="bi bi-files"></i>
                    </div>
                    <h6 class="text-muted font-semibold">Total Berkas</h6>
                    <h4 class="font-extrabold mb-0">{{ $totalBerkas }}</h4>
                    <p class="mb-0 text-muted">Semua berkas</p>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3 col-md-6">
            <div class="card stats-card">
                <div class="card-body">
                    <div class="stats-icon" style="background: #fff3e0; color: #ff9800;">
                        <i class="bi bi-clock-history"></i>
                    </div>
                    <h6 class="text-muted font-semibold">Menunggu Verifikasi</h6>
                    <h4 class="font-extrabold mb-0">{{ $menungguVerifikasi }}</h4>
                    <p class="mb-0 text-muted">Perlu tindakan</p>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3 col-md-6">
            <div class="card stats-card">
                <div class="card-body">
                    <div class="stats-icon" style="background: #e8f5e8; color: #4caf50;">
                        <i class="bi bi-check-circle"></i>
                    </div>
                    <h6 class="text-muted font-semibold">Terverifikasi</h6>
                    <h4 class="font-extrabold mb-0">{{ $terverifikasi }}</h4>
                    <p class="mb-0 text-muted">Berkas valid</p>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3 col-md-6">
            <div class="card stats-card">
                <div class="card-body">
                    <div class="stats-icon" style="background: #ffebee; color: #f44336;">
                        <i class="bi bi-x-circle"></i>
                    </div>
                    <h6 class="text-muted font-semibold">Ditolak</h6>
                    <h4 class="font-extrabold mb-0">{{ $ditolak }}</h4>
                    <p class="mb-0 text-muted">Perlu revisi</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <!-- Berkas Menunggu Verifikasi -->
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Pendaftaran Menunggu Verifikasi</h4>
                    <p class="card-subtitle">Data pendaftaran yang perlu segera diverifikasi</p>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>No. Pendaftaran</th>
                                    <th>Nama Calon Siswa</th>
                                    <th>Jurusan</th>
                                    <th>Berkas</th>
                                    <th>Tanggal Daftar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pendaftaranMenunggu as $p)
                                <tr>
                                    <td>{{ $p->no_pendaftaran }}</td>
                                    <td>
                                        <div>
                                            <h6 class="mb-0">{{ $p->dataSiswa->nama ?? '-' }}</h6>
                                            <small class="text-muted">{{ $p->dataSiswa->nisn ?? '-' }}</small>
                                        </div>
                                    </td>
                                    <td>{{ $p->jurusan->kode ?? '-' }}</td>
                                    <td>
                                        @php
                                            $totalBerkasItem = $p->berkas->count();
                                            $berkasValid = $p->berkas->where('valid', 1)->count();
                                        @endphp
                                        @if($berkasValid > 0)
                                        <span class="verification-badge verified">{{ $berkasValid }}</span>
                                        @endif
                                        @if($totalBerkasItem - $berkasValid > 0)
                                        <span class="verification-badge pending">{{ $totalBerkasItem - $berkasValid }}</span>
                                        @endif
                                        <small class="text-muted">{{ $totalBerkasItem }}/6 berkas</small>
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($p->tanggal_daftar)->format('d M Y') }}</td>
                                    <td>
                                        <a href="{{ route('verifikator_adm.verifikasi_formulir.show', $p->id) }}" class="btn btn-primary btn-sm">
                                            <i class="bi bi-eye me-1"></i>Verifikasi
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center">Tidak ada data pendaftaran</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="text-center mt-3">
                        <a href="{{ route('verifikator_adm.data_verifikasi') }}" class="btn btn-outline-primary">
                            <i class="bi bi-list-check me-2"></i>Lihat Semua Data Verifikasi
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .verification-badge {
        width: 24px;
        height: 24px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 0.7rem;
        font-weight: 600;
        margin-right: 0.25rem;
    }
    
    .verified {
        background: #27ae60;
        color: white;
    }
    
    .pending {
        background: #e67e22;
        color: white;
    }
</style>
@endsection
