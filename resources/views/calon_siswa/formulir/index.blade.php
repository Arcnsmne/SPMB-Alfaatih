@extends('layouts.app')

@section('title', 'Formulir Pendaftaran')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Formulir Pendaftaran</h3>
                <p class="text-subtitle text-muted">Lengkapi data pendaftaran Anda</p>
            </div>
        </div>
    </div>
</div>

<div class="page-content">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Data Pendaftaran</h4>
                        @if($draft)
                            <span class="badge bg-warning">
                                <i class="bi bi-pencil-square me-1"></i>Mode Edit Draft
                            </span>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <!-- Step Indicator -->
                    <div class="d-flex justify-content-center mb-4">
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
                    <form id="pendaftaran-form" method="POST" action="{{ $draft ? route('calon_siswa.formulir.update', $draft->id) : route('calon_siswa.formulir.store') }}">
                        @csrf
                        @if($draft)
                            @method('PUT')
                        @endif

                        <!-- Step 1: Data Siswa -->
                        <div class="form-step active" id="step-1">
                            <h5 class="mb-3">
                                <i class="bi bi-person-fill me-2"></i>Data Calon Siswa
                            </h5>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                        <input type="text" name="nama" class="form-control" value="{{ old('nama', $draft->nama ?? '') }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                                        <select name="jk" class="form-select" required>
                                            <option value="">Pilih Jenis Kelamin</option>
                                            <option value="L" {{ old('jk', $draft->jk ?? '') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                            <option value="P" {{ old('jk', $draft->jk ?? '') == 'P' ? 'selected' : '' }}>Perempuan</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Tempat Lahir <span class="text-danger">*</span></label>
                                        <input type="text" name="tmp_lahir" class="form-control" value="{{ old('tmp_lahir', $draft->tmp_lahir ?? '') }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                                        <input type="date" name="tgl_lahir" class="form-control" value="{{ old('tgl_lahir', $draft->tgl_lahir ?? '') }}" required>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">NIK <span class="text-danger">*</span></label>
                                        <input type="text" name="nik" class="form-control" value="{{ old('nik', $draft->nik ?? '') }}" maxlength="16" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">NISN <span class="text-danger">*</span></label>
                                        <input type="text" name="nisn" class="form-control" value="{{ old('nisn', $draft->nisn ?? '') }}" maxlength="10" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Step 2: Data Orang Tua -->
                        <div class="form-step" id="step-2">
                            <h5 class="mb-3">
                                <i class="bi bi-people-fill me-2"></i>Data Orang Tua
                            </h5>
                            
                            <div class="card mb-3">
                                <div class="card-header">
                                    <h6 class="mb-0"><i class="bi bi-gender-male me-2"></i>Data Ayah</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Nama Ayah <span class="text-danger">*</span></label>
                                                <input type="text" name="nama_ayah" class="form-control" value="{{ old('nama_ayah', $draft->nama_ayah ?? '') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Pekerjaan Ayah <span class="text-danger">*</span></label>
                                                <select name="pekerjaan_ayah" class="form-select" required>
                                                    <option value="">Pilih Pekerjaan</option>
                                                    <option value="PNS" {{ old('pekerjaan_ayah', $draft->pekerjaan_ayah ?? '') == 'PNS' ? 'selected' : '' }}>PNS</option>
                                                    <option value="TNI/Polri" {{ old('pekerjaan_ayah', $draft->pekerjaan_ayah ?? '') == 'TNI/Polri' ? 'selected' : '' }}>TNI/Polri</option>
                                                    <option value="Wiraswasta" {{ old('pekerjaan_ayah', $draft->pekerjaan_ayah ?? '') == 'Wiraswasta' ? 'selected' : '' }}>Wiraswasta</option>
                                                    <option value="Karyawan Swasta" {{ old('pekerjaan_ayah', $draft->pekerjaan_ayah ?? '') == 'Karyawan Swasta' ? 'selected' : '' }}>Karyawan Swasta</option>
                                                    <option value="Petani" {{ old('pekerjaan_ayah', $draft->pekerjaan_ayah ?? '') == 'Petani' ? 'selected' : '' }}>Petani</option>
                                                    <option value="Lainnya" {{ old('pekerjaan_ayah', $draft->pekerjaan_ayah ?? '') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">No. HP Ayah <span class="text-danger">*</span></label>
                                        <input type="tel" name="hp_ayah" class="form-control" value="{{ old('hp_ayah', $draft->hp_ayah ?? '') }}" required>
                                    </div>
                                </div>
                            </div>

                            <div class="card mb-3">
                                <div class="card-header">
                                    <h6 class="mb-0"><i class="bi bi-gender-female me-2"></i>Data Ibu</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Nama Ibu <span class="text-danger">*</span></label>
                                                <input type="text" name="nama_ibu" class="form-control" value="{{ old('nama_ibu', $draft->nama_ibu ?? '') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Pekerjaan Ibu <span class="text-danger">*</span></label>
                                                <select name="pekerjaan_ibu" class="form-select" required>
                                                    <option value="">Pilih Pekerjaan</option>
                                                    <option value="Ibu Rumah Tangga" {{ old('pekerjaan_ibu', $draft->pekerjaan_ibu ?? '') == 'Ibu Rumah Tangga' ? 'selected' : '' }}>Ibu Rumah Tangga</option>
                                                    <option value="PNS" {{ old('pekerjaan_ibu', $draft->pekerjaan_ibu ?? '') == 'PNS' ? 'selected' : '' }}>PNS</option>
                                                    <option value="Wiraswasta" {{ old('pekerjaan_ibu', $draft->pekerjaan_ibu ?? '') == 'Wiraswasta' ? 'selected' : '' }}>Wiraswasta</option>
                                                    <option value="Karyawan Swasta" {{ old('pekerjaan_ibu', $draft->pekerjaan_ibu ?? '') == 'Karyawan Swasta' ? 'selected' : '' }}>Karyawan Swasta</option>
                                                    <option value="Lainnya" {{ old('pekerjaan_ibu', $draft->pekerjaan_ibu ?? '') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">No. HP Ibu <span class="text-danger">*</span></label>
                                        <input type="tel" name="hp_ibu" class="form-control" value="{{ old('hp_ibu', $draft->hp_ibu ?? '') }}" required>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header">
                                    <h6 class="mb-0"><i class="bi bi-person-badge me-2"></i>Data Wali (Opsional)</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Nama Wali</label>
                                                <input type="text" name="wali_nama" class="form-control" value="{{ old('wali_nama', $draft->wali_nama ?? '') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">No. HP Wali</label>
                                                <input type="tel" name="wali_hp" class="form-control" value="{{ old('wali_hp', $draft->wali_hp ?? '') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Step 3: Asal Sekolah -->
                        <div class="form-step" id="step-3">
                            <h5 class="mb-3">
                                <i class="bi bi-building me-2"></i>Data Sekolah Asal
                            </h5>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">NPSN Sekolah <span class="text-danger">*</span></label>
                                        <input type="text" name="npsn" class="form-control" value="{{ old('npsn', $draft->npsn ?? '') }}" maxlength="8" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Nama Sekolah <span class="text-danger">*</span></label>
                                        <input type="text" name="nama_sekolah" class="form-control" value="{{ old('nama_sekolah', $draft->nama_sekolah ?? '') }}" required>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Kabupaten/Kota <span class="text-danger">*</span></label>
                                        <input type="text" name="kabupaten" class="form-control" value="{{ old('kabupaten', $draft->kabupaten ?? '') }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Nilai Rata-rata <span class="text-danger">*</span></label>
                                        <input type="number" name="nilai_rata" class="form-control" value="{{ old('nilai_rata', $draft->nilai_rata ?? '') }}" min="0" max="100" step="0.01" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Step 4: Alamat & Koordinat -->
                        <div class="form-step" id="step-4">
                            <h5 class="mb-3">
                                <i class="bi bi-geo-alt-fill me-2"></i>Alamat & Lokasi
                            </h5>
                            
                            <div class="form-group">
                                <label class="form-label">Alamat Lengkap <span class="text-danger">*</span></label>
                                <textarea name="alamat" class="form-control" rows="3" required>{{ old('alamat', $draft->alamat ?? '') }}</textarea>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-label">Provinsi <span class="text-danger">*</span></label>
                                        <select id="province_id" class="form-select" required>
                                            <option value="">Pilih Provinsi</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-label">Kabupaten/Kota <span class="text-danger">*</span></label>
                                        <select id="regency_id" class="form-select" required disabled>
                                            <option value="">Pilih Kabupaten</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-label">Kecamatan <span class="text-danger">*</span></label>
                                        <select id="district_id" class="form-select" required disabled>
                                            <option value="">Pilih Kecamatan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-label">Kelurahan/Desa <span class="text-danger">*</span></label>
                                        <select name="village_id" id="village_id" class="form-select" required disabled>
                                            <option value="">Pilih Kelurahan</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="form-label">Pilih Lokasi di Peta</label>
                                <div id="map" style="height: 300px; border-radius: 0.5rem;"></div>
                                <small class="text-muted">Klik pada peta untuk menentukan lokasi rumah Anda</small>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Latitude</label>
                                        <input type="text" name="lat" id="lat" class="form-control" value="{{ old('lat', $draft->lat ?? '') }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Longitude</label>
                                        <input type="text" name="lng" id="lng" class="form-control" value="{{ old('lng', $draft->lng ?? '') }}" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Step 5: Jurusan & Gelombang -->
                        <div class="form-step" id="step-5">
                            <h5 class="mb-3">
                                <i class="bi bi-bookmark-fill me-2"></i>Pilihan Jurusan & Gelombang
                            </h5>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Gelombang Pendaftaran <span class="text-danger">*</span></label>
                                        <select name="gelombang_id" class="form-select" required>
                                            <option value="">Pilih Gelombang</option>
                                            @foreach($gelombang as $g)
                                            <option value="{{ $g->id }}" {{ old('gelombang_id', $draft->gelombang_id ?? '') == $g->id ? 'selected' : '' }}>
                                                {{ $g->nama }} - Rp {{ number_format($g->biaya_daftar, 0, ',', '.') }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Jurusan yang Dipilih <span class="text-danger">*</span></label>
                                        <select name="jurusan_id" class="form-select" required>
                                            <option value="">Pilih Jurusan</option>
                                            @foreach($jurusan as $j)
                                            <option value="{{ $j->id }}" {{ old('jurusan_id', $draft->jurusan_id ?? '') == $j->id ? 'selected' : '' }}>
                                                {{ $j->nama }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="alert alert-info">
                                <i class="bi bi-info-circle me-2"></i>
                                <strong>Informasi:</strong> Data akan disimpan sebagai draft dan dapat diedit kembali sebelum submit final.
                            </div>
                        </div>

                        <!-- Navigation Buttons -->
                        <div class="d-flex justify-content-between mt-4">
                            <button type="button" class="btn btn-secondary" id="prevBtn" style="display: none;">
                                <i class="bi bi-arrow-left me-2"></i>Sebelumnya
                            </button>
                            
                            <div class="ms-auto">
                                <button type="button" class="btn btn-primary me-2" id="nextBtn">
                                    Selanjutnya<i class="bi bi-arrow-right ms-2"></i>
                                </button>
                                <button type="submit" class="btn btn-success" id="submitBtn" style="display: none;">
                                    <i class="bi bi-save me-2"></i>Simpan Draft
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
.step-indicator {
    gap: 1rem;
}

.step {
    display: flex;
    flex-direction: column;
    align-items: center;
    position: relative;
}

.step-number {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: #e9ecef;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    margin-bottom: 0.5rem;
}

.step.active .step-number {
    background: #435ebe;
    color: white;
}

.step.completed .step-number {
    background: #198754;
    color: white;
}

.step-label {
    font-size: 0.875rem;
    font-weight: 500;
    color: #6c757d;
}

.step.active .step-label {
    color: #435ebe;
    font-weight: 600;
}

.step-line {
    width: 60px;
    height: 2px;
    background: #e9ecef;
    margin-top: 20px;
}

.step.completed + .step-line {
    background: #198754;
}

.form-step {
    display: none;
}

.form-step.active {
    display: block;
}

@media (max-width: 768px) {
    .step-indicator {
        flex-wrap: wrap;
        gap: 0.5rem;
    }
    
    .step-line {
        width: 30px;
    }
    
    .step-label {
        font-size: 0.75rem;
    }
}
</style>

<script>
let currentStep = 1;
const totalSteps = 5;
let map, marker;

// Initialize
document.addEventListener('DOMContentLoaded', function() {
    initializeMap();
    updateStepDisplay();
    
    document.getElementById('nextBtn').addEventListener('click', nextStep);
    document.getElementById('prevBtn').addEventListener('click', prevStep);
});

function initializeMap() {
    map = L.map('map').setView([-6.2088, 106.8456], 10);
    
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    @if($draft && $draft->lat && $draft->lng)
        marker = L.marker([{{ $draft->lat }}, {{ $draft->lng }}]).addTo(map);
        map.setView([{{ $draft->lat }}, {{ $draft->lng }}], 15);
    @endif

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
        }
    }
}

function prevStep() {
    if (currentStep > 1) {
        currentStep--;
        updateStepDisplay();
    }
}

function validateCurrentStep() {
    const currentSection = document.getElementById(`step-${currentStep}`);
    const requiredFields = currentSection.querySelectorAll('[required]');
    let isValid = true;

    requiredFields.forEach(field => {
        if (!field.value.trim()) {
            field.classList.add('is-invalid');
            isValid = false;
        } else {
            field.classList.remove('is-invalid');
        }
    });

    if (!isValid) {
        Swal.fire({
            icon: 'warning',
            title: 'Data Belum Lengkap',
            text: 'Harap lengkapi semua field yang wajib diisi!'
        });
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
        :root {
            --primary: #2c3e50;
            --secondary: #34495e;
            --accent: #3498db;
            --success: #27ae60;
            --warning: #e67e22;
            --light-bg: #f8f9fa;
            --border: #e9ecef;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }
        
        .form-container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            border-radius: 15px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        
        .form-header {
            background: linear-gradient(135deg, #2c3e50, #34495e);
            color: white;
            padding: 2rem;
            text-align: center;
        }
        
        .school-logo {
            width: 80px;
            height: 80px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            font-weight: bold;
            font-size: 1.5rem;
            color: #2c3e50;
        }
        
        .progress-container {
            background: white;
            padding: 1.5rem 2rem;
            border-bottom: 1px solid var(--border);
        }
        
        .progress-steps {
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
            margin-bottom: 1rem;
        }
        
        .progress-steps::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 2px;
            background: #e9ecef;
            transform: translateY(-50%);
            z-index: 1;
        }
        
        .step {
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            z-index: 2;
            cursor: pointer;
        }
        
        .step-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: white;
            border: 2px solid #e9ecef;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 0.5rem;
            transition: all 0.3s ease;
        }
        
        .step.active .step-icon {
            background: var(--accent);
            border-color: var(--accent);
            color: white;
        }
        
        .step.completed .step-icon {
            background: var(--success);
            border-color: var(--success);
            color: white;
        }
        
        .step-label {
            font-size: 0.8rem;
            font-weight: 500;
            color: #6c757d;
            text-align: center;
        }
        
        .step.active .step-label {
            color: var(--accent);
            font-weight: 600;
        }
        
        .form-content {
            padding: 2rem;
            max-height: 70vh;
            overflow-y: auto;
        }
        
        .form-section {
            display: none;
            animation: fadeIn 0.5s ease-in;
        }
        
        .form-section.active {
            display: block;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .section-header {
            border-bottom: 2px solid var(--accent);
            padding-bottom: 1rem;
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        .section-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            background: var(--accent);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.25rem;
        }
        
        .section-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--primary);
            margin: 0;
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-label {
            font-weight: 500;
            margin-bottom: 0.5rem;
            color: var(--primary);
        }
        
        .required::after {
            content: ' *';
            color: #e74c3c;
        }
        
        .form-control, .form-select {
            border-radius: 8px;
            border: 1px solid var(--border);
            padding: 0.75rem;
            transition: all 0.3s ease;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
        }
        
        .form-actions {
            background: white;
            padding: 1.5rem 2rem;
            border-top: 1px solid var(--border);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .btn {
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .btn-primary {
            background: var(--accent);
            border-color: var(--accent);
        }
        
        .btn-primary:hover {
            background: #2980b9;
            border-color: #2980b9;
            transform: translateY(-2px);
        }
        
        .btn-outline-secondary {
            border-color: #bdc3c7;
            color: #7f8c8d;
        }
        
        .btn-outline-secondary:hover {
            background: #ecf0f1;
            border-color: #95a5a6;
        }
        
        .navigation-buttons {
            display: flex;
            gap: 1rem;
        }
        
        .step-indicator {
            color: #7f8c8d;
            font-weight: 500;
        }
        
        .is-invalid {
            border-color: #e74c3c !important;
        }
        
        .invalid-feedback {
            display: none;
            color: #e74c3c;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
        
        .is-invalid ~ .invalid-feedback {
            display: block;
        }

        .card {
            border: 1px solid var(--border);
            border-radius: 10px;
            margin-bottom: 1.5rem;
        }
        
        .card-header {
            background: var(--light-bg);
            border-bottom: 1px solid var(--border);
            padding: 1rem 1.5rem;
            font-weight: 600;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            body {
                padding: 10px;
            }
            
            .form-content {
                padding: 1rem;
                max-height: 60vh;
            }
            
            .form-header {
                padding: 1.5rem 1rem;
            }
            
            .progress-container {
                padding: 1rem;
            }
            
            .step-label {
                font-size: 0.7rem;
            }
            
            .section-header {
                flex-direction: column;
                text-align: center;
                gap: 0.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="form-container">
        <!-- Header -->
        <div class="form-header">
            <div class="school-logo">
                <i class="bi bi-mortarboard-fill"></i>
            </div>
            <h1>Formulir Pendaftaran</h1>
            <p class="mb-0">SMK Bakti Nusantara 666 - Tahun Ajaran 2024/2025</p>
        </div>
        
        <!-- Progress Steps -->
        <div class="progress-container">
            <div class="progress-steps">
                <div class="step active" data-step="1">
                    <div class="step-icon">
                        <i class="bi bi-person-fill"></i>
                    </div>
                    <div class="step-label">Biodata</div>
                </div>
                <div class="step" data-step="2">
                    <div class="step-icon">
                        <i class="bi bi-people-fill"></i>
                    </div>
                    <div class="step-label">Orang Tua</div>
                </div>
                <div class="step" data-step="3">
                    <div class="step-icon">
                        <i class="bi bi-bookmark-fill"></i>
                    </div>
                    <div class="step-label">Jurusan</div>
                </div>
                <div class="step" data-step="4">
                    <div class="step-icon">
                        <i class="bi bi-building"></i>
                    </div>
                    <div class="step-label">Sekolah</div>
                </div>
                <div class="step" data-step="5">
                    <div class="step-icon">
                        <i class="bi bi-geo-alt-fill"></i>
                    </div>
                    <div class="step-label">Alamat</div>
                </div>
                <div class="step" data-step="6">
                    <div class="step-icon">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>
                    <div class="step-label">Selesai</div>
                </div>
            </div>
        </div>
        
        <!-- Form Content -->
        <form id="registration-form" action="{{ route('pendaftar.store') }}" method="POST">
            @csrf
            <div class="form-content">
                <!-- Section 1: Biodata -->
                <div class="form-section active" id="section-1">
                    <div class="section-header">
                        <div class="section-icon">
                            <i class="bi bi-person-fill"></i>
                        </div>
                        <h2 class="section-title">Biodata Calon Siswa</h2>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama" class="form-label required">Nama Lengkap</label>
                                <input type="text" id="nama" name="nama" class="form-control" value="{{ old('nama') }}" required>
                                <div class="invalid-feedback">Nama lengkap harus diisi</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="jk" class="form-label required">Jenis Kelamin</label>
                                <select id="jk" name="jk" class="form-select" required>
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="L" {{ old('jk') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="P" {{ old('jk') == 'P' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                <div class="invalid-feedback">Jenis kelamin harus dipilih</div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tmp_lahir" class="form-label required">Tempat Lahir</label>
                                <input type="text" id="tmp_lahir" name="tmp_lahir" class="form-control" value="{{ old('tmp_lahir') }}" required>
                                <div class="invalid-feedback">Tempat lahir harus diisi</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tgl_lahir" class="form-label required">Tanggal Lahir</label>
                                <input type="date" id="tgl_lahir" name="tgl_lahir" class="form-control" value="{{ old('tgl_lahir') }}" required>
                                <div class="invalid-feedback">Tanggal lahir harus diisi</div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nik" class="form-label required">NIK</label>
                                <input type="text" id="nik" name="nik" class="form-control" value="{{ old('nik') }}" required maxlength="16" pattern="[0-9]{16}">
                                <div class="invalid-feedback">NIK harus 16 digit angka</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nisn" class="form-label required">NISN</label>
                                <input type="text" id="nisn" name="nisn" class="form-control" value="{{ old('nisn') }}" required maxlength="10" pattern="[0-9]{10}">
                                <div class="invalid-feedback">NISN harus 10 digit angka</div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Section 2: Data Orang Tua -->
                <div class="form-section" id="section-2">
                    <div class="section-header">
                        <div class="section-icon">
                            <i class="bi bi-people-fill"></i>
                        </div>
                        <h2 class="section-title">Data Orang Tua/Wali</h2>
                    </div>

                    <!-- Data Ayah -->
                    <div class="card">
                        <div class="card-header">
                            <i class="bi bi-gender-male me-2"></i>Data Ayah
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama_ayah" class="form-label required">Nama Ayah</label>
                                        <input type="text" id="nama_ayah" name="nama_ayah" class="form-control" value="{{ old('nama_ayah') }}" required>
                                        <div class="invalid-feedback">Nama ayah harus diisi</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="pekerjaan_ayah" class="form-label required">Pekerjaan Ayah</label>
                                        <select id="pekerjaan_ayah" name="pekerjaan_ayah" class="form-select" required>
                                            <option value="">Pilih Pekerjaan</option>
                                            <option value="PNS" {{ old('pekerjaan_ayah') == 'PNS' ? 'selected' : '' }}>PNS</option>
                                            <option value="TNI/Polri" {{ old('pekerjaan_ayah') == 'TNI/Polri' ? 'selected' : '' }}>TNI/Polri</option>
                                            <option value="Wiraswasta" {{ old('pekerjaan_ayah') == 'Wiraswasta' ? 'selected' : '' }}>Wiraswasta</option>
                                            <option value="Karyawan Swasta" {{ old('pekerjaan_ayah') == 'Karyawan Swasta' ? 'selected' : '' }}>Karyawan Swasta</option>
                                            <option value="Petani" {{ old('pekerjaan_ayah') == 'Petani' ? 'selected' : '' }}>Petani</option>
                                            <option value="Nelayan" {{ old('pekerjaan_ayah') == 'Nelayan' ? 'selected' : '' }}>Nelayan</option>
                                            <option value="Lainnya" {{ old('pekerjaan_ayah') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                        </select>
                                        <div class="invalid-feedback">Pekerjaan ayah harus dipilih</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="hp_ayah" class="form-label required">No. HP Ayah</label>
                                        <input type="tel" id="hp_ayah" name="hp_ayah" class="form-control" value="{{ old('hp_ayah') }}" required pattern="[0-9]{10,13}">
                                        <div class="invalid-feedback">No. HP ayah harus diisi (10-13 digit)</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Data Ibu -->
                    <div class="card">
                        <div class="card-header">
                            <i class="bi bi-gender-female me-2"></i>Data Ibu
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama_ibu" class="form-label required">Nama Ibu</label>
                                        <input type="text" id="nama_ibu" name="nama_ibu" class="form-control" value="{{ old('nama_ibu') }}" required>
                                        <div class="invalid-feedback">Nama ibu harus diisi</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="pekerjaan_ibu" class="form-label required">Pekerjaan Ibu</label>
                                        <select id="pekerjaan_ibu" name="pekerjaan_ibu" class="form-select" required>
                                            <option value="">Pilih Pekerjaan</option>
                                            <option value="Ibu Rumah Tangga" {{ old('pekerjaan_ibu') == 'Ibu Rumah Tangga' ? 'selected' : '' }}>Ibu Rumah Tangga</option>
                                            <option value="PNS" {{ old('pekerjaan_ibu') == 'PNS' ? 'selected' : '' }}>PNS</option>
                                            <option value="Wiraswasta" {{ old('pekerjaan_ibu') == 'Wiraswasta' ? 'selected' : '' }}>Wiraswasta</option>
                                            <option value="Karyawan Swasta" {{ old('pekerjaan_ibu') == 'Karyawan Swasta' ? 'selected' : '' }}>Karyawan Swasta</option>
                                            <option value="Lainnya" {{ old('pekerjaan_ibu') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                        </select>
                                        <div class="invalid-feedback">Pekerjaan ibu harus dipilih</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="hp_ibu" class="form-label required">No. HP Ibu</label>
                                        <input type="tel" id="hp_ibu" name="hp_ibu" class="form-control" value="{{ old('hp_ibu') }}" required pattern="[0-9]{10,13}">
                                        <div class="invalid-feedback">No. HP ibu harus diisi (10-13 digit)</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Data Wali (Opsional) -->
                    <div class="card">
                        <div class="card-header">
                            <i class="bi bi-person-badge me-2"></i>Data Wali (Jika Berbeda)
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="wali_nama" class="form-label">Nama Wali</label>
                                        <input type="text" id="wali_nama" name="wali_nama" class="form-control" value="{{ old('wali_nama') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="wali_hp" class="form-label">No. HP Wali</label>
                                        <input type="tel" id="wali_hp" name="wali_hp" class="form-control" value="{{ old('wali_hp') }}" pattern="[0-9]{10,13}">
                                        <div class="invalid-feedback">No. HP wali harus 10-13 digit angka</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section 3: Pilihan Jurusan & Gelombang -->
                <div class="form-section" id="section-3">
                    <div class="section-header">
                        <div class="section-icon">
                            <i class="bi bi-bookmark-fill"></i>
                        </div>
                        <h2 class="section-title">Pilihan Jurusan & Gelombang</h2>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="gelombang_id" class="form-label required">Gelombang Pendaftaran</label>
                                <select id="gelombang_id" name="gelombang_id" class="form-select" required>
                                    <option value="">Pilih Gelombang</option>
                                    @foreach($gelombang as $g)
                                    <option value="{{ $g->id }}" {{ old('gelombang_id') == $g->id ? 'selected' : '' }}>{{ $g->nama }} - Rp {{ number_format($g->biaya_daftar, 0, ',', '.') }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">Gelombang harus dipilih</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="jurusan_id" class="form-label required">Jurusan yang Dipilih</label>
                                <select id="jurusan_id" name="jurusan_id" class="form-select" required>
                                    <option value="">Pilih Jurusan</option>
                                    @foreach($jurusan as $j)
                                    <option value="{{ $j->id }}" {{ old('jurusan_id') == $j->id ? 'selected' : '' }}>{{ $j->nama }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">Jurusan harus dipilih</div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Section 4: Data Sekolah Asal -->
                <div class="form-section" id="section-4">
                    <div class="section-header">
                        <div class="section-icon">
                            <i class="bi bi-building"></i>
                        </div>
                        <h2 class="section-title">Data Sekolah Asal</h2>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="npsn" class="form-label required">NPSN Sekolah</label>
                                <input type="text" id="npsn" name="npsn" class="form-control" value="{{ old('npsn') }}" required maxlength="8" pattern="[0-9]{8}">
                                <div class="invalid-feedback">NPSN harus 8 digit angka</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama_sekolah" class="form-label required">Nama Sekolah</label>
                                <input type="text" id="nama_sekolah" name="nama_sekolah" class="form-control" value="{{ old('nama_sekolah') }}" required>
                                <div class="invalid-feedback">Nama sekolah harus diisi</div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="kabupaten" class="form-label required">Kabupaten/Kota</label>
                                <input type="text" id="kabupaten" name="kabupaten" class="form-control" value="{{ old('kabupaten') }}" required>
                                <div class="invalid-feedback">Kabupaten/kota harus diisi</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nilai_rata" class="form-label required">Nilai Rata-rata Raport</label>
                                <input type="number" id="nilai_rata" name="nilai_rata" class="form-control" value="{{ old('nilai_rata') }}" required min="0" max="100" step="0.01">
                                <div class="invalid-feedback">Nilai rata-rata harus diisi (0-100)</div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Section 5: Alamat -->
                <div class="form-section" id="section-5">
                    <div class="section-header">
                        <div class="section-icon">
                            <i class="bi bi-geo-alt-fill"></i>
                        </div>
                        <h2 class="section-title">Alamat Tempat Tinggal</h2>
                    </div>
                    
                    <div class="form-group">
                        <label for="alamat" class="form-label required">Alamat Lengkap</label>
                        <textarea id="alamat" name="alamat" class="form-control" rows="3" required>{{ old('alamat') }}</textarea>
                        <div class="invalid-feedback">Alamat lengkap harus diisi</div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="province_id" class="form-label required">Provinsi</label>
                                <select id="province_id" class="form-select" required>
                                    <option value="">Pilih Provinsi</option>
                                </select>
                                <div class="invalid-feedback">Provinsi harus dipilih</div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="regency_id" class="form-label required">Kabupaten/Kota</label>
                                <select id="regency_id" class="form-select" required disabled>
                                    <option value="">Pilih Kabupaten</option>
                                </select>
                                <div class="invalid-feedback">Kabupaten harus dipilih</div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="district_id" class="form-label required">Kecamatan</label>
                                <select id="district_id" class="form-select" required disabled>
                                    <option value="">Pilih Kecamatan</option>
                                </select>
                                <div class="invalid-feedback">Kecamatan harus dipilih</div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="village_id" class="form-label required">Kelurahan/Desa</label>
                                <select id="village_id" name="village_id" class="form-select" required disabled>
                                    <option value="">Pilih Kelurahan</option>
                                </select>
                                <div class="invalid-feedback">Kelurahan harus dipilih</div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="lat" class="form-label">Latitude</label>
                                <input type="text" id="lat" name="lat" class="form-control" value="{{ old('lat') }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="lng" class="form-label">Longitude</label>
                                <input type="text" id="lng" name="lng" class="form-control" value="{{ old('lng') }}" readonly>
                            </div>
                        </div>
                    </div>
                    
                    <div class="alert alert-info">
                        <i class="bi bi-info-circle me-2"></i>
                        <strong>Informasi:</strong> Koordinat lokasi akan membantu kami dalam menentukan jarak tempuh ke sekolah.
                    </div>
                </div>
                
                <!-- Section 6: Konfirmasi -->
                <div class="form-section" id="section-6">
                    <div class="section-header">
                        <div class="section-icon">
                            <i class="bi bi-check-circle-fill"></i>
                        </div>
                        <h2 class="section-title">Konfirmasi Data</h2>
                    </div>
                    
                    <div class="alert alert-success">
                        <i class="bi bi-check-circle-fill me-2"></i>
                        <strong>Data sudah lengkap!</strong> Silakan periksa kembali data Anda sebelum mengirim.
                    </div>
                    
                    <!-- Summary Data -->
                    <div class="card mb-4">
                        <div class="card-header bg-light">
                            <h5 class="card-title mb-0">Ringkasan Data Pendaftaran</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h6>Biodata Calon Siswa</h6>
                                    <table class="table table-borderless table-sm">
                                        <tr><th width="40%">Nama</th><td id="summary-nama">-</td></tr>
                                        <tr><th>Jenis Kelamin</th><td id="summary-jk">-</td></tr>
                                        <tr><th>Tempat Lahir</th><td id="summary-tmp_lahir">-</td></tr>
                                        <tr><th>Tanggal Lahir</th><td id="summary-tgl_lahir">-</td></tr>
                                        <tr><th>NIK</th><td id="summary-nik">-</td></tr>
                                        <tr><th>NISN</th><td id="summary-nisn">-</td></tr>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <h6>Data Orang Tua</h6>
                                    <table class="table table-borderless table-sm">
                                        <tr><th width="40%">Nama Ayah</th><td id="summary-nama_ayah">-</td></tr>
                                        <tr><th>Pekerjaan Ayah</th><td id="summary-pekerjaan_ayah">-</td></tr>
                                        <tr><th>HP Ayah</th><td id="summary-hp_ayah">-</td></tr>
                                        <tr><th>Nama Ibu</th><td id="summary-nama_ibu">-</td></tr>
                                        <tr><th>Pekerjaan Ibu</th><td id="summary-pekerjaan_ibu">-</td></tr>
                                        <tr><th>HP Ibu</th><td id="summary-hp_ibu">-</td></tr>
                                    </table>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <h6>Data Sekolah</h6>
                                    <table class="table table-borderless table-sm">
                                        <tr><th width="40%">NPSN</th><td id="summary-npsn">-</td></tr>
                                        <tr><th>Nama Sekolah</th><td id="summary-nama_sekolah">-</td></tr>
                                        <tr><th>Kabupaten</th><td id="summary-kabupaten">-</td></tr>
                                        <tr><th>Nilai Rata-rata</th><td id="summary-nilai_rata">-</td></tr>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <h6>Alamat</h6>
                                    <table class="table table-borderless table-sm">
                                        <tr><th width="40%">Alamat</th><td id="summary-alamat">-</td></tr>
                                        <tr><th>Wilayah</th><td id="summary-wilayah">-</td></tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="confirm-data" required>
                        <label class="form-check-label" for="confirm-data">
                            Saya menyatakan bahwa data yang diisi adalah benar dan siap bertanggung jawab atas keabsahan data tersebut.
                        </label>
                        <div class="invalid-feedback">Anda harus menyetujui pernyataan ini</div>
                    </div>
                </div>
            </div>
            
            <!-- Form Actions -->
            <div class="form-actions">
                <div class="step-indicator">
                    Langkah <span id="current-step">1</span> dari 5
                </div>
                <div class="navigation-buttons">
                    <button type="button" class="btn btn-outline-secondary" id="prev-btn">
                        <i class="bi bi-arrow-left me-2"></i>Sebelumnya
                    </button>
                    <button type="button" class="btn btn-primary" id="next-btn">
                        Selanjutnya<i class="bi bi-arrow-right ms-2"></i>
                    </button>
                    <button type="submit" class="btn btn-success" id="submit-btn" style="display: none;">
                        <i class="bi bi-send-check me-2"></i>Kirim Formulir
                    </button>
                </div>
            </div>
        </form>
    </div>

    <script>
        class FormWizard {
            constructor() {
                this.currentStep = 1;
                this.totalSteps = 6;
                this.init();
            }
            
            init() {
                this.bindEvents();
                this.updateUI();
                this.setupWilayahCoordinates();
            }
            
            bindEvents() {
                document.getElementById('prev-btn').addEventListener('click', () => this.previous());
                document.getElementById('next-btn').addEventListener('click', () => this.next());
                
                // Step indicator clicks
                document.querySelectorAll('.step').forEach(step => {
                    step.addEventListener('click', (e) => {
                        const stepNumber = parseInt(e.currentTarget.dataset.step);
                        if (stepNumber < this.currentStep) {
                            this.goToStep(stepNumber);
                        }
                    });
                });
            }
            
            async setupWilayahCoordinates() {
                // Load provinces
                const provinces = await fetch('/api/provinces').then(r => r.json());
                const provinceSelect = document.getElementById('province_id');
                provinces.forEach(p => {
                    provinceSelect.innerHTML += `<option value="${p.id}">${p.name}</option>`;
                });

                // Province change
                provinceSelect.addEventListener('change', async function() {
                    const regencySelect = document.getElementById('regency_id');
                    const districtSelect = document.getElementById('district_id');
                    const villageSelect = document.getElementById('village_id');
                    
                    regencySelect.innerHTML = '<option value="">Pilih Kabupaten</option>';
                    districtSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
                    villageSelect.innerHTML = '<option value="">Pilih Kelurahan</option>';
                    
                    if (this.value) {
                        const regencies = await fetch(`/api/regencies/${this.value}`).then(r => r.json());
                        regencies.forEach(r => {
                            regencySelect.innerHTML += `<option value="${r.id}">${r.name}</option>`;
                        });
                        regencySelect.disabled = false;
                    } else {
                        regencySelect.disabled = true;
                        districtSelect.disabled = true;
                        villageSelect.disabled = true;
                    }
                });

                // Regency change
                document.getElementById('regency_id').addEventListener('change', async function() {
                    const districtSelect = document.getElementById('district_id');
                    const villageSelect = document.getElementById('village_id');
                    
                    districtSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
                    villageSelect.innerHTML = '<option value="">Pilih Kelurahan</option>';
                    
                    if (this.value) {
                        const districts = await fetch(`/api/districts/${this.value}`).then(r => r.json());
                        districts.forEach(d => {
                            districtSelect.innerHTML += `<option value="${d.id}">${d.name}</option>`;
                        });
                        districtSelect.disabled = false;
                    } else {
                        districtSelect.disabled = true;
                        villageSelect.disabled = true;
                    }
                });

                // District change
                document.getElementById('district_id').addEventListener('change', async function() {
                    const villageSelect = document.getElementById('village_id');
                    villageSelect.innerHTML = '<option value="">Pilih Kelurahan</option>';
                    
                    if (this.value) {
                        const villages = await fetch(`/api/villages/${this.value}`).then(r => r.json());
                        villages.forEach(v => {
                            villageSelect.innerHTML += `<option value="${v.id}">${v.name}</option>`;
                        });
                        villageSelect.disabled = false;
                    } else {
                        villageSelect.disabled = true;
                    }
                });
            }
            
            next() {
                if (this.validateCurrentStep()) {
                    if (this.currentStep < this.totalSteps) {
                        this.currentStep++;
                        this.updateUI();
                        
                        // Update summary pada step konfirmasi
                        if (this.currentStep === 6) {
                            this.updateSummary();
                        }
                    }
                }
            }
            
            previous() {
                if (this.currentStep > 1) {
                    this.currentStep--;
                    this.updateUI();
                }
            }
            
            goToStep(step) {
                this.currentStep = step;
                this.updateUI();
            }
            
            validateCurrentStep() {
                const currentSection = document.getElementById(`section-${this.currentStep}`);
                const requiredFields = currentSection.querySelectorAll('[required]');
                let isValid = true;
                
                requiredFields.forEach(field => {
                    if (field.type === 'checkbox') {
                        if (!field.checked) {
                            field.classList.add('is-invalid');
                            isValid = false;
                        } else {
                            field.classList.remove('is-invalid');
                        }
                    } else if (!field.value || !field.value.trim()) {
                        field.classList.add('is-invalid');
                        isValid = false;
                    } else {
                        field.classList.remove('is-invalid');
                    }
                    
                    // Validasi format
                    if (field.id === 'nik' && field.value && !/^\d{16}$/.test(field.value)) {
                        field.classList.add('is-invalid');
                        isValid = false;
                    }
                    
                    if (field.id === 'nisn' && field.value && !/^\d{10}$/.test(field.value)) {
                        field.classList.add('is-invalid');
                        isValid = false;
                    }
                    
                    if (field.id === 'npsn' && field.value && !/^\d{8}$/.test(field.value)) {
                        field.classList.add('is-invalid');
                        isValid = false;
                    }
                    
                    if ((field.id === 'hp_ayah' || field.id === 'hp_ibu' || field.id === 'wali_hp') && 
                        field.value && !/^\d{10,13}$/.test(field.value)) {
                        field.classList.add('is-invalid');
                        isValid = false;
                    }
                    
                    if (field.id === 'village_id' && (!field.value || field.value === '')) {
                        field.classList.add('is-invalid');
                        isValid = false;
                    }
                });
                
                if (!isValid) {
                    alert('Harap lengkapi semua field yang wajib diisi dengan benar!');
                }
                
                return isValid;
            }
            
            updateSummary() {
                // Update semua data summary
                const fields = [
                    'nama', 'jk', 'tmp_lahir', 'tgl_lahir', 'nik', 'nisn',
                    'nama_ayah', 'pekerjaan_ayah', 'hp_ayah', 
                    'nama_ibu', 'pekerjaan_ibu', 'hp_ibu',
                    'npsn', 'nama_sekolah', 'kabupaten', 'nilai_rata',
                    'alamat'
                ];
                
                const provinceText = document.getElementById('province_id').options[document.getElementById('province_id').selectedIndex]?.text || '-';
                const regencyText = document.getElementById('regency_id').options[document.getElementById('regency_id').selectedIndex]?.text || '-';
                const districtText = document.getElementById('district_id').options[document.getElementById('district_id').selectedIndex]?.text || '-';
                const villageText = document.getElementById('village_id').options[document.getElementById('village_id').selectedIndex]?.text || '-';
                document.getElementById('summary-wilayah').textContent = `${villageText}, ${districtText}, ${regencyText}, ${provinceText}`;
                
                fields.forEach(field => {
                    const element = document.getElementById(field);
                    if (element) {
                        let value = element.value;
                        if (element.tagName === 'SELECT') {
                            value = element.options[element.selectedIndex].text;
                        }
                        document.getElementById(`summary-${field}`).textContent = value || '-';
                    }
                });
            }
            
            updateUI() {
                // Update sections
                document.querySelectorAll('.form-section').forEach(section => {
                    section.classList.remove('active');
                });
                document.getElementById(`section-${this.currentStep}`).classList.add('active');
                
                // Update steps
                document.querySelectorAll('.step').forEach(step => {
                    const stepNumber = parseInt(step.dataset.step);
                    step.classList.remove('active', 'completed');
                    
                    if (stepNumber === this.currentStep) {
                        step.classList.add('active');
                    } else if (stepNumber < this.currentStep) {
                        step.classList.add('completed');
                    }
                });
                
                // Update buttons
                document.getElementById('prev-btn').style.display = this.currentStep === 1 ? 'none' : 'block';
                document.getElementById('next-btn').style.display = this.currentStep === this.totalSteps ? 'none' : 'block';
                document.getElementById('submit-btn').style.display = this.currentStep === this.totalSteps ? 'block' : 'none';
                
                // Update step indicator
                document.getElementById('current-step').textContent = this.currentStep;
            }
        }
        
        // Initialize form wizard
        document.addEventListener('DOMContentLoaded', () => {
            new FormWizard();
        });
    </script>
</body>
</html>