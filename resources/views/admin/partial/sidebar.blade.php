<div id="app">
    <div id="sidebar" class="active">
        <div class="sidebar-wrapper active">
            <div class="sidebar-header" style="text-align: center; padding: 20px 15px;">
                <div class="logo" style="margin-bottom: 10px;">
                    <a href="/admin/dashboard">
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
                    
                    <li class="sidebar-item {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                        <a href="/admin/dashboard" class='sidebar-link'>
                            <i class="bi bi-grid-fill"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    
                    <li class="sidebar-title">Data Master</li>
                    
                    <li class="sidebar-item {{ request()->is('admin/gelombang*') ? 'active' : '' }}">
                        <a href="/admin/gelombang" class='sidebar-link'>
                            <i class="bi bi-stack"></i>
                            <span>Gelombang</span>
                        </a>
                    </li>
                    
                    <li class="sidebar-item {{ request()->is('admin/jurusan*') ? 'active' : '' }}">
                        <a href="/admin/jurusan" class='sidebar-link'>
                            <i class="bi bi-collection"></i>
                            <span>Jurusan</span>
                        </a>
                    </li>
                    
                    <li class="sidebar-item {{ request()->is('admin/wilayah*') ? 'active' : '' }}">
                        <a href="/admin/wilayah" class='sidebar-link'>
                            <i class="bi bi-map"></i>
                            <span>Wilayah</span>
                        </a>
                    </li>
                    
                    <li class="sidebar-item {{ request()->is('admin/pengguna*') ? 'active' : '' }}">
                        <a href="/admin/pengguna" class='sidebar-link'>
                            <i class="bi bi-person"></i>
                            <span>Pengguna</span>
                        </a>
                    </li>
                    
                    
                    <li class="sidebar-item {{ request()->is('admin/peta-sebaran*') ? 'active' : '' }}">
                        <a href="/admin/peta-sebaran" class='sidebar-link'>
                            <i class="bi bi-geo-alt"></i>
                            <span>Peta Sebaran</span>
                        </a>
                    </li>
                </ul>
            </div>
            <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
        </div>
    </div>
    <div id="main">
        <div class="page-heading">