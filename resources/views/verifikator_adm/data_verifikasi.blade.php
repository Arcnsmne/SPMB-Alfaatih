@extends('layout.verifikator_adm')

@section('title', 'Data Verifikasi')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Data Verifikasi</h3>
                <p class="text-subtitle text-muted">Semua data pendaftaran yang sudah dan belum diverifikasi</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('verifikator_adm.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Data Verifikasi</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Daftar Pendaftaran</h4>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-striped" id="tableVerifikasi">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>No. Pendaftaran</th>
                                    <th>Nama</th>
                                    <th>NISN</th>
                                    <th>Jurusan</th>
                                    <th>Gelombang</th>
                                    <th>Tanggal Daftar</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pendaftaran as $index => $p)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>
                                        <strong>{{ $p->no_pendaftaran }}</strong>
                                    </td>
                                    <td>{{ $p->dataSiswa->nama ?? '-' }}</td>
                                    <td>{{ $p->dataSiswa->nisn ?? '-' }}</td>
                                    <td>
                                        <span class="badge bg-light-primary">{{ $p->jurusan->nama ?? '-' }}</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-light-info">{{ $p->gelombang->nama ?? '-' }}</span>
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($p->tanggal_daftar)->format('d M Y H:i') }}</td>
                                    <td>
                                        @php
                                            // Normalisasi status
                                            $status = strtoupper(trim($p->status ?? ''));
                                            
                                            // Mapping status untuk tampilan
                                            if(in_array($status, ['SUBMIT', '0', 'MENUNGGU', 'PENDING', 'WAITING']) || empty($status)) {
                                                $badgeClass = 'bg-warning';
                                                $statusText = 'Menunggu Verifikasi';
                                            } elseif(in_array($status, ['ADM_PASS', '1', 'VERIFIED', 'LULUS', 'PASS'])) {
                                                $badgeClass = 'bg-success';
                                                $statusText = 'Terverifikasi';
                                            } elseif(in_array($status, ['ADM_REJECT', '2', 'REJECTED', 'DITOLAK', 'GAGAL'])) {
                                                $badgeClass = 'bg-danger';
                                                $statusText = 'Ditolak';
                                            } else {
                                                $badgeClass = 'bg-secondary';
                                                $statusText = $status ?: 'Unknown';
                                            }
                                        @endphp
                                        <span class="badge {{ $badgeClass }}">
                                            {{ $statusText }}
                                        </span>
                                        {{-- Tampilkan nilai asli status untuk debug --}}
                                        {{-- <small class="text-muted d-block">DB: {{ $p->status ?? 'NULL' }}</small> --}}
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('verifikator_adm.verifikasi_formulir.show', $p->id) }}" class="btn btn-sm btn-primary" title="Detail Verifikasi">
                                                <i class="bi bi-eye"></i> Detail
                                            </a>
                                            @if(in_array(strtoupper(trim($p->status ?? '')), ['SUBMIT', '0', 'MENUNGGU', 'PENDING', 'WAITING']) || empty($p->status))
                                                <a href="{{ route('verifikator_adm.verifikasi_formulir.show', $p->id) }}" class="btn btn-sm btn-warning" title="Verifikasi Sekarang">
                                                    <i class="bi bi-check-circle"></i> Verifikasi
                                                </a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal untuk statistik -->
<div class="modal fade" id="statistikModal" tabindex="-1" aria-labelledby="statistikModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="statistikModalLabel">Statistik Verifikasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-4">
                        <div class="card text-center">
                            <div class="card-body">
                                <h3 class="text-warning">{{ $pendaftaran->whereIn('status', ['SUBMIT', '0', 'MENUNGGU'])->count() }}</h3>
                                <p class="mb-0">Menunggu</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card text-center">
                            <div class="card-body">
                                <h3 class="text-success">{{ $pendaftaran->whereIn('status', ['ADM_PASS', '1'])->count() }}</h3>
                                <p class="mb-0">Terverifikasi</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card text-center">
                            <div class="card-body">
                                <h3 class="text-danger">{{ $pendaftaran->whereIn('status', ['ADM_REJECT', '2'])->count() }}</h3>
                                <p class="mb-0">Ditolak</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .badge {
        font-size: 0.75em;
    }
    .btn-group .btn {
        margin-right: 5px;
    }
    .table td {
        vertical-align: middle;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Inisialisasi DataTable
        $('#tableVerifikasi').DataTable({
            "pageLength": 10,
            "ordering": true,
            "order": [[6, 'desc']], // Urutkan berdasarkan tanggal daftar descending
            "language": {
                "search": "Cari:",
                "lengthMenu": "Tampilkan _MENU_ data per halaman",
                "zeroRecords": "Tidak ada data yang ditemukan",
                "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
                "infoEmpty": "Tidak ada data tersedia",
                "infoFiltered": "(disaring dari _MAX_ total data)",
                "paginate": {
                    "previous": "Sebelumnya",
                    "next": "Selanjutnya"
                }
            },
            "columnDefs": [
                { "orderable": false, "targets": [0, 8] }, // Kolom No dan Aksi tidak bisa diurutkan
                { "searchable": false, "targets": [0, 8] } // Kolom No dan Aksi tidak bisa dicari
            ]
        });

        // Filter status
        document.getElementById('filterStatus')?.addEventListener('change', function() {
            const status = this.value;
            const table = $('#tableVerifikasi').DataTable();
            
            if (status === 'all') {
                table.search('').draw();
            } else {
                table.column(6).search(status).draw(); // Kolom status index 6
            }
        });
    });

    // Fungsi untuk menampilkan statistik
    function showStatistik() {
        const modal = new bootstrap.Modal(document.getElementById('statistikModal'));
        modal.show();
    }
</script>
@endsection