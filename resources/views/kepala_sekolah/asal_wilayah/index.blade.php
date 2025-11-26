@extends('layout.kepalasekolah')

@section('title', 'Asal Wilayah')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Asal Wilayah</h3>
                <p class="text-subtitle text-muted">Distribusi geografis pendaftar berdasarkan wilayah</p>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Data Asal Wilayah ({{ $asalWilayah->count() }} wilayah)</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover" id="tableAsalWilayah">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Provinsi</th>
                                <th>Kabupaten/Kota</th>
                                <th>Jumlah Pendaftar</th>
                                <th>Persentase</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $totalPendaftar = $asalWilayah->sum('jumlah_pendaftar'); @endphp
                            @foreach($asalWilayah as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td><strong>{{ $item->provinsi }}</strong></td>
                                <td>{{ $item->kabupaten }}</td>
                                <td><span class="badge bg-primary">{{ $item->jumlah_pendaftar }}</span></td>
                                <td>
                                    @php $persentase = $totalPendaftar > 0 ? round(($item->jumlah_pendaftar / $totalPendaftar) * 100, 1) : 0; @endphp
                                    <div class="progress" style="height: 20px;">
                                        <div class="progress-bar bg-info" style="width: {{ $persentase }}%">
                                            {{ $persentase }}%
                                        </div>
                                    </div>
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
    $('#tableAsalWilayah').DataTable({
        "pageLength": 25,
        "order": [[3, 'desc']],
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