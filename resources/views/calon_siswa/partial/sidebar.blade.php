<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header" style="text-align: center; padding: 20px 15px;">
            <div class="logo" style="margin-bottom: 10px;">
                <a href="/siswa">
                    <img src="{{ asset('assets/images/logo/bn.png') }}" alt="Logo" style="height: 60px;">
                </a>
            </div>
            <div class="brand-text" style="color: #007bff; font-weight: bold; font-size: 16px; letter-spacing: 1px;">
                SPMB 666 - SISWA
            </div>
            <div class="toggler" style="position: absolute; top: 10px; right: 15px;">
                <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Menu Calon Siswa</li>
                
                <li class="sidebar-item {{ request()->is('siswa') || request()->is('pendaftar/dashboard') ? 'active' : '' }}">
                    <a href="/siswa" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                
                <li class="sidebar-title">Proses Pendaftaran</li>
                
                <li class="sidebar-item {{ request()->is('profil*') ? 'active' : '' }}">
                    <a href="/profil" class='sidebar-link'>
                        <i class="bi bi-person-fill"></i>
                        <span>Profil Saya</span>
                    </a>
                </li>
                
                <li class="sidebar-item {{ request()->is('formulir*') ? 'active' : '' }}">
                    <a href="/formulir" class='sidebar-link'>
                        <i class="bi bi-file-text-fill"></i>
                        <span>Formulir Pendaftaran</span>
                    </a>
                </li>
                
                <li class="sidebar-item {{ request()->is('upload*') ? 'active' : '' }}">
                    <a href="/upload" class='sidebar-link'>
                        <i class="bi bi-cloud-upload-fill"></i>
                        <span>Upload Berkas</span>
                    </a>
                </li>
                
                <li class="sidebar-item {{ request()->is('pembayaran*') ? 'active' : '' }}">
                    <a href="/pembayaran" class='sidebar-link'>
                        <i class="bi bi-credit-card-fill"></i>
                        <span>Pembayaran</span>
                    </a>
                </li>
                
                <li class="sidebar-title">Monitoring</li>
                
                <li class="sidebar-item {{ request()->is('monitoring*') ? 'active' : '' }}">
                    <a href="/monitoring" class='sidebar-link'>
                        <i class="bi bi-graph-up-arrow"></i>
                        <span>Monitoring Progres</span>
                    </a>
                </li>
            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>