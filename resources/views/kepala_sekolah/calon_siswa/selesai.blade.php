@extends('layout.kepalasekolah')

@section('title', 'Calon Siswa Selesai Registrasi')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Calon Siswa Selesai Registrasi</h3>
                <p class="text-subtitle text-muted">Calon siswa yang sudah menyelesaikan semua tahap</p>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Data Calon Siswa Selesai ({{ $pendaftar->count() }})</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover" id="tableSelesai">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>No. Pendaftaran</th>
                                <th>Nama</th>
                                <th>NISN</th>
                                <th>Jurusan</th>
                                <th>Gelombang</th>
                                <th>Jumlah Bayar</th>
                                <th>Status Bayar</th>
                                <th>Tanggal Daftar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pendaftar as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td><strong>{{ $item->no_pendaftaran }}</strong></td>
                                <td>{{ $item->dataSiswa->nama ?? '-' }}</td>
                                <td>{{ $item->dataSiswa->nisn ?? '-' }}</td>
                                <td>{{ $item->jurusan->nama ?? '-' }}</td>
                                <td>{{ $item->gelombang->nama ?? '-' }}</td>
                                <td>
                                    @if($item->pembayaran)
                                        Rp {{ number_format($item->pembayaran->jumlah, 0, ',', '.') }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    @if($item->pembayaran)
                                        @if($item->pembayaran->status == 'VERIFIED')
                                            <span class="badge bg-success">VERIFIED</span>
                                        @else
                                            <span class="badge bg-warning">{{ $item->pembayaran->status }}</span>
                                        @endif
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>{{ \Carbon\Carbon::parse($item->tanggal_daftar)->format('d/m/Y H:i') }}</td>
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
$(document).ready(function() {
    $('#tableSelesai').DataTable({
        "pageLength": 25,
        "order": [[0, 'asc']],
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