@extends('layout.admin')

@section('content')
<div class="main-content container-fluid">
    <div class="page-title mb-4">
        <h3>Dashboard Operasional</h3>
        <p class="text-subtitle text-muted">Ringkasan harian pendaftar, verifikasi, dan pembayaran per jurusan dan gelombang.</p>
    </div>

    <!-- Ringkasan Harian -->
    <section class="row">
        <div class="col-12 col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted">Total Pendaftar</h6>
                        <h3 class="mb-0 fw-bold">{{ number_format($totalPendaftar) }}</h3>
                    </div>
                    <div class="icon bg-primary text-white rounded-circle p-3">
                        <i class="bi bi-person-plus"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted">Terverifikasi</h6>
                        <h3 class="mb-0 fw-bold text-success">{{ number_format($terverifikasi) }}</h3>
                    </div>
                    <div class="icon bg-success text-white rounded-circle p-3">
                        <i class="bi bi-check-circle"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted">Sudah Terbayar</h6>
                        <h3 class="mb-0 fw-bold text-info">{{ number_format($terbayar) }}</h3>
                    </div>
                    <div class="icon bg-info text-white rounded-circle p-3">
                        <i class="bi bi-cash-stack"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Grafik -->
<section class="row mt-4">
    <div class="col-12">
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-white border-0">
                <h5 class="mb-0">Grafik Pendaftar per Jurusan</h5>
            </div>
            <div class="card-body">
                <div id="chart-jurusan" style="height: 300px;"></div>
            </div>
        </div>
    </div>
</section>

<!-- Tabel Ringkas -->
<section class="row">
    <div class="col-12">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white border-0">
                <h5 class="mb-0">Ringkasan per Gelombang</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped mb-0 align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Gelombang</th>
                                <th>Pendaftar</th>
                                <th>Terverifikasi</th>
                                <th>Terbayar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($dataGelombang as $gelombang)
                            <tr>
                                <td>{{ $gelombang->nama }}</td>
                                <td>{{ $gelombang->total_pendaftar }}</td>
                                <td>{{ $gelombang->terverifikasi }}</td>
                                <td>{{ $gelombang->pendaftar()->whereHas('pembayaran')->count() }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

</div>

@endsection

@push('scripts')
<script>
    var options = {
        series: [{
            name: 'Pendaftar',
            data: [@foreach($dataJurusan as $jurusan){{ $jurusan->total_pendaftar }}@if(!$loop->last),@endif @endforeach]
        }, {
            name: 'Terverifikasi',
            data: [@foreach($dataJurusan as $jurusan){{ $jurusan->terverifikasi }}@if(!$loop->last),@endif @endforeach]
        }],
        chart: {
            type: 'bar',
            height: 300
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '55%',
                endingShape: 'rounded'
            },
        },
        dataLabels: {
            enabled: false
        },
        xaxis: {
            categories: [@foreach($dataJurusan as $jurusan)'{{ $jurusan->nama }}'@if(!$loop->last),@endif @endforeach],
        },
        colors: ['#435ebe', '#28ab55'],
    };

    var chart = new ApexCharts(document.querySelector("#chart-jurusan"), options);
    chart.render();
</script>
@endpush
