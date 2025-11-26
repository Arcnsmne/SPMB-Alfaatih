@extends('layout.kepalasekolah')

@section('title', 'Daftar Pembayaran')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Daftar Pembayaran</h3>
                <p class="text-subtitle text-muted">Data pembayaran dari calon siswa</p>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Data Pembayaran ({{ $pembayaran->count() }})</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover" id="tablePembayaran">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>No. Pendaftaran</th>
                                <th>Nama</th>
                                <th>Jurusan</th>
                                <th>Metode</th>
                                <th>Jumlah</th>
                                <th>Status</th>
                                <th>Tanggal Verifikasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pembayaran as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td><strong>{{ $item->no_pendaftaran }}</strong></td>
                                <td>{{ $item->dataSiswa->nama ?? '-' }}</td>
                                <td>{{ $item->jurusan->nama ?? '-' }}</td>
                                <td>{{ $item->pembayaran->metode ?? '-' }}</td>
                                <td>Rp {{ number_format($item->pembayaran->jumlah ?? 0, 0, ',', '.') }}</td>
                                <td>
                                    @if($item->pembayaran->status == 'PENDING')
                                        <span class="badge bg-warning">PENDING</span>
                                    @elseif($item->pembayaran->status == 'VERIFIED')
                                        <span class="badge bg-success">VERIFIED</span>
                                    @elseif($item->pembayaran->status == 'REJECTED')
                                        <span class="badge bg-danger">REJECTED</span>
                                    @endif
                                </td>
                                <td>
                                    @if($item->tgl_verifikasi_payment)
                                        {{ \Carbon\Carbon::parse($item->tgl_verifikasi_payment)->format('d/m/Y H:i') }}
                                    @else
                                        -
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

<script>
$(document).ready(function() {
    $('#tablePembayaran').DataTable({
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