@extends('layout.verifikator_adm')

@section('content')
<div class="page-title">
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Verifikasi Berkas</h3>
        </div>
    </div>
</div>

<section class="section">
    <div class="card">
        <div class="card-body">
            <table class="table table-striped" id="table1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Jurusan</th>
                        <th>Tanggal Daftar</th>
                        <th>Status Berkas</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pendaftar as $index => $p)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $p->dataSiswa->nama_lengkap ?? '-' }}</td>
                        <td>{{ $p->jurusan->nama ?? '-' }}</td>
                        <td>{{ $p->tanggal_daftar }}</td>
                        <td>
                            @php
                                $allValid = $p->berkas->every(fn($b) => $b->valid == 1);
                                $hasInvalid = $p->berkas->some(fn($b) => $b->valid == 0);
                            @endphp
                            @if($allValid)
                                <span class="badge bg-success">Lengkap</span>
                            @elseif($hasInvalid)
                                <span class="badge bg-danger">Tidak Valid</span>
                            @else
                                <span class="badge bg-warning">Menunggu</span>
                            @endif
                        </td>
                        <td>
                            <button type="button" class="btn btn-primary btn-sm" onclick="previewBerkas({{ $p->id }}, '{{ $p->dataSiswa->nama_lengkap }}')">
                                <i class="bi bi-eye"></i> Verifikasi
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>

<!-- Modal Preview Berkas -->
<div class="modal fade" id="berkasModal" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="berkasModalTitle">Preview Berkas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="berkasContent">
                <div class="text-center">
                    <div class="spinner-border" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" id="btnDetailVerifikasi">Detail Verifikasi</button>
            </div>
        </div>
    </div>
</div>

<script>
function previewBerkas(pendaftarId, nama) {
    document.getElementById('berkasModalTitle').textContent = `Preview Berkas - ${nama}`;
    const modal = new bootstrap.Modal(document.getElementById('berkasModal'));
    
    fetch(`{{ url('verifikator_adm/verifikasi-berkas') }}/${pendaftarId}/preview`)
        .then(response => response.json())
        .then(data => {
            let content = '<div class="row">';
            
            data.berkas.forEach(berkas => {
                const fileExt = berkas.file_path ? berkas.file_path.split('.').pop().toLowerCase() : '';
                const isImage = ['jpg', 'jpeg', 'png', 'gif'].includes(fileExt);
                
                content += `
                    <div class="col-md-6 mb-3">
                        <div class="card">
                            <div class="card-header">
                                <h6>${berkas.jenis.replace(/_/g, ' ').toUpperCase()}</h6>
                            </div>
                            <div class="card-body text-center">
                `;
                
                if (berkas.file_path) {
                    if (isImage) {
                        content += `<img src="/storage/${berkas.file_path}" class="img-fluid" style="max-height: 200px;">`;
                    } else {
                        content += `
                            <i class="bi bi-file-earmark-pdf" style="font-size: 3rem; color: #dc3545;"></i>
                            <br>
                            <a href="/storage/${berkas.file_path}" target="_blank" class="btn btn-outline-primary btn-sm mt-2">
                                <i class="bi bi-eye"></i> Lihat PDF
                            </a>
                        `;
                    }
                } else {
                    content += '<span class="text-muted">Belum upload</span>';
                }
                
                content += `
                            </div>
                        </div>
                    </div>
                `;
            });
            
            content += '</div>';
            document.getElementById('berkasContent').innerHTML = content;
            
            document.getElementById('btnDetailVerifikasi').onclick = function() {
                window.location.href = `{{ url('verifikator_adm/verifikasi-berkas') }}/${pendaftarId}`;
            };
        })
        .catch(error => {
            document.getElementById('berkasContent').innerHTML = '<div class="alert alert-danger">Error loading berkas</div>';
        });
    
    modal.show();
}
</script>
@endsection