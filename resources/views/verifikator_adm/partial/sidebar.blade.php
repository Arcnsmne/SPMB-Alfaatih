<div id="app">
    <div id="sidebar" class="active">
        <div class="sidebar-wrapper active">
            <div class="sidebar-header" style="text-align: center; padding: 20px 15px;">
                <div class="logo" style="margin-bottom: 10px;">
                    <a href="/verifikator_adm/dashboard">
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
                    
                    <li class="sidebar-item {{ request()->is('verifikator_adm/dashboard') ? 'active' : '' }}">
                        <a href="{{ route('verifikator_adm.dashboard') }}" class='sidebar-link'>
                            <i class="bi bi-grid-fill"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    
                    <li class="sidebar-title">Verifikasi</li>
                    
                    <li class="sidebar-item {{ request()->is('verifikator_adm/data-verifikasi*') ? 'active' : '' }}">
                        <a href="{{ route('verifikator_adm.data_verifikasi') }}" class='sidebar-link'>
                            <i class="bi bi-file-check-fill"></i>
                            <span>Data Verifikasi</span>
                        </a>
                    </li>
                </ul>
            </div>
            <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
        </div>
    </div>
    <div id="main">
        <div class="page-heading">