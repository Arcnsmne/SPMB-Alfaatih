<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Pendaftaran - SPMB 666</title>
    
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/pages/auth.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    
    <style>
        .form-container {
            background: white;
            border-radius: 1rem;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
            overflow: hidden;
        }
        
        .form-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 2rem;
            text-align: center;
        }
        
        .step-indicator {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 2rem 0;
        }
        
        .step {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #e9ecef;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 0.5rem;
            font-weight: 600;
            position: relative;
        }
        
        .step.active {
            background: #435ebe;
            color: white;
        }
        
        .step.completed {
            background: #198754;
            color: white;
        }
        
        .step:not(:last-child)::after {
            content: '';
            position: absolute;
            left: 100%;
            top: 50%;
            width: 1rem;
            height: 2px;
            background: #e9ecef;
            transform: translateY(-50%);
        }
        
        .step.completed:not(:last-child)::after {
            background: #198754;
        }
        
        .form-section {
            display: none;
            padding: 2rem;
        }
        
        .form-section.active {
            display: block;
        }
        
        .section-title {
            color: #25396f;
            margin-bottom: 1.5rem;
            font-weight: 600;
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-label {
            font-weight: 600;
            color: #25396f;
            margin-bottom: 0.5rem;
        }
        
        .required::after {
            content: ' *';
            color: #dc3545;
        }
        
        .form-control, .form-select {
            border-radius: 0.5rem;
            border: 1px solid #dce7f1;
            padding: 0.75rem;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: #435ebe;
            box-shadow: 0 0 0 0.2rem rgba(67, 94, 190, 0.25);
        }
        
        .btn {
            border-radius: 0.5rem;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
        }
        
        .btn-primary {
            background: #435ebe;
            border-color: #435ebe;
        }
        
        .btn-success {
            background: #198754;
            border-color: #198754;
        }
        
        .card {
            border: 1px solid #dce7f1;
            border-radius: 0.75rem;
            margin-bottom: 1.5rem;
        }
        
        .card-header {
            background: #f8f9fa;
            border-bottom: 1px solid #dce7f1;
            font-weight: 600;
            color: #25396f;
        }
        
        #map {
            height: 300px;
            border-radius: 0.5rem;
            border: 1px solid #dce7f1;
        }
        
        .alert {
            border-radius: 0.5rem;
        }
        
        .navigation-buttons {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.5rem 2rem;
            background: #f8f9fa;
            border-top: 1px solid #dce7f1;
        }
        
        .draft-badge {
            background: #ffc107;
            color: #000;
            padding: 0.25rem 0.75rem;
            border-radius: 1rem;
            font-size: 0.875rem;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div id="auth">
        <div class="row h-100">
            <div class="col-12">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xl-10 col-lg-12">
                            <div class="form-container">
                                <!-- Header -->
                                <div class="form-header">
                                    <div class="d-flex align-items-center justify-content-center mb-3">
                                        <img src="{{ asset('assets/images/logo/logo.png') }}" alt="Logo" height="60" class="me-3">
                                        <div>
                                            <h2 class="mb-0">SPMB 666</h2>
                                            <p class="mb-0">Formulir Pendaftaran</p>
                                        </div>
                                    </div>
                                    @if($draft)
                                        <span class="draft-badge">
                                            <i class="bi bi-pencil-square me-1"></i>Mode Edit Draft
                                        </span>
                                    @endif
                                </div>

                                <!-- Step Indicator -->
                                <div class="step-indicator">
                                    <div class="step active" data-step="1">1</div>
                                    <div class="step" data-step="2">2</div>
                                    <div class="step" data-step="3">3</div>
                                    <div class="step" data-step="4">4</div>
                                    <div class="step" data-step="5">5</div>
                                </div>

                                <!-- Form -->
                                <form id="pendaftaran-form" method="POST" action="{{ $draft ? route('calon_siswa.formulir.update', $draft->id) : route('calon_siswa.formulir.store') }}">
                                    @csrf
                                    @if($draft)
                                        @method('PUT')
                                    @endif

                                    <!-- Step 1: Data Siswa -->
                                    <div class="form-section active" id="step-1">
                                        <h4 class="section-title">
                                            <i class="bi bi-person-fill me-2"></i>Data Calon Siswa
                                        </h4>
                                        
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label required">Nama Lengkap</label>
                                                    <input type="text" name="nama" class="form-control" value="{{ old('nama', $draft->nama ?? '') }}" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label required">Jenis Kelamin</label>
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
                                                    <label class="form-label required">Tempat Lahir</label>
                                                    <input type="text" name="tmp_lahir" class="form-control" value="{{ old('tmp_lahir', $draft->tmp_lahir ?? '') }}" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label required">Tanggal Lahir</label>
                                                    <input type="date" name="tgl_lahir" class="form-control" value="{{ old('tgl_lahir', $draft->tgl_lahir ?? '') }}" required>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label required">NIK</label>
                                                    <input type="text" name="nik" class="form-control" value="{{ old('nik', $draft->nik ?? '') }}" maxlength="16" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label required">NISN</label>
                                                    <input type="text" name="nisn" class="form-control" value="{{ old('nisn', $draft->nisn ?? '') }}" maxlength="10" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Step 2: Data Orang Tua -->
                                    <div class="form-section" id="step-2">
                                        <h4 class="section-title">
                                            <i class="bi bi-people-fill me-2"></i>Data Orang Tua
                                        </h4>
                                        
                                        <div class="card">
                                            <div class="card-header">
                                                <i class="bi bi-gender-male me-2"></i>Data Ayah
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label required">Nama Ayah</label>
                                                            <input type="text" name="nama_ayah" class="form-control" value="{{ old('nama_ayah', $draft->nama_ayah ?? '') }}" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label required">Pekerjaan Ayah</label>
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
                                                    <label class="form-label required">No. HP Ayah</label>
                                                    <input type="tel" name="hp_ayah" class="form-control" value="{{ old('hp_ayah', $draft->hp_ayah ?? '') }}" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card">
                                            <div class="card-header">
                                                <i class="bi bi-gender-female me-2"></i>Data Ibu
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label required">Nama Ibu</label>
                                                            <input type="text" name="nama_ibu" class="form-control" value="{{ old('nama_ibu', $draft->nama_ibu ?? '') }}" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label required">Pekerjaan Ibu</label>
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
                                                    <label class="form-label required">No. HP Ibu</label>
                                                    <input type="tel" name="hp_ibu" class="form-control" value="{{ old('hp_ibu', $draft->hp_ibu ?? '') }}" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card">
                                            <div class="card-header">
                                                <i class="bi bi-person-badge me-2"></i>Data Wali (Opsional)
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
                                    <div class="form-section" id="step-3">
                                        <h4 class="section-title">
                                            <i class="bi bi-building me-2"></i>Data Sekolah Asal
                                        </h4>
                                        
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label required">NPSN Sekolah</label>
                                                    <input type="text" name="npsn" class="form-control" value="{{ old('npsn', $draft->npsn ?? '') }}" maxlength="8" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label required">Nama Sekolah</label>
                                                    <input type="text" name="nama_sekolah" class="form-control" value="{{ old('nama_sekolah', $draft->nama_sekolah ?? '') }}" required>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label required">Kabupaten/Kota</label>
                                                    <input type="text" name="kabupaten" class="form-control" value="{{ old('kabupaten', $draft->kabupaten ?? '') }}" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label required">Nilai Rata-rata</label>
                                                    <input type="number" name="nilai_rata" class="form-control" value="{{ old('nilai_rata', $draft->nilai_rata ?? '') }}" min="0" max="100" step="0.01" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Step 4: Alamat & Koordinat -->
                                    <div class="form-section" id="step-4">
                                        <h4 class="section-title">
                                            <i class="bi bi-geo-alt-fill me-2"></i>Alamat & Lokasi
                                        </h4>
                                        
                                        <div class="form-group">
                                            <label class="form-label required">Alamat Lengkap</label>
                                            <textarea name="alamat" class="form-control" rows="3" required>{{ old('alamat', $draft->alamat ?? '') }}</textarea>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="form-label required">Provinsi</label>
                                                    <select id="province_id" class="form-select" required>
                                                        <option value="">Pilih Provinsi</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="form-label required">Kabupaten/Kota</label>
                                                    <select id="regency_id" class="form-select" required disabled>
                                                        <option value="">Pilih Kabupaten</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="form-label required">Kecamatan</label>
                                                    <select id="district_id" class="form-select" required disabled>
                                                        <option value="">Pilih Kecamatan</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="form-label required">Kelurahan/Desa</label>
                                                    <select name="village_id" id="village_id" class="form-select" required disabled>
                                                        <option value="">Pilih Kelurahan</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="form-label">Pilih Lokasi di Peta</label>
                                            <div id="map"></div>
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
                                    <div class="form-section" id="step-5">
                                        <h4 class="section-title">
                                            <i class="bi bi-bookmark-fill me-2"></i>Pilihan Jurusan & Gelombang
                                        </h4>
                                        
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label required">Gelombang Pendaftaran</label>
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
                                                    <label class="form-label required">Jurusan yang Dipilih</label>
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
                                            <strong>Informasi:</strong> Pastikan data yang Anda masukkan sudah benar. Data akan disimpan sebagai draft dan dapat diedit kembali sebelum submit final.
                                        </div>
                                    </div>

                                    <!-- Navigation -->
                                    <div class="navigation-buttons">
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
        </div>
    </div>

    <script src="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    
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
                alert('Harap lengkapi semua field yang wajib diisi!');
            }

            return isValid;
        }

        function updateStepDisplay() {
            // Hide all sections
            document.querySelectorAll('.form-section').forEach(section => {
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
</body>
</html>