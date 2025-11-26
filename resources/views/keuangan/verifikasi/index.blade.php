@extends('layout.keuangan')

@section('title', 'Verifikasi Pembayaran PPDB')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Verifikasi Pembayaran PPDB</h3>
                <p class="text-subtitle text-muted">Verifikasi bukti pembayaran dari pendaftar</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('keuangan.dashboard') }}">Keuangan</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Verifikasi Pembayaran</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <!-- Info Section -->
    <section class="section">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="stats-icon purple me-3">
                                <i class="bi bi-clock-history"></i>
                            </div>
                            <div>
                                <h6 class="text-muted font-semibold">Menunggu Verifikasi</h6>
                                <h6 class="font-extrabold mb-0">{{ $pendaftar->filter(function($item) { return $item->pembayaran && $item->pembayaran->status == 'PENDING'; })->count() }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="stats-icon green me-3">
                                <i class="bi bi-check-circle"></i>
                            </div>
                            <div>
                                <h6 class="text-muted font-semibold">Sudah Diverifikasi</h6>
                                <h6 class="font-extrabold mb-0">{{ $pendaftar->filter(function($item) { return $item->pembayaran && $item->pembayaran->status == 'VERIFIED'; })->count() }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="stats-icon red me-3">
                                <i class="bi bi-x-circle"></i>
                            </div>
                            <div>
                                <h6 class="text-muted font-semibold">Ditolak</h6>
                                <h6 class="font-extrabold mb-0">{{ $pendaftar->filter(function($item) { return $item->pembayaran && $item->pembayaran->status == 'REJECTED'; })->count() }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Daftar Pendaftar Menunggu Verifikasi -->
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Pendaftar Menunggu Verifikasi Pembayaran</h4>
                <p class="text-subtitle text-muted">
                    Menampilkan <strong>{{ $pendaftar->filter(function($item) { return $item->pembayaran && $item->pembayaran->status == 'PENDING'; })->count() }}</strong> pendaftar yang sudah upload bukti pembayaran dan menunggu verifikasi
                </p>
            </div>
            <div class="card-body">
                @if($pendaftar->filter(function($item) { return $item->pembayaran && $item->pembayaran->status == 'PENDING'; })->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover" id="tableVerifikasi">
                        <thead>
                            <tr>
                                <th width="50">#</th>
                                <th width="150">No. Pendaftaran</th>
                                <th>Nama Siswa</th>
                                <th width="120">Jurusan</th>
                                <th width="120">Tanggal Bayar</th>
                                <th width="120">Jumlah Bayar</th>
                                <th width="120">Status</th>
                                <th width="150">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pendaftar->filter(function($item) { return $item->pembayaran && $item->pembayaran->status == 'PENDING'; }) as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <strong>{{ $item->no_pendaftaran }}</strong>
                                </td>
                                <td>
                                    <div>
                                        <strong>{{ $item->dataSiswa->nama ?? '-' }}</strong><br>
                                        <small class="text-muted">NISN: {{ $item->dataSiswa->nisn ?? '-' }}</small>
                                    </div>
                                </td>
                                <td>{{ $item->jurusan->nama ?? '-' }}</td>
                                <td>
                                    @if($item->pembayaran)
                                        {{ \Carbon\Carbon::parse($item->pembayaran->created_at)->format('d/m/Y') }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    @if($item->pembayaran)
                                        <strong>Rp {{ number_format($item->pembayaran->jumlah ?? 0, 0, ',', '.') }}</strong>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    <span class="badge bg-warning">MENUNGGU VERIFIKASI</span>
                                </td>
                                <td>
                                    <a href="{{ route('keuangan.verifikasi_pembayaran.show', $item->id) }}" class="btn btn-sm btn-primary">
                                        <i class="bi bi-eye me-1"></i> Verifikasi
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="text-center py-5">
                    <i class="bi bi-check-circle text-success" style="font-size: 3rem;"></i>
                    <h5 class="mt-3">Tidak ada pembayaran yang menunggu verifikasi</h5>
                    <p class="text-muted">Semua pembayaran sudah diverifikasi</p>
                </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Riwayat Verifikasi -->
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Riwayat Verifikasi</h4>
                <p class="text-subtitle text-muted">Pendaftar yang sudah diverifikasi atau ditolak</p>
            </div>
            <div class="card-body">
                @if($pendaftar->filter(function($item) { return $item->pembayaran && in_array($item->pembayaran->status, ['VERIFIED', 'REJECTED']); })->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover" id="tableRiwayat">
                        <thead>
                            <tr>
                                <th width="50">#</th>
                                <th width="150">No. Pendaftaran</th>
                                <th>Nama Siswa</th>
                                <th width="120">Jurusan</th>
                                <th width="120">Status</th>
                                <th width="150">Tanggal Verifikasi</th>
                                <th width="120">Verifikator</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pendaftar->filter(function($item) { return $item->pembayaran && in_array($item->pembayaran->status, ['VERIFIED', 'REJECTED']); }) as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <strong>{{ $item->no_pendaftaran }}</strong>
                                </td>
                                <td>
                                    <div>
                                        <strong>{{ $item->dataSiswa->nama ?? '-' }}</strong><br>
                                        <small class="text-muted">NISN: {{ $item->dataSiswa->nisn ?? '-' }}</small>
                                    </div>
                                </td>
                                <td>{{ $item->jurusan->nama ?? '-' }}</td>
                                <td>
                                    @if($item->pembayaran->status == 'VERIFIED')
                                        <span class="badge bg-success">TERVERIFIKASI</span>
                                    @elseif($item->pembayaran->status == 'REJECTED')
                                        <span class="badge bg-danger">DITOLAK</span>
                                    @endif
                                </td>
                                <td>
                                    @if($item->tgl_verifikasi_payment)
                                        {{ \Carbon\Carbon::parse($item->tgl_verifikasi_payment)->format('d/m/Y H:i') }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    {{ $item->user_verifikasi_payment ?? '-' }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="text-center py-4">
                    <p class="text-muted">Belum ada riwayat verifikasi</p>
                </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Modal Verifikasi -->
    @foreach($pendaftar->filter(function($item) { return $item->pembayaran && $item->pembayaran->status == 'PENDING'; }) as $item)
    <div class="modal fade" id="modalVerifikasi{{ $item->id }}" tabindex="-1" aria-labelledby="modalVerifikasi{{ $item->id }}Label" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalVerifikasi{{ $item->id }}Label">
                        Verifikasi Pembayaran - {{ $item->no_pendaftaran }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Data Pendaftar</h6>
                            <table class="table table-sm">
                                <tr>
                                    <td><strong>No. Pendaftaran</strong></td>
                                    <td>{{ $item->no_pendaftaran }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Nama</strong></td>
                                    <td>{{ $item->dataSiswa->nama ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>NISN</strong></td>
                                    <td>{{ $item->dataSiswa->nisn ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Jurusan</strong></td>
                                    <td>{{ $item->jurusan->nama ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Gelombang</strong></td>
                                    <td>{{ $item->gelombang->nama ?? '-' }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h6>Informasi Pembayaran</h6>
                            @if($item->pembayaran)
                            <table class="table table-sm">
                                <tr>
                                    <td><strong>Jumlah Bayar</strong></td>
                                    <td><strong>Rp {{ number_format($item->pembayaran->jumlah ?? 0, 0, ',', '.') }}</strong></td>
                                </tr>
                                <tr>
                                    <td><strong>Tanggal Upload</strong></td>
                                    <td>{{ $item->pembayaran->created_at ? \Carbon\Carbon::parse($item->pembayaran->created_at)->format('d/m/Y H:i') : '-' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Bank</strong></td>
                                    <td>{{ $item->pembayaran->bank ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Nama Pengirim</strong></td>
                                    <td>{{ $item->pembayaran->nama_pengirim ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>No. Rekening</strong></td>
                                    <td>{{ $item->pembayaran->no_rekening ?? '-' }}</td>
                                </tr>
                            </table>
                            @endif
                        </div>
                    </div>
                    
                    @if($item->pembayaran && $item->pembayaran->bukti_transfer)
                    <div class="row mt-3">
                        <div class="col-12">
                            <h6>Bukti Transfer</h6>
                            <div class="text-center border rounded p-3 bg-light">
                                <img src="{{ asset('storage/' . $item->pembayaran->bukti_transfer) }}" 
                                     alt="Bukti Transfer" 
                                     class="img-fluid rounded" 
                                     style="max-height: 400px; cursor: pointer;"
                                     onclick="openImageModal('{{ asset('storage/' . $item->pembayaran->bukti_transfer) }}')">
                                <div class="mt-2">
                                    <a href="{{ asset('storage/' . $item->pembayaran->bukti_transfer) }}" 
                                       target="_blank" 
                                       class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-arrows-fullscreen me-1"></i> Lihat Full Size
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="row mt-3">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="catatanVerifikasi{{ $item->id }}" class="form-label">
                                    <i class="bi bi-chat-text me-1"></i>Catatan Verifikasi (Opsional)
                                </label>
                                <textarea class="form-control" 
                                          id="catatanVerifikasi{{ $item->id }}" 
                                          rows="3" 
                                          placeholder="Berikan catatan jika pembayaran ditolak atau perlu informasi tambahan..."></textarea>
                                <div class="form-text">
                                    Catatan akan tersimpan di riwayat verifikasi
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x me-1"></i> Batal
                    </button>
                    <button type="button" class="btn btn-outline-danger" onclick="verifikasiPembayaran({{ $item->id }}, 'PAYMENT_REJECTED')">
                        <i class="bi bi-x-circle me-1"></i> Tolak Pembayaran
                    </button>
                    <button type="button" class="btn btn-success" onclick="verifikasiPembayaran({{ $item->id }}, 'PAYMENT_VERIFIED')">
                        <i class="bi bi-check-circle me-1"></i> Setujui Pembayaran
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    <!-- Modal untuk gambar full size -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Bukti Transfer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img id="modalImage" src="" alt="Bukti Transfer" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .table th {
        background-color: #f8f9fa;
        font-weight: 600;
    }
    
    .badge {
        font-size: 0.75rem;
    }
    
    .stats-icon {
        width: 50px;
        height: 50px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
    }
    
    .stats-icon.purple {
        background-color: #7367f0;
        color: white;
    }
    
    .stats-icon.green {
        background-color: #28c76f;
        color: white;
    }
    
    .stats-icon.red {
        background-color: #ea5455;
        color: white;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Inisialisasi DataTables untuk tabel verifikasi
        $('#tableVerifikasi').DataTable({
            "pageLength": 10,
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

        // Inisialisasi DataTables untuk tabel riwayat
        $('#tableRiwayat').DataTable({
            "pageLength": 10,
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

    // Fungsi untuk membuka modal gambar
    function openImageModal(imageSrc) {
        document.getElementById('modalImage').src = imageSrc;
        new bootstrap.Modal(document.getElementById('imageModal')).show();
    }

    // Fungsi verifikasi pembayaran
    function verifikasiPembayaran(id, status) {
        const catatan = document.getElementById('catatanVerifikasi' + id).value;
        
        const actionText = status === 'PAYMENT_VERIFIED' ? 'menyetujui' : 'menolak';
        const statusText = status === 'PAYMENT_VERIFIED' ? 'TERVERIFIKASI' : 'DITOLAK';
        
        if (confirm(`Apakah Anda yakin ingin ${actionText} pembayaran ini?`)) {
            // Show loading state
            const buttons = document.querySelectorAll('#modalVerifikasi' + id + ' .modal-footer button');
            buttons.forEach(btn => {
                btn.disabled = true;
                if (btn.classList.contains('btn-outline-danger')) {
                    btn.innerHTML = '<i class="bi bi-arrow-repeat spinner-border spinner-border-sm me-1"></i> Menolak...';
                } else if (btn.classList.contains('btn-success')) {
                    btn.innerHTML = '<i class="bi bi-arrow-repeat spinner-border spinner-border-sm me-1"></i> Menyetujui...';
                } else {
                    btn.innerHTML = '<i class="bi bi-arrow-repeat spinner-border spinner-border-sm me-1"></i> Memproses...';
                }
            });
            
            fetch('/keuangan/verifikasi-pembayaran/' + id + '/selesai', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    status: status,
                    catatan: catatan
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Close modal
                    const modal = bootstrap.Modal.getInstance(document.getElementById('modalVerifikasi' + id));
                    modal.hide();
                    
                    // Show success message
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: `Pembayaran berhasil ${actionText}`,
                        timer: 2000,
                        showConfirmButton: false
                    }).then(() => {
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: data.message
                    });
                    // Re-enable buttons
                    resetButtons(buttons);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Terjadi kesalahan sistem'
                });
                // Re-enable buttons
                resetButtons(buttons);
            });
        }
    }

    // Fungsi reset button state
    function resetButtons(buttons) {
        buttons.forEach(btn => {
            btn.disabled = false;
            if (btn.classList.contains('btn-outline-danger')) {
                btn.innerHTML = '<i class="bi bi-x-circle me-1"></i> Tolak Pembayaran';
            } else if (btn.classList.contains('btn-success')) {
                btn.innerHTML = '<i class="bi bi-check-circle me-1"></i> Setujui Pembayaran';
            } else {
                btn.innerHTML = '<i class="bi bi-x me-1"></i> Batal';
            }
        });
    }
</script>

<!-- Include SweetAlert2 for better alerts -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection