@extends('layout.kepalasekolah')

@section('title', 'Pendaftar vs Kuota')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Pendaftar vs Kuota</h3>
                <p class="text-subtitle text-muted">Analisis pendaftar terhadap kuota per jurusan</p>
            </div>
        </div>
    </div>

    <!-- Summary Cards -->
    <section class="section">
        <div class="row">
            <div class="col-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 class="text-muted font-semibold">Total Kuota</h6>
                                <h4 class="font-extrabold mb-0">{{ $totalKuota }}</h4>
                            </div>
                            <div class="stats-icon blue">
                                <i class="bi bi-target"></i>
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
                                <h6 class="text-muted font-semibold">Total Pendaftar</h6>
                                <h4 class="font-extrabold mb-0">{{ $totalPendaftar }}</h4>
                            </div>
                            <div class="stats-icon green">
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
                                <h6 class="text-muted font-semibold">Persentase</h6>
                                <h4 class="font-extrabold mb-0">{{ $persentaseTotal }}%</h4>
                            </div>
                            <div class="stats-icon {{ $persentaseTotal >= 100 ? 'red' : ($persentaseTotal >= 80 ? 'orange' : 'purple') }}">
                                <i class="bi bi-graph-up"></i>
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
                                <h6 class="text-muted font-semibold">Sisa Kuota</h6>
                                <h4 class="font-extrabold mb-0">{{ $totalKuota - $totalPendaftar }}</h4>
                            </div>
                            <div class="stats-icon {{ ($totalKuota - $totalPendaftar) <= 0 ? 'red' : 'green' }}">
                                <i class="bi bi-clipboard-minus"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Data per Jurusan -->
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Analisis per Jurusan</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Jurusan</th>
                                <th>Kuota</th>
                                <th>Pendaftar</th>
                                <th>Persentase</th>
                                <th>Sisa Kuota</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($dataJurusan as $item)
                            <tr>
                                <td><strong>{{ $item->jurusan }}</strong></td>
                                <td>{{ $item->kuota }}</td>
                                <td>{{ $item->pendaftar }}</td>
                                <td>
                                    <div class="progress" style="height: 20px;">
                                        <div class="progress-bar {{ $item->persentase >= 100 ? 'bg-danger' : ($item->persentase >= 80 ? 'bg-warning' : 'bg-success') }}" 
                                             style="width: {{ min($item->persentase, 100) }}%">
                                            {{ $item->persentase }}%
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $item->kuota - $item->pendaftar }}</td>
                                <td>
                                    @if($item->persentase >= 100)
                                        <span class="badge bg-danger">Penuh</span>
                                    @elseif($item->persentase >= 80)
                                        <span class="badge bg-warning">Hampir Penuh</span>
                                    @else
                                        <span class="badge bg-success">Tersedia</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection