<div id="app">
    <div id="sidebar" class="active">
        <div class="sidebar-wrapper active">
            <div class="sidebar-header" style="text-align: center; padding: 20px 15px;">
                <div class="logo" style="margin-bottom: 10px;">
                    <a href="{{ route('kepsek.dashboard') }}">
                        <img src="{{ asset('assets/images/logo/bn.png') }}" alt="Logo" style="height: 60px;">
                    </a>
                </div>
                <div class="brand-text" style="color: #007bff; font-weight: bold; font-size: 18px; letter-spacing: 1px;">
                    SPMB 666
                </div>
                <div class="toggler" style="position: absolute; top: 10px; right: 15px;">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
            <div class="sidebar-menu">
                <ul class="menu">
                    <li class="sidebar-title">Menu</li>
                    
                    <li class="sidebar-item {{ request()->is('kepsek/dashboard') ? 'active' : '' }}">
                        <a href="{{ route('kepsek.dashboard') }}" class='sidebar-link'>
                            <i class="bi bi-grid-fill"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    
                    <li class="sidebar-title">KPI & Analisis</li>
                    
                    <li class="sidebar-item {{ request()->is('kepsek/calon-siswa*') ? 'active' : '' }}">
                        <a href="{{ route('kepsek.calon_siswa') }}" class='sidebar-link'>
                            <i class="bi bi-people"></i>
                            <span>Pendaftar vs Kuota</span>
                        </a>
                    </li>
                    
                    <li class="sidebar-item {{ request()->is('kepsek/asal-sekolah*') ? 'active' : '' }}">
                        <a href="{{ route('kepsek.asal_sekolah') }}" class='sidebar-link'>
                            <i class="bi bi-building"></i>
                            <span>Asal Sekolah</span>
                        </a>
                    </li>
                    
                    <li class="sidebar-item {{ request()->is('kepsek/asal-wilayah*') ? 'active' : '' }}">
                        <a href="{{ route('kepsek.asal_wilayah') }}" class='sidebar-link'>
                            <i class="bi bi-geo-alt"></i>
                            <span>Asal Wilayah</span>
                        </a>
                    </li>
                    
                    <li class="sidebar-item {{ request()->is('kepsek/rekap-pembayaran*') ? 'active' : '' }}">
                        <a href="{{ route('kepsek.rekap_pembayaran') }}" class='sidebar-link'>
                            <i class="bi bi-bar-chart"></i>
                            <span>Rekap Pembayaran</span>
                        </a>
                    </li>
                </ul>
            </div>
            <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
        </div>
    </div>
    <div id="main">
        <div class="page-heading">