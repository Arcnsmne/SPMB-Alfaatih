@extends('layouts.landing')

@section('title', 'Profil Sekolah - SMK Bakti Nusantara 666')

@section('content')
<div class="container">
    <!-- Profil Singkat Sekolah -->
    <section id="profil" class="py-5">
        <div class="section-heading">
            <h2>Profil Singkat Sekolah</h2>
        </div>
        <div class="row align-items-center">
            <div class="col-lg-6">
                <img src="https://via.placeholder.com/500x350" class="img-fluid rounded shadow" alt="Gedung Sekolah">
            </div>
            <div class="col-lg-6">
                <h3 class="mt-4 mt-lg-0">SMK Bakti Nusantara 666</h3>
                <p class="lead">Mencetak Generasi Unggul, Kreatif, dan Berakhlak Mulia.</p>
                <p>SMK Bakti Nusantara 666 adalah lembaga pendidikan kejuruan yang berkomitmen untuk menyediakan pendidikan berkualitas yang relevan dengan kebutuhan industri. Dengan kurikulum yang adaptif dan tenaga pengajar profesional, kami siap mengantarkan siswa-siswi menjadi tenaga kerja yang kompeten dan berdaya saing tinggi.</p>
                <p>Didukung oleh fasilitas modern dan lingkungan belajar yang kondusif, kami fokus pada pengembangan hard skill dan soft skill siswa secara seimbang.</p>
            </div>
        </div>
    </section>

    <!-- Profil Jurusan -->
    <section id="jurusan" class="py-5 bg-light">
        <div class="section-heading">
            <h2>Profil Jurusan</h2>
        </div>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card h-100 text-center">
                    <div class="card-body">
                        <div class="p-3 mb-2">
                            <i class="bi bi-code-slash fs-1 text-primary"></i>
                        </div>
                        <h5 class="card-title">Rekayasa Perangkat Lunak (RPL)</h5>
                        <p class="card-text">Mempelajari pengembangan perangkat lunak, mulai dari aplikasi desktop, web, hingga mobile. Siswa akan dibekali kemampuan analisis, desain, dan implementasi software.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card h-100 text-center">
                    <div class="card-body">
                        <div class="p-3 mb-2">
                            <i class="bi bi-palette-fill fs-1 text-primary"></i>
                        </div>
                        <h5 class="card-title">Desain Komunikasi Visual (DKV)</h5>
                        <p class="card-text">Fokus pada industri kreatif, mempelajari desain grafis, ilustrasi, animasi, dan videografi untuk menciptakan solusi komunikasi visual yang efektif dan menarik.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card h-100 text-center">
                    <div class="card-body">
                        <div class="p-3 mb-2">
                            <i class="bi bi-hdd-network-fill fs-1 text-primary"></i>
                        </div>
                        <h5 class="card-title">Teknik Komputer dan Jaringan (TKJ)</h5>
                        <p class="card-text">Mempersiapkan siswa menjadi ahli di bidang infrastruktur IT, meliputi perakitan komputer, administrasi server, dan manajemen jaringan komputer.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Prestasi -->
    <section id="prestasi" class="py-5">
        <div class="section-heading">
            <h2>Prestasi Sekolah</h2>
        </div>
        <div class="row">
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card card-prestasi h-100">
                    <img src="https://via.placeholder.com/400x250" class="card-img-top" alt="Prestasi 1">
                    <div class="card-body">
                        <h5 class="card-title">Juara 1 LKS Nasional Web Technologies</h5>
                        <p class="card-text text-muted">Tahun 2023</p>
                        <p class="card-text">Siswa kami berhasil meraih medali emas dalam Lomba Kompetensi Siswa tingkat nasional pada bidang pengembangan web.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card card-prestasi h-100">
                    <img src="https://via.placeholder.com/400x250" class="card-img-top" alt="Prestasi 2">
                    <div class="card-body">
                        <h5 class="card-title">Best Animation FLS2N</h5>
                        <p class="card-text text-muted">Tahun 2023</p>
                        <p class="card-text">Karya animasi pendek dari siswa DKV memenangkan penghargaan sebagai animasi terbaik di Festival Lomba Seni Siswa Nasional.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card card-prestasi h-100">
                    <img src="https://via.placeholder.com/400x250" class="card-img-top" alt="Prestasi 3">
                    <div class="card-body">
                        <h5 class="card-title">Finalis Cisco NetRiders Indonesia</h5>
                        <p class="card-text text-muted">Tahun 2022</p>
                        <p class="card-text">Tim dari jurusan TKJ berhasil masuk ke babak final kompetisi jaringan tingkat nasional yang diselenggarakan oleh Cisco.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Fasilitas -->
    <section id="fasilitas" class="py-5 bg-light">
        <div class="section-heading">
            <h2>Fasilitas Unggulan</h2>
        </div>
        <div class="row">
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="card card-fasilitas text-center h-100">
                    <div class="card-body"><i class="bi bi-pc-display-horizontal fs-1 text-primary mb-3"></i><h5>Lab Komputer Modern</h5><p>Lab dengan spesifikasi tinggi untuk praktik RPL dan DKV.</p></div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="card card-fasilitas text-center h-100">
                    <div class="card-body"><i class="bi bi-wifi fs-1 text-primary mb-3"></i><h5>Akses Internet Cepat</h5><p>Koneksi internet fiber optic di seluruh area sekolah.</p></div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="card card-fasilitas text-center h-100">
                    <div class="card-body"><i class="bi bi-camera-reels-fill fs-1 text-primary mb-3"></i><h5>Studio Multimedia</h5><p>Studio untuk praktik fotografi, videografi, dan animasi.</p></div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="card card-fasilitas text-center h-100">
                    <div class="card-body"><i class="bi bi-bookshelf fs-1 text-primary mb-3"></i><h5>Perpustakaan Digital</h5><p>Akses ke ribuan e-book dan jurnal digital.</p></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Mekanisme Pendaftaran -->
    <section id="mekanisme" class="py-5">
        <div class="section-heading">
            <h2>Mekanisme Pendaftaran</h2>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="mekanisme-item mb-4"><div class="mekanisme-icon"><i class="bi bi-person-plus-fill"></i></div><div><h5>1. Buat Akun</h5><p>Calon siswa membuat akun pendaftaran melalui tombol "Daftar Sekarang" di website ini.</p></div></div>
                <div class="mekanisme-item mb-4"><div class="mekanisme-icon"><i class="bi bi-pencil-square"></i></div><div><h5>2. Isi Formulir</h5><p>Login ke akun dan lengkapi formulir pendaftaran dengan data diri, data orang tua, dan informasi asal sekolah.</p></div></div>
                <div class="mekanisme-item mb-4"><div class="mekanisme-icon"><i class="bi bi-cloud-arrow-up-fill"></i></div><div><h5>3. Upload Berkas</h5><p>Unggah dokumen-dokumen yang diperlukan seperti Ijazah/SKL, Kartu Keluarga, dan Akta Kelahiran dalam format digital.</p></div></div>
                <div class="mekanisme-item mb-4"><div class="mekanisme-icon"><i class="bi bi-credit-card-2-front-fill"></i></div><div><h5>4. Lakukan Pembayaran</h5><p>Lakukan pembayaran biaya pendaftaran melalui metode yang tersedia dan unggah bukti pembayaran.</p></div></div>
                <div class="mekanisme-item mb-4"><div class="mekanisme-icon"><i class="bi bi-patch-check-fill"></i></div><div><h5>5. Verifikasi & Pengumuman</h5><p>Panitia akan memverifikasi data dan berkas. Hasil seleksi akan diumumkan melalui akun masing-masing.</p></div></div>
            </div>
        </div>
    </section>
</div>
@endsection
