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
                            @if($berkas->url)
                                @php
                                    $fileExt = pathinfo($berkas->url, PATHINFO_EXTENSION);
                                    $isImage = in_array(strtolower($fileExt), ['jpg', 'jpeg', 'png', 'gif']);
                                    $fileUrl = asset('storage/' . $berkas->url);
                                @endphp

                                <div class="mb-3">
                                    @if($isImage)
                                        <img src="{{ $fileUrl }}" class="img-thumbnail" style="max-height:150px; cursor:pointer;"
                                            onclick="openPreview('{{ $fileUrl }}', 'image', '{{ $berkas->jenis }}')"
                                            onerror="this.style.display='none'; document.getElementById('icon-{{ $berkas->id }}').style.display='block'">
                                        <div id="icon-{{ $berkas->id }}" style="display:none">
                                            <i class="bi bi-image text-success" style="font-size:3rem"></i>
                                        </div>
                                    @else
                                        <i class="bi bi-file-earmark-pdf text-danger" style="font-size:3rem"></i>
                                    @endif
                                </div>

                                <button type="button" class="btn btn-outline-primary btn-sm mb-2"
                                    onclick="openPreview('{{ $fileUrl }}', '{{ $isImage ? 'image' : 'pdf' }}', '{{ $berkas->jenis }}')">
                                    <i class="bi bi-eye"></i> Lihat File
                                </button>

                                <div class="mt-2">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="berkas_{{ $berkas->id }}" value="1" {{ $berkas->valid == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label text-success">Valid</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="berkas_{{ $berkas->id }}" value="0" {{ $berkas->valid == 0 ? 'checked' : '' }}>
                                        <label class="form-check-label text-danger">Tidak Valid</label>
                                    </div>
                                </div>
                            @else
                                <i class="bi bi-file-earmark-x text-muted" style="font-size:3rem"></i>
                                <p class="text-muted mt-2">Belum upload</p>
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
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="previewModalTitle">Preview Berkas</h5>
                <div class="ms-auto d-flex gap-2">
                    <a id="previewDownload" href="#" target="_blank" class="btn btn-sm btn-outline-primary">
                        <i class="bi bi-download"></i> Unduh
                    </a>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
            </div>
            <div class="modal-body p-0" id="previewContent" style="min-height:400px">
                <div class="text-center py-5">
                    <div class="spinner-border text-primary"></div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function openPreview(url, type, label) {
    document.getElementById('previewModalTitle').textContent = 'Preview: ' + label.replace(/_/g,' ');
    document.getElementById('previewDownload').href = url;
    const content = document.getElementById('previewContent');
    content.innerHTML = '<div class="text-center py-5"><div class="spinner-border text-primary"></div></div>';

    const modal = new bootstrap.Modal(document.getElementById('previewModal'));
    modal.show();

    if (type === 'image') {
        content.innerHTML = `<img src="${url}" class="img-fluid d-block mx-auto p-3"
            style="max-height:80vh; object-fit:contain"
            onerror="this.parentElement.innerHTML='<div class=\'alert alert-warning m-3\'>Gambar tidak dapat ditampilkan. <a href=\''+url+'\' target=\'_blank\'>Buka di tab baru</a></div>'">`;
    } else {
        content.innerHTML = `<iframe src="${url}" width="100%" height="600px" frameborder="0"
            onerror="this.parentElement.innerHTML='<div class=\'alert alert-warning m-3\'>PDF tidak dapat ditampilkan. <a href=\''+url+'\' target=\'_blank\'>Buka di tab baru</a></div>'"></iframe>`;
    }
}

function verifikasi(status) {
    const catatan = document.getElementById('catatan').value;
    fetch(`{{ route('verifikator_adm.verifikasi_berkas.selesai', $pendaftar->id) }}`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
        body: JSON.stringify({ status, catatan })
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            alert('Verifikasi berhasil disimpan');
            window.location.href = '{{ route("verifikator_adm.verifikasi_berkas") }}';
        }
    });
}
</script>
@endpush
@endsection