@extends('layout.calonsiswa')

@section('title', 'Pembayaran')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Pembayaran</h3>
                <p class="text-subtitle text-muted">Upload bukti pembayaran pendaftaran</p>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Informasi Pembayaran</h4>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <h6>Data Pendaftar</h6>
                            <table class="table table-borderless">
                                <tr>
                                    <td>Nama</td>
                                    <td>: {{ $pendaftar->dataSiswa->nama ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td>No. Pendaftaran</td>
                                    <td>: {{ $pendaftar->no_pendaftaran }}</td>
                                </tr>
                                <tr>
                                    <td>Jurusan</td>
                                    <td>: {{ $pendaftar->jurusan->nama ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td>Gelombang</td>
                                    <td>: {{ $pendaftar->gelombang->nama ?? '-' }}</td>
                                </tr>
                            </table>
                        </div>
                        
                        <div class="alert alert-info">
                            <h6>Biaya Pendaftaran: Rp {{ number_format($biayaDaftar) }}</h6>
                        </div>
                        
                        <div id="payment-info" style="display: none;">
                            <div id="qris-info" class="alert alert-warning" style="display: none;">
                                <h6>Pembayaran QRIS</h6>
                                <div class="text-center mb-3">
                                    <img src="https://via.placeholder.com/200x200?text=QRIS+CODE" alt="QRIS" class="img-fluid">
                                </div>
                                <p class="mb-0"><strong>Cara Pembayaran:</strong></p>
                                <ol class="small">
                                    <li>Buka aplikasi mobile banking atau e-wallet</li>
                                    <li>Pilih menu scan QRIS</li>
                                    <li>Scan kode QR di atas</li>
                                    <li>Masukkan nominal Rp {{ number_format($biayaDaftar) }}</li>
                                    <li>Konfirmasi pembayaran</li>
                                    <li>Screenshot bukti pembayaran</li>
                                </ol>
                            </div>
                            
                            <div id="transfer-info" class="alert alert-success" style="display: none;">
                                <h6>Transfer Bank</h6>
                                <p class="mb-2"><strong>Rekening Tujuan:</strong></p>
                                <div class="bg-light p-3 rounded mb-3">
                                    <strong>BCA 1234567890</strong><br>
                                    <strong>a.n SMK Bakti Nusantara 666</strong>
                                </div>
                                <p class="mb-0"><strong>Cara Transfer:</strong></p>
                                <ol class="small">
                                    <li>Login ke mobile banking atau datang ke ATM</li>
                                    <li>Pilih menu transfer antar bank</li>
                                    <li>Masukkan nomor rekening: <strong>1234567890</strong></li>
                                    <li>Masukkan nominal: <strong>Rp {{ number_format($biayaDaftar) }}</strong></li>
                                    <li>Konfirmasi transfer</li>
                                    <li>Simpan bukti transfer</li>
                                </ol>
                            </div>
                        </div>
                        
                        @if($pendaftar->pembayaran)
                            <div class="alert alert-success">
                                <h6>Status Pembayaran</h6>
                                <p class="mb-1">Jumlah: Rp {{ number_format($pendaftar->pembayaran->jumlah) }}</p>
                                <p class="mb-1">Metode: {{ $pendaftar->pembayaran->metode }}</p>
                                <p class="mb-0">Status: 
                                    <span class="badge bg-warning">{{ ucfirst($pendaftar->pembayaran->status) }}</span>
                                </p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Upload Bukti Pembayaran</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('pembayaran.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Jumlah Pembayaran</label>
                                <input type="number" name="jumlah" class="form-control" value="{{ $biayaDaftar }}" readonly>
                                <small class="text-muted">Biaya sesuai gelombang pendaftaran</small>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Metode Pembayaran</label>
                                <select name="metode" id="metode" class="form-select" required>
                                    <option value="">Pilih Metode</option>
                                    <option value="QRIS" {{ ($pendaftar->pembayaran->metode ?? '') == 'QRIS' ? 'selected' : '' }}>QRIS</option>
                                    <option value="TRANSFER_BANK" {{ ($pendaftar->pembayaran->metode ?? '') == 'TRANSFER_BANK' ? 'selected' : '' }}>Transfer Bank</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Bukti Pembayaran</label>
                                <input type="file" name="bukti" class="form-control" accept=".pdf,.jpg,.jpeg,.png" required>
                                <small class="text-muted">Format: PDF, JPG, PNG. Maksimal 2MB</small>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Catatan (Opsional)</label>
                                <textarea name="catatan" class="form-control" rows="3">{{ $pendaftar->pembayaran->catatan ?? '' }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">
                                {{ $pendaftar->pembayaran ? 'Update' : 'Upload' }} Bukti Pembayaran
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const metodeSelect = document.getElementById('metode');
    const paymentInfo = document.getElementById('payment-info');
    const qrisInfo = document.getElementById('qris-info');
    const transferInfo = document.getElementById('transfer-info');
    
    metodeSelect.addEventListener('change', function() {
        const selectedMethod = this.value;
        
        if (selectedMethod === 'QRIS') {
            paymentInfo.style.display = 'block';
            qrisInfo.style.display = 'block';
            transferInfo.style.display = 'none';
        } else if (selectedMethod === 'TRANSFER_BANK') {
            paymentInfo.style.display = 'block';
            qrisInfo.style.display = 'none';
            transferInfo.style.display = 'block';
        } else {
            paymentInfo.style.display = 'none';
            qrisInfo.style.display = 'none';
            transferInfo.style.display = 'none';
        }
    });
    
    // Trigger change event if there's already a selected value
    if (metodeSelect.value) {
        metodeSelect.dispatchEvent(new Event('change'));
    }
});
</script>
@endsection