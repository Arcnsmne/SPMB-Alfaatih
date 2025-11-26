@extends('layout.verifikator_adm')

@section('content')
<div class="page-title">
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Verifikasi Berkas - {{ $pendaftar->dataSiswa->nama_lengkap }}</h3>
        </div>
    </div>
</div>

<section class="section">
    <div class="card">
        <div class="card-body">
            <div class="row">
                @foreach($pendaftar->berkas as $berkas)
                <div class="col-md-6 mb-3">
                    <div class="card">
                        <div class="card-header">
                            <h5>{{ ucfirst(str_replace('_', ' ', $berkas->jenis)) }}</h5>
                        </div>
                        <div class="card-body text-center">
                            @if($berkas->file_path)
                                @php
                                    $fileExt = pathinfo($berkas->file_path, PATHINFO_EXTENSION);
                                    $isImage = in_array(strtolower($fileExt), ['jpg', 'jpeg', 'png', 'gif']);
                                @endphp
                                
                                @if($isImage)
                                    <div class="mb-2">
                                        <i class="bi bi-image" style="font-size: 3rem; color: #28a745;"></i>
                                    </div>
                                @else
                                    <div class="mb-2">
                                        <i class="bi bi-file-earmark-pdf" style="font-size: 3rem; color: #dc3545;"></i>
                                    </div>
                                @endif
                                <button type="button" class="btn btn-outline-primary btn-sm mb-2" onclick="event.preventDefault(); previewFile('{{ asset('storage/' . $berkas->file_path) }}', '{{ $isImage ? 'image' : 'pdf' }}'); return false;">
                                    <i class="bi bi-eye"></i> Lihat
                                </button>
                                <br>
                                
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input berkas-status" type="radio" name="berkas_{{ $berkas->id }}" value="1" {{ $berkas->valid == 1 ? 'checked' : '' }}>
                                    <label class="form-check-label text-success">Valid</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input berkas-status" type="radio" name="berkas_{{ $berkas->id }}" value="0" {{ $berkas->valid == 0 ? 'checked' : '' }}>
                                    <label class="form-check-label text-danger">Tidak Valid</label>
                                </div>
                            @else
                                <span class="text-muted">Belum upload</span>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
            <div class="row mt-3">
                <div class="col-12">
                    <div class="form-group">
                        <label>Catatan</label>
                        <textarea class="form-control" id="catatan" rows="3" placeholder="Catatan verifikasi..."></textarea>
                    </div>
                </div>
            </div>
            
            <div class="row mt-3">
                <div class="col-12">
                    <button type="button" class="btn btn-success" onclick="verifikasi('APPROVED')">
                        <i class="bi bi-check-circle"></i> Setujui Semua
                    </button>
                    <button type="button" class="btn btn-danger" onclick="verifikasi('REJECTED')">
                        <i class="bi bi-x-circle"></i> Tolak
                    </button>
                    <a href="{{ route('verifikator_adm.verifikasi_berkas') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal Preview -->
<div class="modal fade" id="previewModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Preview File</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center" id="previewContent">
            </div>
        </div>
    </div>
</div>

<script>
function previewFile(url, type) {
    event.preventDefault();
    const modal = new bootstrap.Modal(document.getElementById('previewModal'));
    const content = document.getElementById('previewContent');
    
    content.innerHTML = '<div class="text-center"><div class="spinner-border" role="status"></div></div>';
    
    if (type === 'image') {
        content.innerHTML = `<img src="${url}" class="img-fluid" style="max-width: 100%;" onload="console.log('Image loaded')" onerror="this.parentElement.innerHTML='<div class=\"alert alert-warning\">Gambar tidak dapat ditampilkan</div>'">`;
    } else if (type === 'pdf') {
        content.innerHTML = `<iframe src="${url}" width="100%" height="500px" frameborder="0" onload="console.log('PDF loaded')" onerror="this.parentElement.innerHTML='<div class=\"alert alert-warning\">PDF tidak dapat ditampilkan</div>'"></iframe>`;
    }
    
    modal.show();
    return false;
}

function verifikasi(status) {
    const catatan = document.getElementById('catatan').value;
    
    fetch(`{{ route('verifikator_adm.verifikasi_berkas.selesai', $pendaftar->id) }}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            status: status,
            catatan: catatan
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Verifikasi berhasil disimpan');
            window.location.href = '{{ route("verifikator_adm.verifikasi_berkas") }}';
        }
    });
}
</script>
@endsection