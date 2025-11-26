@extends('layout.form')

@section('title', 'Formulir Pendaftaran')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
           
        </div>
    </div>
</div>

<div class="page-content">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white py-3">
                    <h4 class="card-title mb-0 text-center">
                        <i class="bi bi-pencil-square me-2"></i>Formulir Pendaftaran Siswa Baru
                    </h4>
                </div>
                <div class="card-body p-4">
                    <!-- Step Indicator -->
                    <div class="d-flex justify-content-center mb-5">
                        <div class="step-indicator d-flex align-items-center">
                            <div class="step active" data-step="1">
                                <div class="step-number">1</div>
                                <div class="step-label">Data Siswa</div>
                            </div>
                            <div class="step-line"></div>
                            <div class="step" data-step="2">
                                <div class="step-number">2</div>
                                <div class="step-label">Orang Tua</div>
                            </div>
                            <div class="step-line"></div>
                            <div class="step" data-step="3">
                                <div class="step-number">3</div>
                                <div class="step-label">Sekolah</div>
                            </div>
                            <div class="step-line"></div>
                            <div class="step" data-step="4">
                                <div class="step-number">4</div>
                                <div class="step-label">Alamat</div>
                            </div>
                            <div class="step-line"></div>
                            <div class="step" data-step="5">
                                <div class="step-number">5</div>
                                <div class="step-label">Jurusan</div>
                            </div>
                        </div>
                    </div>

                    <!-- Form -->
                    <form id="pendaftaran-form" method="POST" action="{{ route('calon_siswa.formulir.store') }}">
                        @csrf

                        <!-- Step 1: Data Siswa -->
                        <div class="form-step active" id="step-1">
                            <div class="section-header mb-4">
                                <h5 class="mb-2 text-primary">
                                    <i class="bi bi-person-badge me-2"></i>Data Calon Siswa
                                </h5>
                                <p class="text-muted mb-0">Lengkapi informasi pribadi calon siswa</p>
                            </div>
                            
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label fw-semibold">Nama Lengkap <span class="text-danger">*</span></label>
                                        <input type="text" name="nama" class="form-control form-control-lg" value="{{ old('nama') }}" placeholder="Masukkan nama lengkap" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label fw-semibold">Jenis Kelamin <span class="text-danger">*</span></label>
                                        <select name="jk" class="form-select form-select-lg" required>
                                            <option value="">Pilih Jenis Kelamin</option>
                                            <option value="L" {{ old('jk') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                            <option value="P" {{ old('jk') == 'P' ? 'selected' : '' }}>Perempuan</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row g-3 mt-1">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label fw-semibold">Tempat Lahir <span class="text-danger">*</span></label>
                                        <input type="text" name="tmp_lahir" class="form-control form-control-lg" value="{{ old('tmp_lahir') }}" placeholder="Kota tempat lahir" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label fw-semibold">Tanggal Lahir <span class="text-danger">*</span></label>
                                        <input type="date" name="tgl_lahir" class="form-control form-control-lg" value="{{ old('tgl_lahir') }}" required>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row g-3 mt-1">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label fw-semibold">NIK <span class="text-danger">*</span></label>
                                        <input type="text" name="nik" class="form-control form-control-lg" value="{{ old('nik') }}" maxlength="16" placeholder="16 digit NIK" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label fw-semibold">NISN <span class="text-danger">*</span></label>
                                        <input type="text" name="nisn" class="form-control form-control-lg" value="{{ old('nisn') }}" maxlength="10" placeholder="10 digit NISN" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Step 2: Data Orang Tua -->
                        <div class="form-step" id="step-2">
                            <div class="section-header mb-4">
                                <h5 class="mb-2 text-primary">
                                    <i class="bi bi-people-fill me-2"></i>Data Orang Tua
                                </h5>
                                <p class="text-muted mb-0">Informasi orang tua/wali calon siswa</p>
                            </div>
                            
                            <div class="card mb-4 border-0 shadow-sm">
                                <div class="card-header bg-light py-3">
                                    <h6 class="mb-0 text-primary"><i class="bi bi-gender-male me-2"></i>Data Ayah</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label fw-semibold">Nama Ayah <span class="text-danger">*</span></label>
                                                <input type="text" name="nama_ayah" class="form-control" value="{{ old('nama_ayah') }}" placeholder="Nama lengkap ayah" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label fw-semibold">Pekerjaan Ayah <span class="text-danger">*</span></label>
                                                <select name="pekerjaan_ayah" class="form-select" required>
                                                    <option value="">Pilih Pekerjaan</option>
                                                    <option value="PNS" {{ old('pekerjaan_ayah') == 'PNS' ? 'selected' : '' }}>PNS</option>
                                                    <option value="TNI/Polri" {{ old('pekerjaan_ayah') == 'TNI/Polri' ? 'selected' : '' }}>TNI/Polri</option>
                                                    <option value="Wiraswasta" {{ old('pekerjaan_ayah') == 'Wiraswasta' ? 'selected' : '' }}>Wiraswasta</option>
                                                    <option value="Karyawan Swasta" {{ old('pekerjaan_ayah') == 'Karyawan Swasta' ? 'selected' : '' }}>Karyawan Swasta</option>
                                                    <option value="Petani" {{ old('pekerjaan_ayah') == 'Petani' ? 'selected' : '' }}>Petani</option>
                                                    <option value="Lainnya" {{ old('pekerjaan_ayah') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mt-2">
                                        <label class="form-label fw-semibold">No. HP Ayah <span class="text-danger">*</span></label>
                                        <input type="tel" name="hp_ayah" class="form-control" value="{{ old('hp_ayah') }}" placeholder="Nomor telepon ayah" required>
                                    </div>
                                </div>
                            </div>

                            <div class="card mb-4 border-0 shadow-sm">
                                <div class="card-header bg-light py-3">
                                    <h6 class="mb-0 text-primary"><i class="bi bi-gender-female me-2"></i>Data Ibu</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label fw-semibold">Nama Ibu <span class="text-danger">*</span></label>
                                                <input type="text" name="nama_ibu" class="form-control" value="{{ old('nama_ibu') }}" placeholder="Nama lengkap ibu" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label fw-semibold">Pekerjaan Ibu <span class="text-danger">*</span></label>
                                                <select name="pekerjaan_ibu" class="form-select" required>
                                                    <option value="">Pilih Pekerjaan</option>
                                                    <option value="Ibu Rumah Tangga" {{ old('pekerjaan_ibu') == 'Ibu Rumah Tangga' ? 'selected' : '' }}>Ibu Rumah Tangga</option>
                                                    <option value="PNS" {{ old('pekerjaan_ibu') == 'PNS' ? 'selected' : '' }}>PNS</option>
                                                    <option value="Wiraswasta" {{ old('pekerjaan_ibu') == 'Wiraswasta' ? 'selected' : '' }}>Wiraswasta</option>
                                                    <option value="Karyawan Swasta" {{ old('pekerjaan_ibu') == 'Karyawan Swasta' ? 'selected' : '' }}>Karyawan Swasta</option>
                                                    <option value="Lainnya" {{ old('pekerjaan_ibu') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mt-2">
                                        <label class="form-label fw-semibold">No. HP Ibu <span class="text-danger">*</span></label>
                                        <input type="tel" name="hp_ibu" class="form-control" value="{{ old('hp_ibu') }}" placeholder="Nomor telepon ibu" required>
                                    </div>
                                </div>
                            </div>

                            <div class="card border-0 shadow-sm">
                                <div class="card-header bg-light py-3">
                                    <h6 class="mb-0 text-primary"><i class="bi bi-person-badge me-2"></i>Data Wali (Opsional)</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label fw-semibold">Nama Wali</label>
                                                <input type="text" name="wali_nama" class="form-control" value="{{ old('wali_nama') }}" placeholder="Nama lengkap wali">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label fw-semibold">No. HP Wali</label>
                                                <input type="tel" name="wali_hp" class="form-control" value="{{ old('wali_hp') }}" placeholder="Nomor telepon wali">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Step 3: Asal Sekolah -->
                        <div class="form-step" id="step-3">
                            <div class="section-header mb-4">
                                <h5 class="mb-2 text-primary">
                                    <i class="bi bi-building me-2"></i>Data Sekolah Asal
                                </h5>
                                <p class="text-muted mb-0">Informasi sekolah sebelumnya</p>
                            </div>
                            
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label fw-semibold">NPSN Sekolah <span class="text-danger">*</span></label>
                                        <input type="text" name="npsn" class="form-control form-control-lg" value="{{ old('npsn') }}" maxlength="8" placeholder="8 digit NPSN" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label fw-semibold">Nama Sekolah <span class="text-danger">*</span></label>
                                        <input type="text" name="nama_sekolah" class="form-control form-control-lg" value="{{ old('nama_sekolah') }}" placeholder="Nama sekolah asal" required>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row g-3 mt-1">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label fw-semibold">Kabupaten/Kota <span class="text-danger">*</span></label>
                                        <input type="text" name="kabupaten" class="form-control form-control-lg" value="{{ old('kabupaten') }}" placeholder="Kabupaten/Kota sekolah" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label fw-semibold">Nilai Rata-rata <span class="text-danger">*</span></label>
                                        <input type="number" name="nilai_rata" class="form-control form-control-lg" value="{{ old('nilai_rata') }}" min="0" max="100" step="0.01" placeholder="0.00 - 100.00" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Step 4: Alamat & Koordinat -->
                        <div class="form-step" id="step-4">
                            <div class="section-header mb-4">
                                <h5 class="mb-2 text-primary">
                                    <i class="bi bi-geo-alt-fill me-2"></i>Alamat & Lokasi
                                </h5>
                                <p class="text-muted mb-0">Informasi tempat tinggal calon siswa</p>
                            </div>
                            
                            <div class="form-group mb-4">
                                <label class="form-label fw-semibold">Alamat Lengkap <span class="text-danger">*</span></label>
                                <textarea name="alamat" class="form-control" rows="3" placeholder="Tuliskan alamat lengkap tempat tinggal" required>{{ old('alamat') }}</textarea>
                            </div>
                            
                            <div class="row g-3 mb-4">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-label fw-semibold">Provinsi <span class="text-danger">*</span></label>
                                        <select id="provinces_id" class="form-select" required>
                                            <option value="">Pilih Provinsi</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-label fw-semibold">Kabupaten/Kota <span class="text-danger">*</span></label>
                                        <select id="regencies_id" class="form-select" required disabled>
                                            <option value="">Pilih Kabupaten</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-label fw-semibold">Kecamatan <span class="text-danger">*</span></label>
                                        <select id="districts_id" class="form-select" required disabled>
                                            <option value="">Pilih Kecamatan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-label fw-semibold">Kelurahan/Desa <span class="text-danger">*</span></label>
                                        <select name="village_id" id="villages_id" class="form-select" required disabled>
                                            <option value="">Pilih Kelurahan</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group mb-4">
                                <label class="form-label fw-semibold">Pilih Lokasi di Peta</label>
                                <div class="map-container">
                                    <div id="map" style="height: 300px; border-radius: 0.5rem; border: 1px solid #dee2e6;"></div>
                                </div>
                                <small class="text-muted mt-2 d-block">Klik pada peta untuk menentukan lokasi rumah Anda</small>
                            </div>
                            
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label fw-semibold">Latitude</label>
                                        <input type="text" name="lat" id="lat" class="form-control" value="{{ old('lat') }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label fw-semibold">Longitude</label>
                                        <input type="text" name="lng" id="lng" class="form-control" value="{{ old('lng') }}" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Step 5: Jurusan & Gelombang -->
                        <div class="form-step" id="step-5">
                            <div class="section-header mb-4">
                                <h5 class="mb-2 text-primary">
                                    <i class="bi bi-bookmark-fill me-2"></i>Pilihan Jurusan & Gelombang
                                </h5>
                                <p class="text-muted mb-0">Pilih program dan periode pendaftaran</p>
                            </div>
                            
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label fw-semibold">Gelombang Pendaftaran <span class="text-danger">*</span></label>
                                        <select name="gelombang_id" class="form-select form-select-lg" required>
                                            <option value="">Pilih Gelombang</option>
                                            @foreach($gelombang as $g)
                                            <option value="{{ $g->id }}" {{ old('gelombang_id') == $g->id ? 'selected' : '' }}>
                                                {{ $g->nama }} - Rp {{ number_format($g->biaya_daftar, 0, ',', '.') }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label fw-semibold">Jurusan yang Dipilih <span class="text-danger">*</span></label>
                                        <select name="jurusan_id" class="form-select form-select-lg" required>
                                            <option value="">Pilih Jurusan</option>
                                            @foreach($jurusan as $j)
                                            <option value="{{ $j->id }}" {{ old('jurusan_id') == $j->id ? 'selected' : '' }}>
                                                {{ $j->nama }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="alert alert-info mt-4 border-0 shadow-sm">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-info-circle-fill me-3 fs-4"></i>
                                    <div>
                                        <strong>Informasi Penting:</strong> Data akan langsung dikirim untuk verifikasi setelah submit. Pastikan semua data yang diisi sudah benar.
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Navigation Buttons -->
                        <div class="d-flex justify-content-between mt-5 pt-3 border-top">
                            <button type="button" class="btn btn-outline-secondary px-4" id="prevBtn" style="display: none;">
                                <i class="bi bi-arrow-left me-2"></i>Sebelumnya
                            </button>
                            
                            <div class="ms-auto">
                                <button type="button" class="btn btn-primary px-4 me-2" id="nextBtn">
                                    Selanjutnya<i class="bi bi-arrow-right ms-2"></i>
                                </button>
                                <button type="submit" class="btn btn-success px-4" id="submitBtn" style="display: none;">
                                    <i class="bi bi-send-check me-2"></i>Kirim Formulir
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<style>
/* Step Indicator Styles */
.step-indicator {
    gap: 1rem;
}

.step {
    display: flex;
    flex-direction: column;
    align-items: center;
    position: relative;
    min-width: 100px;
}

.step-number {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: #f8f9fa;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    margin-bottom: 0.5rem;
    border: 3px solid #e9ecef;
    transition: all 0.3s ease;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.step.active .step-number {
    background: #435ebe;
    color: white;
    border-color: #435ebe;
    transform: scale(1.05);
}

.step.completed .step-number {
    background: #198754;
    color: white;
    border-color: #198754;
}

.step-label {
    font-size: 0.875rem;
    font-weight: 500;
    color: #6c757d;
    text-align: center;
    transition: all 0.3s ease;
}

.step.active .step-label {
    color: #435ebe;
    font-weight: 600;
}

.step-line {
    width: 80px;
    height: 3px;
    background: #e9ecef;
    margin-top: 25px;
    transition: all 0.3s ease;
}

.step.completed + .step-line {
    background: #198754;
}

/* Form Steps */
.form-step {
    display: none;
    animation: fadeIn 0.5s ease;
}

.form-step.active {
    display: block;
}

/* Section Headers */
.section-header {
    padding-bottom: 1rem;
    border-bottom: 2px solid #f1f3f4;
}

/* Form Controls */
.form-control, .form-select {
    border-radius: 0.5rem;
    border: 1px solid #dee2e6;
    padding: 0.75rem 1rem;
    transition: all 0.2s ease;
}

.form-control:focus, .form-select:focus {
    border-color: #435ebe;
    box-shadow: 0 0 0 0.2rem rgba(67, 94, 190, 0.25);
}

.form-control-lg {
    padding: 1rem 1.25rem;
    font-size: 1.05rem;
}

/* Card Styles */
.card {
    border-radius: 0.75rem;
    overflow: hidden;
}

.card-header {
    border-bottom: 1px solid rgba(0,0,0,0.05);
}

/* Button Styles */
.btn {
    border-radius: 0.5rem;
    padding: 0.75rem 1.5rem;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn-primary {
    background: linear-gradient(135deg, #435ebe 0%, #2a3990 100%);
    border: none;
}

.btn-primary:hover {
    background: linear-gradient(135deg, #3a51a8 0%, #1f2c7a 100%);
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(67, 94, 190, 0.3);
}

.btn-success {
    background: linear-gradient(135deg, #198754 0%, #146c43 100%);
    border: none;
}

.btn-success:hover {
    background: linear-gradient(135deg, #157347 0%, #0f5132 100%);
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(25, 135, 84, 0.3);
}

.btn-outline-secondary:hover {
    transform: translateY(-2px);
}

/* Map Container */
.map-container {
    position: relative;
    border-radius: 0.5rem;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

/* Animations */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

/* Responsive Adjustments */
@media (max-width: 768px) {
    .step-indicator {
        flex-wrap: wrap;
        gap: 0.5rem;
    }
    
    .step {
        min-width: 80px;
    }
    
    .step-number {
        width: 40px;
        height: 40px;
        font-size: 0.9rem;
    }
    
    .step-line {
        width: 40px;
        margin-top: 20px;
    }
    
    .step-label {
        font-size: 0.75rem;
    }
    
    .card-body {
        padding: 1.5rem;
    }
    
    .btn {
        padding: 0.6rem 1.2rem;
        font-size: 0.9rem;
    }
}

/* Form Validation Styles */
.is-invalid {
    border-color: #dc3545 !important;
}

.invalid-feedback {
    display: none;
    width: 100%;
    margin-top: 0.25rem;
    font-size: 0.875em;
    color: #dc3545;
}

.is-invalid ~ .invalid-feedback {
    display: block;
}

/* Progress Bar (Alternative) */
.progress {
    height: 8px;
    border-radius: 4px;
    margin-bottom: 2rem;
}

.progress-bar {
    background: linear-gradient(90deg, #435ebe 0%, #198754 100%);
    border-radius: 4px;
    transition: width 0.5s ease;
}
</style>

<script>
let currentStep = 1;
const totalSteps = 5;
let map, marker;

// Initialize
document.addEventListener('DOMContentLoaded', function() {
    initializeMap();
    loadProvinces();
    updateStepDisplay();
    
    document.getElementById('nextBtn').addEventListener('click', nextStep);
    document.getElementById('prevBtn').addEventListener('click', prevStep);
    
    // Add input validation on blur
    document.querySelectorAll('input, select').forEach(field => {
        field.addEventListener('blur', function() {
            validateField(this);
        });
    });
});

// Load provinces
async function loadProvinces() {
    try {
        const response = await fetch('/api/provinces');
        const provinces = await response.json();
        const provinceSelect = document.getElementById('provinces_id');
        
        provinces.forEach(province => {
            const option = document.createElement('option');
            option.value = province.id;
            option.textContent = province.name;
            provinceSelect.appendChild(option);
        });
        
        provinceSelect.addEventListener('change', loadRegencies);
    } catch (error) {
        console.error('Error loading provinces:', error);
    }
}

// Load regencies
async function loadRegencies() {
    const provinceId = document.getElementById('provinces_id').value;
    const regencySelect = document.getElementById('regencies_id');
    const districtSelect = document.getElementById('districts_id');
    const villageSelect = document.getElementById('villages_id');
    
    regencySelect.innerHTML = '<option value="">Pilih Kabupaten</option>';
    districtSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
    villageSelect.innerHTML = '<option value="">Pilih Kelurahan</option>';
    
    if (!provinceId) {
        regencySelect.disabled = true;
        districtSelect.disabled = true;
        villageSelect.disabled = true;
        return;
    }
    
    try {
        const response = await fetch(`/api/regencies/${provinceId}`);
        const regencies = await response.json();
        
        regencies.forEach(regency => {
            const option = document.createElement('option');
            option.value = regency.id;
            option.textContent = regency.name;
            regencySelect.appendChild(option);
        });
        
        regencySelect.disabled = false;
        regencySelect.addEventListener('change', loadDistricts);
    } catch (error) {
        console.error('Error loading regencies:', error);
    }
}

// Load districts
async function loadDistricts() {
    const regencyId = document.getElementById('regencies_id').value;
    const districtSelect = document.getElementById('districts_id');
    const villageSelect = document.getElementById('villages_id');
    
    districtSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
    villageSelect.innerHTML = '<option value="">Pilih Kelurahan</option>';
    
    if (!regencyId) {
        districtSelect.disabled = true;
        villageSelect.disabled = true;
        return;
    }
    
    try {
        const response = await fetch(`/api/districts/${regencyId}`);
        const districts = await response.json();
        
        districts.forEach(district => {
            const option = document.createElement('option');
            option.value = district.id;
            option.textContent = district.name;
            districtSelect.appendChild(option);
        });
        
        districtSelect.disabled = false;
        districtSelect.addEventListener('change', loadVillages);
    } catch (error) {
        console.error('Error loading districts:', error);
    }
}

// Load villages
async function loadVillages() {
    const districtId = document.getElementById('districts_id').value;
    const villageSelect = document.getElementById('villages_id');
    
    villageSelect.innerHTML = '<option value="">Pilih Kelurahan</option>';
    
    if (!districtId) {
        villageSelect.disabled = true;
        return;
    }
    
    try {
        const response = await fetch(`/api/villages/${districtId}`);
        const villages = await response.json();
        
        villages.forEach(village => {
            const option = document.createElement('option');
            option.value = village.id;
            option.textContent = village.name;
            villageSelect.appendChild(option);
        });
        
        villageSelect.disabled = false;
    } catch (error) {
        console.error('Error loading villages:', error);
    }
}

function initializeMap() {
    map = L.map('map').setView([-6.2088, 106.8456], 10);
    
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    map.on('click', function(e) {
        if (marker) {
            map.removeLayer(marker);
        }
        
        marker = L.marker(e.latlng).addTo(map);
        document.getElementById('lat').value = e.latlng.lat.toFixed(6);
        document.getElementById('lng').value = e.latlng.lng.toFixed(6);
    });
}

function nextStep() {
    if (validateCurrentStep()) {
        if (currentStep < totalSteps) {
            currentStep++;
            updateStepDisplay();
            scrollToTop();
        }
    }
}

function prevStep() {
    if (currentStep > 1) {
        currentStep--;
        updateStepDisplay();
        scrollToTop();
    }
}

function scrollToTop() {
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

function validateField(field) {
    if (field.hasAttribute('required') && !field.value.trim()) {
        field.classList.add('is-invalid');
        return false;
    } else {
        field.classList.remove('is-invalid');
        return true;
    }
}

function validateCurrentStep() {
    const currentSection = document.getElementById(`step-${currentStep}`);
    const requiredFields = currentSection.querySelectorAll('[required]');
    let isValid = true;

    requiredFields.forEach(field => {
        if (!validateField(field)) {
            isValid = false;
        }
    });

    if (!isValid) {
        // Show error message with animation
        const errorAlert = document.createElement('div');
        errorAlert.className = 'alert alert-danger alert-dismissible fade show';
        errorAlert.innerHTML = `
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            <strong>Perhatian!</strong> Harap lengkapi semua field yang wajib diisi.
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;
        
        // Remove any existing alerts
        const existingAlert = document.querySelector('.alert-danger');
        if (existingAlert) {
            existingAlert.remove();
        }
        
        currentSection.prepend(errorAlert);
        
        // Scroll to first invalid field
        const firstInvalid = currentSection.querySelector('.is-invalid');
        if (firstInvalid) {
            firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
            firstInvalid.focus();
        }
    }

    return isValid;
}

function updateStepDisplay() {
    // Hide all sections
    document.querySelectorAll('.form-step').forEach(section => {
        section.classList.remove('active');
    });
    
    // Show current section
    document.getElementById(`step-${currentStep}`).classList.add('active');
    
    // Update step indicators
    document.querySelectorAll('.step').forEach((step, index) => {
        step.classList.remove('active', 'completed');
        if (index + 1 === currentStep) {
            step.classList.add('active');
        } else if (index + 1 < currentStep) {
            step.classList.add('completed');
        }
    });
    
    // Update buttons
    document.getElementById('prevBtn').style.display = currentStep === 1 ? 'none' : 'inline-block';
    document.getElementById('nextBtn').style.display = currentStep === totalSteps ? 'none' : 'inline-block';
    document.getElementById('submitBtn').style.display = currentStep === totalSteps ? 'inline-block' : 'none';
}
</script>
@endsection