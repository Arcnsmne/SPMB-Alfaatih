@extends('layout.kepalasekolah')

@section('title', 'Rekap Pembayaran')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Rekap Pembayaran</h3>
                <p class="text-subtitle text-muted">Analisis dan rekapitulasi pembayaran per jurusan</p>
            </div>
        </div>
    </div>

    <!-- Summary Cards -->
    <section class="section">
        <div class="row">
            @php 
                $totalPendaftar = $rekap->sum('total_pendaftar');
                $totalVerified = $rekap->sum('verified');
                $totalPending = $rekap->sum('pending');
                $totalPemasukan = $rekap->sum('total_verified');
            @endphp
            <div class="col-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 class="text-muted font-semibold">Total Pendaftar</h6>
                                <h4 class="font-extrabold mb-0">{{ $totalPendaftar }}</h4>
                            </div>
                            <div class="stats-icon blue">
                                <i class="bi bi-people"></i>
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
                                <h6 class="text-muted font-semibold">Pembayaran Verified</h6>
                                <h4 class="font-extrabold mb-0">{{ $totalVerified }}</h4>
                            </div>
                            <div class="stats-icon green">
                                <i class="bi bi-check-circle"></i>
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
                                <h6 class="text-muted font-semibold">Pembayaran Pending</h6>
                                <h4 class="font-extrabold mb-0">{{ $totalPending }}</h4>
                            </div>
                            <div class="stats-icon orange">
                                <i class="bi bi-clock"></i>
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
                                <h6 class="text-muted font-semibold">Total Pemasukan</h6>
                                <h4 class="font-extrabold mb-0">Rp {{ number_format($totalPemasukan / 1000000, 1) }}Jt</h4>
                            </div>
                            <div class="stats-icon purple">
                                <i class="bi bi-cash-coin"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Detail per Jurusan -->
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Rekap Pembayaran Per Jurusan</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover" id="tableRekap">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Jurusan</th>
                                <th>Total Pendaftar</th>
                                <th>Verified</th>
                                <th>Pending</th>
                                <th>Rejected</th>
                                <th>Tingkat Verifikasi</th>
                                <th>Total Pemasukan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($rekap as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td><strong>{{ $item->jurusan }}</strong></td>
                                <td>{{ $item->total_pendaftar }}</td>
                                <td><span class="badge bg-success">{{ $item->verified }}</span></td>
                                <td><span class="badge bg-warning">{{ $item->pending }}</span></td>
                                <td><span class="badge bg-danger">{{ $item->rejected }}</span></td>
                                <td>
                                    @php $persentaseVerifikasi = $item->total_pendaftar > 0 ? round(($item->verified / $item->total_pendaftar) * 100, 1) : 0; @endphp
                                    <div class="progress" style="height: 20px;">
                                        <div class="progress-bar {{ $persentaseVerifikasi >= 80 ? 'bg-success' : ($persentaseVerifikasi >= 50 ? 'bg-warning' : 'bg-danger') }}" 
                                             style="width: {{ $persentaseVerifikasi }}%">
                                            {{ $persentaseVerifikasi }}%
                                        </div>
                                    </div>
                                </td>
                                <td><strong>Rp {{ number_format($item->total_verified, 0, ',', '.') }}</strong></td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="table-info">
                                <th colspan="7">TOTAL PEMASUKAN</th>
                                <th>Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

<style>
    .stats-icon.orange {
        background: rgba(253, 126, 20, 0.1);
        color: #fd7e14;
    }
</style>

<script>
$(document).ready(function() {
    $('#tableRekap').DataTable({
        "pageLength": 25,
        "order": [[7, 'desc']],
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