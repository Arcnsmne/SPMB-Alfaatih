<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>SPMB - SMK BAKTI NUSANTARA 666</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="SMK Bakti Nusantara 666, PPDB, Sekolah Kejuruan Bandung" name="keywords">
    <meta content="Sistem Penerimaan Murid Baru SMK Bakti Nusantara 666 - Sekolah Kejuruan Terbaik di Bandung" name="description">

    <!-- Favicon -->
    <link href="assetlanding/img/logobn.jpg" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500;600;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet"> 

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
        :root {
            --primary-color: #0d6efd;
            --secondary-color: #6c757d;
            --dark-color: #212529;
            --light-color: #f8f9fa;
        }
        
        body {
            padding-top: 70px;
            font-family: 'Open Sans', sans-serif;
            scroll-behavior: smooth;
        }
        
        /* Navbar Styles - Compact Version */
        .navbar {
            background: rgba(255, 255, 255, 0.98) !important;
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            padding: 8px 0;
            min-height: 60px;
        }
        
        .navbar-brand {
            display: flex;
            align-items: center;
            font-weight: 700;
            color: var(--primary-color) !important;
            font-family: 'Jost', sans-serif;
            font-size: 1.1rem;
            padding: 0;
        }
        
        .navbar-brand img {
            height: 35px;
            width: auto;
            margin-right: 8px;
        }
        
        .nav-link {
            font-weight: 500;
            color: var(--dark-color) !important;
            margin: 0 4px;
            padding: 6px 12px !important;
            border-radius: 4px;
            transition: all 0.2s ease;
            font-size: 0.9rem;
        }
        
        .nav-link:hover {
            color: var(--primary-color) !important;
            background-color: rgba(13, 110, 253, 0.05);
        }
        
        .nav-link.active {
            color: var(--primary-color) !important;
            background-color: rgba(13, 110, 253, 0.1);
        }
        
        .btn-cta {
            background: var(--primary-color);
            border: none;
            border-radius: 6px;
            padding: 6px 16px;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }
        
        .btn-cta:hover {
            background: #0b5ed7;
            transform: translateY(-1px);
        }
        
        .navbar-toggler {
            border: none;
            padding: 4px 6px;
            font-size: 0.9rem;
        }
        
        .navbar-toggler:focus {
            box-shadow: none;
        }

        /* Section styles */
        .section-title h6 {
            position: relative;
            font-weight: 600;
        }
        
        .section-title h6::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 2px;
            background: #0d6efd;
        }
        
        .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('assetlanding/img/header.jpg');
            background-size: cover;
            background-position: center;
            padding: 120px 0 80px;
            color: white;
        }
        
        .counter-box {
            transition: transform 0.3s;
        }
        
        .counter-box:hover {
            transform: translateY(-5px);
        }
        
        /* Jurusan Carousel Styles */
        .jurusan-carousel {
            padding: 20px 0;
        }
        
        .jurusan-card {
            transition: transform 0.3s;
            height: 100%;
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .jurusan-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }
        
        .jurusan-icon {
            width: 80px;
            height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 20px;
            margin: 0 auto 20px;
        }
        
        .carousel-control-prev,
        .carousel-control-next {
            width: 50px;
            height: 50px;
            background: var(--primary-color);
            border-radius: 50%;
            top: 50%;
            transform: translateY(-50%);
            opacity: 0.8;
        }
        
        .carousel-control-prev {
            left: -25px;
        }
        
        .carousel-control-next {
            right: -25px;
        }
        
        .carousel-control-prev:hover,
        .carousel-control-next:hover {
            opacity: 1;
        }
        
        .carousel-indicators {
            bottom: -50px;
        }
        
        .carousel-indicators button {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            margin: 0 5px;
        }
        
        .prestasi-item {
            transition: transform 0.3s;
        }
        
        .prestasi-item:hover {
            transform: scale(1.05);
        }
        
        .fasilitas-img {
            height: 200px;
            object-fit: cover;
        }
        
        .step-card {
            border-left: 4px solid #0d6efd;
            padding-left: 15px;
            margin-bottom: 25px;
        }

        .step-number {
            width: 40px;
            height: 40px;
            background: #0d6efd;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            margin-right: 15px;
            flex-shrink: 0;
        }

        .fasilitas-card {
            transition: transform 0.3s;
            height: 100%;
        }

        .fasilitas-card:hover {
            transform: translateY(-5px);
        }

        .fasilitas-icon {
            width: 70px;
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 15px;
            margin-bottom: 20px;
        }

        /* Responsive adjustments for carousel */
        @media (max-width: 768px) {
            .carousel-control-prev {
                left: 10px;
            }
            
            .carousel-control-next {
                right: 10px;
            }
            
            .jurusan-card {
                margin: 0 10px;
            }
        }
    </style>
</head>

<body>
    <!-- Navbar Start - Compact Version -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#home">
                <img src="assetlanding/img/logobn.jpg" alt="Logo SMK Bakti Nusantara 666">
                <span>SMK BAKTI NUSANTARA 666</span>
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                <i class="fas fa-bars"></i>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#profil-ppdb">PPDB</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#profil-sekolah">Profil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#jurusan">Jurusan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#prestasi">Prestasi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#fasilitas">Fasilitas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#pendaftaran">Daftar</a>
                    </li>
                </ul>
                
                <div class="d-flex align-items-center">
                    <a href="/login" class="btn btn-cta text-white">
                        <i class="fas fa-user-plus me-1"></i> Daftar
                    </a>
                </div>
            </div>
        </div>
    </nav>
    <!-- Navbar End -->

    <!-- Hero Section -->
    <section id="home" class="hero-section">
        <div class="container text-center">
            <h1 class="display-4 fw-bold mb-4">SISTEM PENERIMAAN MURID BARU</h1>
            <h2 class="display-5 mb-4">SMK BAKTI NUSANTARA 666</h2>
            <p class="lead mb-5">Membangun SAJUTA (Santun, Jujur, Taat)</p>
            <a href="#pendaftaran" class="btn btn-primary btn-lg px-4 py-2">Daftar Sekarang</a>
        </div>
    </section>

    <!-- Profil PPDB Section -->
    <section id="profil-ppdb" class="py-5 bg-light">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <div class="section-title mb-4">
                        <h6 class="text-primary text-uppercase">Profil PPDB</h6>
                        <h2 class="display-5 fw-bold">Penerimaan Peserta Didik Baru</h2>
                    </div>
                    <p class="mb-4">SMK Bakti Nusantara 666 membuka pendaftaran bagi calon peserta didik baru tahun ajaran 2023/2024. Kami menyediakan berbagai program keahlian yang relevan dengan kebutuhan industri masa kini.</p>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center">
                                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                    <i class="fas fa-calendar-alt"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0">Periode Pendaftaran</h6>
                                    <p class="mb-0 small">1 Jan - 30 Jun 2023</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center">
                                <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                    <i class="fas fa-user-graduate"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0">Kuota Penerimaan</h6>
                                    <p class="mb-0 small">320 Siswa</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center">
                                <div class="bg-warning text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                    <i class="fas fa-school"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0">Program Keahlian</h6>
                                    <p class="mb-0 small">5 Jurusan</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center">
                                <div class="bg-info text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                    <i class="fas fa-award"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0">Akreditasi</h6>
                                    <p class="mb-0 small">A (Unggul)</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <img src="assetlanding/img/ppdb.jpg" alt="PPDB SMK Bakti Nusantara 666" class="img-fluid rounded shadow">
                </div>
            </div>
        </div>
    </section>

    <!-- Profil Sekolah Section -->
    <section id="profil-sekolah" class="py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 mb-5 mb-lg-0">
                    <img src="assetlanding/img/about.jpg" alt="Profil SMK Bakti Nusantara 666" class="img-fluid rounded shadow">
                </div>
                <div class="col-lg-7">
                    <div class="section-title mb-4">
                        <h6 class="text-primary text-uppercase">Profil Sekolah</h6>
                        <h2 class="display-5 fw-bold">SMK Bakti Nusantara 666</h2>
                    </div>
                    <p class="mb-4">SMK Bakti Nusantara 666 adalah salah satu sekolah kejuruan swasta terbaik di Kabupaten Bandung dengan akreditasi A. Berdiri sejak tahun 2009, sekolah ini berlokasi di Jl. Percobaan Km. 17 No. 65, Desa Cimekar, Kec. Cileunyi, Kab. Bandung – Jawa Barat.</p>
                    <p class="mb-4">Dengan NPSN: 20267919 dan status Swasta di bawah Yayasan Bakti Nusantara 666, sekolah ini fokus dalam mencetak lulusan yang kompeten, berkarakter, dan siap kerja di dunia industri modern dengan bidang unggulan di Teknologi, Kreatif, dan Bisnis.</p>
                    
                    <div class="row text-center mt-4">
                        <div class="col-md-3 mb-3">
                            <div class="counter-box bg-primary text-white p-3 rounded">
                                <h4 class="fw-bold mb-1" data-count="123">0</h4>
                                <p class="mb-0 small">Guru & Staff</p>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="counter-box bg-success text-white p-3 rounded">
                                <h4 class="fw-bold mb-1" data-count="1234">0</h4>
                                <p class="mb-0 small">Siswa Aktif</p>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="counter-box bg-warning text-white p-3 rounded">
                                <h4 class="fw-bold mb-1" data-count="5">0</h4>
                                <p class="mb-0 small">Program Jurusan</p>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="counter-box bg-info text-white p-3 rounded">
                                <h4 class="fw-bold mb-1" data-count="15">0</h4>
                                <p class="mb-0 small">Tahun Berdiri</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Jurusan Section dengan Carousel -->
    <section id="jurusan" class="py-5 bg-light">
        <div class="container">
            <div class="section-title text-center mb-5">
                <h6 class="text-primary text-uppercase">Program Keahlian</h6>
                <h2 class="display-5 fw-bold">5 Jurusan Unggulan</h2>
                <p class="lead">Pilih jurusan sesuai minat dan bakat Anda untuk masa depan yang cerah</p>
            </div>
            
            <div class="jurusan-carousel">
                <div id="jurusanCarousel" class="carousel slide" data-bs-ride="carousel">
                    <!-- Indicators -->
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#jurusanCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#jurusanCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#jurusanCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>
                    
                    <!-- Carousel Items -->
                    <div class="carousel-inner">
                        <!-- Slide 1 - PPLG & DKV -->
                        <div class="carousel-item active">
                            <div class="row justify-content-center">
                                <div class="col-lg-5 col-md-6 mb-4">
                                    <div class="card jurusan-card h-100">
                                        <div class="card-body text-center p-4">
                                            <div class="jurusan-icon bg-primary text-white">
                                                <i class="fas fa-code fa-2x"></i>
                                            </div>
                                            <h4 class="card-title">PPLG</h4>
                                            <h6 class="card-subtitle mb-3 text-primary">Pengembangan Perangkat Lunak dan Gim</h6>
                                            <p class="card-text">Mempelajari pengembangan aplikasi, software, dan game dengan teknologi terkini untuk memenuhi kebutuhan industri digital.</p>
                                            <ul class="list-unstyled text-start">
                                                <li><i class="fas fa-check text-success me-2"></i> Pemrograman Web & Mobile</li>
                                                <li><i class="fas fa-check text-success me-2"></i> Pengembangan Game</li>
                                                <li><i class="fas fa-check text-success me-2"></i> Database Management</li>
                                                <li><i class="fas fa-check text-success me-2"></i> UI/UX Design</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-lg-5 col-md-6 mb-4">
                                    <div class="card jurusan-card h-100">
                                        <div class="card-body text-center p-4">
                                            <div class="jurusan-icon bg-success text-white">
                                                <i class="fas fa-palette fa-2x"></i>
                                            </div>
                                            <h4 class="card-title">DKV</h4>
                                            <h6 class="card-subtitle mb-3 text-success">Desain Komunikasi Visual</h6>
                                            <p class="card-text">Mengembangkan kreativitas dalam desain grafis, ilustrasi, fotografi, dan multimedia untuk kebutuhan komunikasi visual.</p>
                                            <ul class="list-unstyled text-start">
                                                <li><i class="fas fa-check text-success me-2"></i> Desain Grafis & Ilustrasi</li>
                                                <li><i class="fas fa-check text-success me-2"></i> Fotografi Digital</li>
                                                <li><i class="fas fa-check text-success me-2"></i> Animasi 2D & 3D</li>
                                                <li><i class="fas fa-check text-success me-2"></i> Branding & Packaging</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Slide 2 - AKT & ANM -->
                        <div class="carousel-item">
                            <div class="row justify-content-center">
                                <div class="col-lg-5 col-md-6 mb-4">
                                    <div class="card jurusan-card h-100">
                                        <div class="card-body text-center p-4">
                                            <div class="jurusan-icon bg-warning text-white">
                                                <i class="fas fa-calculator fa-2x"></i>
                                            </div>
                                            <h4 class="card-title">AKT</h4>
                                            <h6 class="card-subtitle mb-3 text-warning">Akuntansi</h6>
                                            <p class="card-text">Mempelajari pengelolaan keuangan, pembukuan, perpajakan, dan sistem akuntansi untuk berbagai jenis bisnis dan lembaga.</p>
                                            <ul class="list-unstyled text-start">
                                                <li><i class="fas fa-check text-success me-2"></i> Akuntansi Dasar & Lanjutan</li>
                                                <li><i class="fas fa-check text-success me-2"></i> Perpajakan</li>
                                                <li><i class="fas fa-check text-success me-2"></i> Software Akuntansi</li>
                                                <li><i class="fas fa-check text-success me-2"></i> Laporan Keuangan</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-lg-5 col-md-6 mb-4">
                                    <div class="card jurusan-card h-100">
                                        <div class="card-body text-center p-4">
                                            <div class="jurusan-icon bg-info text-white">
                                                <i class="fas fa-film fa-2x"></i>
                                            </div>
                                            <h4 class="card-title">ANM</h4>
                                            <h6 class="card-subtitle mb-3 text-info">Animasi</h6>
                                            <p class="card-text">Menguasai teknik pembuatan animasi 2D dan 3D, storyboarding, character design, dan produksi konten animasi kreatif.</p>
                                            <ul class="list-unstyled text-start">
                                                <li><i class="fas fa-check text-success me-2"></i> Animasi 2D & 3D</li>
                                                <li><i class="fas fa-check text-success me-2"></i> Character Design</li>
                                                <li><i class="fas fa-check text-success me-2"></i> Storyboarding</li>
                                                <li><i class="fas fa-check text-success me-2"></i> Visual Effects</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Slide 3 - BDP -->
                        <div class="carousel-item">
                            <div class="row justify-content-center">
                                <div class="col-lg-5 col-md-6 mb-4">
                                    <div class="card jurusan-card h-100">
                                        <div class="card-body text-center p-4">
                                            <div class="jurusan-icon bg-danger text-white">
                                                <i class="fas fa-chart-line fa-2x"></i>
                                            </div>
                                            <h4 class="card-title">BDP</h4>
                                            <h6 class="card-subtitle mb-3 text-danger">Bisnis Daring dan Pemasaran</h6>
                                            <p class="card-text">Mempelajari strategi pemasaran digital, e-commerce, manajemen penjualan, dan pengelolaan bisnis online.</p>
                                            <ul class="list-unstyled text-start">
                                                <li><i class="fas fa-check text-success me-2"></i> Digital Marketing</li>
                                                <li><i class="fas fa-check text-success me-2"></i> E-Commerce</li>
                                                <li><i class="fas fa-check text-success me-2"></i> Manajemen Penjualan</li>
                                                <li><i class="fas fa-check text-success me-2"></i> Marketplace Management</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-lg-5 col-md-6 mb-4">
                                    <!-- Empty space for balance -->
                                    <div class="d-flex align-items-center justify-content-center h-100">
                                        <div class="text-center">
                                            <i class="fas fa-graduation-cap fa-3x text-muted mb-3"></i>
                                            <h5 class="text-muted">Pilih Jurusan Terbaik</h5>
                                            <p class="text-muted">Untuk masa depan yang cerah</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Controls -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#jurusanCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#jurusanCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Prestasi Section -->
    <section id="prestasi" class="py-5">
        <div class="container">
            <div class="section-title text-center mb-5">
                <h6 class="text-primary text-uppercase">Prestasi</h6>
                <h2 class="display-5 fw-bold">Penghargaan dan Prestasi</h2>
                <p class="lead">Bukti nyata kualitas pendidikan di SMK Bakti Nusantara 666</p>
            </div>
            
            <div class="row">
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="prestasi-item text-center p-3 bg-light rounded">
                        <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                            <i class="fas fa-trophy fa-lg"></i>
                        </div>
                        <h6>Juara 1 Web Design</h6>
                        <p class="mb-0 small">Provinsi Jabar 2022</p>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="prestasi-item text-center p-3 bg-light rounded">
                        <div class="bg-success text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                            <i class="fas fa-medal fa-lg"></i>
                        </div>
                        <h6>Juara 2 LKS TKJ</h6>
                        <p class="mb-0 small">Kab. Bandung 2023</p>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="prestasi-item text-center p-3 bg-light rounded">
                        <div class="bg-warning text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                            <i class="fas fa-award fa-lg"></i>
                        </div>
                        <h6>Sekolah Adiwiyata</h6>
                        <p class="mb-0 small">Tingkat Kabupaten 2021</p>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="prestasi-item text-center p-3 bg-light rounded">
                        <div class="bg-info text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                            <i class="fas fa-star fa-lg"></i>
                        </div>
                        <h6>Akreditasi A</h6>
                        <p class="mb-0 small">BAN SM 2022</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Fasilitas Section -->
    <section id="fasilitas" class="py-5 bg-light">
        <div class="container">
            <div class="section-title text-center mb-5">
                <h6 class="text-primary text-uppercase">Fasilitas</h6>
                <h2 class="display-5 fw-bold">Fasilitas Penunjang Pembelajaran</h2>
                <p class="lead">Dukungan fasilitas lengkap untuk proses belajar mengajar yang optimal</p>
            </div>
            
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card fasilitas-card border-0 shadow-sm h-100">
                        <div class="card-body text-center p-4">
                            <div class="fasilitas-icon bg-primary text-white mx-auto">
                                <i class="fas fa-laptop-code fa-2x"></i>
                            </div>
                            <h5 class="card-title">Lab Komputer Modern</h5>
                            <p class="card-text">Laboratorium komputer dengan spesifikasi tinggi untuk mendukung praktik pemrograman, desain, dan multimedia.</p>
                            <ul class="list-unstyled text-start">
                                <li><i class="fas fa-check text-success me-2"></i> PC Core i7 & SSD</li>
                                <li><i class="fas fa-check text-success me-2"></i> Software Terlengkap</li>
                                <li><i class="fas fa-check text-success me-2"></i> Internet High Speed</li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card fasilitas-card border-0 shadow-sm h-100">
                        <div class="card-body text-center p-4">
                            <div class="fasilitas-icon bg-success text-white mx-auto">
                                <i class="fas fa-book fa-2x"></i>
                            </div>
                            <h5 class="card-title">Perpustakaan Digital</h5>
                            <p class="card-text">Koleksi buku lengkap dengan akses digital dan ruang baca yang nyaman untuk mendukung penelitian dan pembelajaran.</p>
                            <ul class="list-unstyled text-start">
                                <li><i class="fas fa-check text-success me-2"></i> Koleksi Buku Terupdate</li>
                                <li><i class="fas fa-check text-success me-2"></i> Akses E-Library</li>
                                <li><i class="fas fa-check text-success me-2"></i> Ruang Baca Nyaman</li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card fasilitas-card border-0 shadow-sm h-100">
                        <div class="card-body text-center p-4">
                            <div class="fasilitas-icon bg-warning text-white mx-auto">
                                <i class="fas fa-language fa-2x"></i>
                            </div>
                            <h5 class="card-title">Lab Bahasa</h5>
                            <p class="card-text">Fasilitas modern dengan perangkat audio-visual untuk meningkatkan kemampuan berbahasa asing siswa.</p>
                            <ul class="list-unstyled text-start">
                                <li><i class="fas fa-check text-success me-2"></i> Audio System Modern</li>
                                <li><i class="fas fa-check text-success me-2"></i> Software Bahasa</li>
                                <li><i class="fas fa-check text-success me-2"></i> Kapasitas 30 Siswa</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Mekanisme Pendaftaran Section -->
    <section id="pendaftaran" class="py-5">
        <div class="container">
            <div class="section-title text-center mb-5">
                <h6 class="text-primary text-uppercase">Mekanisme Pendaftaran</h6>
                <h2 class="display-5 fw-bold">Cara Mendaftar</h2>
                <p class="lead">Ikuti langkah-langkah berikut untuk menjadi bagian dari SMK Bakti Nusantara 666</p>
            </div>
            
            <div class="row">
                <div class="col-lg-6 mb-5">
                    <div class="bg-primary text-white p-4 rounded">
                        <h3 class="fw-bold mb-4">Persyaratan Pendaftaran</h3>
                        <ul class="list-unstyled">
                            <li class="mb-3"><i class="fas fa-check-circle me-2"></i> Fotokopi Ijazah SMP/sederajat (3 lembar)</li>
                            <li class="mb-3"><i class="fas fa-check-circle me-2"></i> Fotokopi SKHUN (3 lembar)</li>
                            <li class="mb-3"><i class="fas fa-check-circle me-2"></i> Fotokopi Akta Kelahiran (3 lembar)</li>
                            <li class="mb-3"><i class="fas fa-check-circle me-2"></i> Fotokopi Kartu Keluarga (3 lembar)</li>
                            <li class="mb-3"><i class="fas fa-check-circle me-2"></i> Pas foto 3x4 (4 lembar, background merah)</li>
                            <li class="mb-3"><i class="fas fa-check-circle me-2"></i> Surat Keterangan Sehat dari Dokter</li>
                            <li><i class="fas fa-check-circle me-2"></i> Fotokopi KTP Orang Tua (masing-masing 2 lembar)</li>
                        </ul>
                    </div>
                </div>
                
                <div class="col-lg-6">
                    <h3 class="fw-bold mb-4">Tahapan Pendaftaran</h3>
                    
                    <div class="d-flex step-card">
                        <div class="step-number">1</div>
                        <div>
                            <h5 class="fw-bold">Pendaftaran Online</h5>
                            <p class="mb-0">Isi formulir pendaftaran online melalui website resmi sekolah atau datang langsung ke sekolah.</p>
                        </div>
                    </div>
                    
                    <div class="d-flex step-card">
                        <div class="step-number">2</div>
                        <div>
                            <h5 class="fw-bold">Verifikasi Berkas</h5>
                            <p class="mb-0">Serahkan berkas persyaratan kepada panitia PPDB untuk diverifikasi kelengkapannya.</p>
                        </div>
                    </div>
                    
                    <div class="d-flex step-card">
                        <div class="step-number">3</div>
                        <div>
                            <h5 class="fw-bold">Tes Potensi Akademik</h5>
                            <p class="mb-0">Mengikuti tes potensi akademik yang diselenggarakan oleh sekolah.</p>
                        </div>
                    </div>
                    
                    <div class="d-flex step-card">
                        <div class="step-number">4</div>
                        <div>
                            <h5 class="fw-bold">Wawancara</h5>
                            <p class="mb-0">Mengikuti sesi wawancara dengan tim seleksi untuk mengetahui minat dan bakat.</p>
                        </div>
                    </div>
                    
                    <div class="d-flex step-card">
                        <div class="step-number">5</div>
                        <div>
                            <h5 class="fw-bold">Pengumuman Hasil</h5>
                            <p class="mb-0">Pengumuman hasil seleksi akan diinformasikan melalui website dan pengumuman di sekolah.</p>
                        </div>
                    </div>
                    
                    <div class="d-flex step-card">
                        <div class="step-number">6</div>
                        <div>
                            <h5 class="fw-bold">Daftar Ulang</h5>
                            <p class="mb-0">Melakukan daftar ulang bagi yang dinyatakan diterima dengan melunasi biaya pendidikan.</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-5">
                <a href="/login" class="btn btn-primary btn-lg px-5 py-3">Daftar Sekarang</a>
                <p class="mt-3">Pendaftaran dibuka hingga 30 Juni 2023</p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 mb-3 mb-md-0">
                    <h5 class="fw-bold mb-2">SMK BAKTI NUSANTARA 666</h5>
                    <p class="mb-0 small">Membangun Generasi Unggul, Berkarakter, dan Siap Kerja</p>
                </div>
                
                <div class="col-md-6 text-md-end">
                    <p class="mb-0 small">&copy; 2023 SMK Bakti Nusantara 666. All Rights Reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap & jQuery JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JS -->
    <script>
        $(document).ready(function(){
            // Smooth scrolling for navigation links
            $('a[href^="#"]').on('click', function(event) {
                var target = $(this.getAttribute('href'));
                if(target.length) {
                    event.preventDefault();
                    $('html, body').stop().animate({
                        scrollTop: target.offset().top - 60
                    }, 800);
                }
            });
            
            // Counter animation
            $('.counter-box h4').each(function() {
                $(this).prop('Counter',0).animate({
                    Counter: $(this).data('count')
                }, {
                    duration: 2000,
                    easing: 'swing',
                    step: function (now) {
                        $(this).text(Math.ceil(now));
                    }
                });
            });
            
            // Close mobile menu when clicking on a link
            $('.nav-link').on('click', function() {
                $('.navbar-collapse').collapse('hide');
            });

            // Auto-advance carousel every 5 seconds
            $('#jurusanCarousel').carousel({
                interval: 5000
            });
        });
    </script>
</body>
</html>