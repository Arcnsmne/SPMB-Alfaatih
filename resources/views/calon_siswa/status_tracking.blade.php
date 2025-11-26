@extends('layout.calonsiswa')

@section('content')
<div class="page-heading">
    <h3>Status Pendaftaran</h3>
</div>

<div class="page-content">
    <div class="row">
        <div class="col-12">
            <!-- Progress Timeline -->
            <div class="card">
                <div class="card-body">
                    <div class="timeline">
                        <!-- Step 1: Formulir -->
                        <div class="timeline-item {{ $pendaftar ? 'completed' : 'active' }}">
                            <div class="timeline-marker"></div>
                            <div class="timeline-content">
                                <h5>1. Pengisian Formulir</h5>
                                @if($pendaftar)
                                    @if($pendaftar->status == 'SUBMIT')
                                        <span class="badge bg-warning">Menunggu Verifikasi</span>
                                        <p class="mt-2">Formulir Anda sedang diverifikasi oleh admin.</p>
                                    @elseif($pendaftar->status == 'ADM_PASS')
                                        <span class="badge bg-success">Disetujui</span>
                                        <p class="mt-2">Formulir Anda telah disetujui. Silakan lanjut ke upload berkas.</p>
                                    @elseif($pendaftar->status == 'ADM_REJECT')
                                        <span class="badge bg-danger">Ditolak</span>
                                        <p class="mt-2">Formulir Anda ditolak. Silakan hubungi admin.</p>
                                    @endif
                                @else
                                    <span class="badge bg-secondary">Belum Diisi</span>
                                    <a href="{{ route('formulir.index') }}" class="btn btn-primary btn-sm mt-2">Isi Formulir</a>
                                @endif
                            </div>
                        </div>

                        <!-- Step 2: Upload Berkas -->
                        <div class="timeline-item {{ $berkas ? 'completed' : ($pendaftar && $pendaftar->status == 'ADM_PASS' ? 'active' : '') }}">
                            <div class="timeline-marker"></div>
                            <div class="timeline-content">
                                <h5>2. Upload Berkas</h5>
                                @if($pendaftar && $pendaftar->status == 'ADM_PASS')
                                    @if($berkas)
                                        <span class="badge bg-success">Berkas Sudah Diupload</span>
                                        <p class="mt-2">Berkas Anda telah diupload dan diverifikasi.</p>
                                    @else
                                        <span class="badge bg-warning">Belum Upload</span>
                                        <a href="/upload" class="btn btn-primary btn-sm mt-2">Upload Berkas</a>
                                    @endif
                                @else
                                    <span class="badge bg-secondary">Menunggu Verifikasi Formulir</span>
                                @endif
                            </div>
                        </div>

                        <!-- Step 3: Pembayaran -->
                        <div class="timeline-item {{ $pembayaran ? 'completed' : ($berkas ? 'active' : '') }}">
                            <div class="timeline-marker"></div>
                            <div class="timeline-content">
                                <h5>3. Pembayaran</h5>
                                @if($berkas)
                                    @if($pembayaran)
                                        @if($pembayaran->status == 'PENDING')
                                            <span class="badge bg-warning">Menunggu Verifikasi</span>
                                            <p class="mt-2">Pembayaran Anda sedang diverifikasi oleh keuangan.</p>
                                        @elseif($pembayaran->status == 'VERIFIED')
                                            <span class="badge bg-success">Pembayaran Disetujui</span>
                                            <p class="mt-2">Pembayaran Anda telah diverifikasi. Pendaftaran selesai!</p>
                                        @elseif($pembayaran->status == 'REJECTED')
                                            <span class="badge bg-danger">Pembayaran Ditolak</span>
                                            <p class="mt-2">Pembayaran Anda ditolak. Silakan upload ulang bukti pembayaran.</p>
                                        @endif
                                    @else
                                        <span class="badge bg-warning">Belum Bayar</span>
                                        <a href="/pembayaran" class="btn btn-primary btn-sm mt-2">Lakukan Pembayaran</a>
                                    @endif
                                @else
                                    <span class="badge bg-secondary">Menunggu Upload Berkas</span>
                                @endif
                            </div>
                        </div>

                        <!-- Step 4: Selesai -->
                        <div class="timeline-item {{ $pembayaran && $pembayaran->status == 'VERIFIED' ? 'completed' : '' }}">
                            <div class="timeline-marker"></div>
                            <div class="timeline-content">
                                <h5>4. Pendaftaran Selesai</h5>
                                @if($pembayaran && $pembayaran->status == 'VERIFIED')
                                    <span class="badge bg-success">Selesai</span>
                                    <p class="mt-2">Selamat! Pendaftaran Anda telah selesai.</p>
                                @else
                                    <span class="badge bg-secondary">Belum Selesai</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.timeline {
    position: relative;
    padding: 20px 0;
}

.timeline::before {
    content: '';
    position: absolute;
    left: 30px;
    top: 0;
    bottom: 0;
    width: 2px;
    background: #e9ecef;
}

.timeline-item {
    position: relative;
    padding-left: 70px;
    margin-bottom: 30px;
}

.timeline-marker {
    position: absolute;
    left: 20px;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    background: #e9ecef;
    border: 3px solid #fff;
    box-shadow: 0 0 0 3px #e9ecef;
}

.timeline-item.active .timeline-marker {
    background: #ffc107;
    box-shadow: 0 0 0 3px #ffc107;
}

.timeline-item.completed .timeline-marker {
    background: #28a745;
    box-shadow: 0 0 0 3px #28a745;
}

.timeline-content {
    background: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}
</style>
@endsection