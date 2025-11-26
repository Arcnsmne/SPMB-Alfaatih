<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Portal Calon Siswa')</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/iconly/bold.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.svg') }}" type="image/x-icon">
    
    <!-- DataTables CSS dengan Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    
    <style>
        .progress-track {
            position: relative;
            padding-left: 40px;
            margin-bottom: 25px;
        }
        
        .progress-track::before {
            content: '';
            position: absolute;
            left: 15px;
            top: 0;
            width: 2px;
            height: 100%;
            background: #dee2e6;
        }
        
        .progress-track:last-child::before {
            display: none;
        }
        
        .step-icon {
            position: absolute;
            left: 0;
            top: 0;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 2;
            font-size: 0.875rem;
        }
        
        .step-icon.completed {
            background: #198754;
            color: white;
        }
        
        .step-icon.current {
            background: #0d6efd;
            color: white;
        }
        
        .step-icon.pending {
            background: #6c757d;
            color: white;
        }
        
        .quick-action-card {
            transition: transform 0.3s ease;
            border: none;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        }
        
        .quick-action-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(0,0,0,0.15);
        }
        
        .action-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        /* FIX UNTUK SIDEBAR TOGGLE */
        #sidebar {
            transition: all 0.3s ease;
        }

        #main {
            transition: all 0.3s ease;
        }

        /* Ketika sidebar hidden */
        .sidebar-hidden #sidebar {
            transform: translateX(-100%);
            opacity: 0;
            visibility: hidden;
        }

        .sidebar-hidden #main {
            margin-left: 0 !important;
            width: 100%;
        }

        /* Overlay untuk mobile */
        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 999;
        }

        .sidebar-hidden .sidebar-overlay {
            display: block;
        }

        @media (min-width: 768px) {
            .sidebar-hidden #sidebar {
                transform: translateX(-250px);
                opacity: 1;
                visibility: visible;
            }

            .sidebar-hidden #main {
                margin-left: 0;
            }
        }
    </style>
    
    @stack('styles')
</head>

<body>
    <!-- Overlay untuk mobile -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>
    
    <div id="app">
        @include('calon_siswa.partial.sidebar')
        
        <div id="main">
            @include('calon_siswa.partial.header')
            
            <div class="page-content">
                @yield('content')
            </div>

            @include('calon_siswa.partial.footer')
        </div>
    </div>

    <!-- JS -->
    <script src="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/apexcharts/apexcharts.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    
    <!-- DataTables JS dengan Bootstrap 5 -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    
    <script>
        // SIDEBAR TOGGLE FUNCTION - FIXED VERSION
        document.addEventListener('DOMContentLoaded', function() {
            const burgerBtn = document.querySelector('.burger-btn');
            const app = document.getElementById('app');
            const overlay = document.getElementById('sidebarOverlay');
            
            console.log('DOM Loaded - Burger button:', burgerBtn);
            
            if (burgerBtn) {
                burgerBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    console.log('Hamburger button clicked!');
                    
                    // Toggle class pada app container
                    app.classList.toggle('sidebar-hidden');
                    console.log('App classes:', app.classList);
                });
            } else {
                console.error('Burger button not found!');
            }
            
            // Close sidebar when overlay is clicked (mobile)
            if (overlay) {
                overlay.addEventListener('click', function() {
                    app.classList.remove('sidebar-hidden');
                });
            }
            
            // Close sidebar when window is resized to desktop
            window.addEventListener('resize', function() {
                if (window.innerWidth >= 768) {
                    app.classList.remove('sidebar-hidden');
                }
            });
            
            // Initialize DataTables
            if (typeof $.fn.DataTable !== 'undefined') {
                $('.table').DataTable({
                    "pageLength": 10,
                    "language": {
                        "search": "Cari:",
                        "lengthMenu": "Tampilkan _MENU_ data per halaman",
                        "zeroRecords": "Tidak ada data yang ditemukan",
                        "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
                        "infoEmpty": "Tidak ada data",
                        "infoFiltered": "(disaring dari _MAX_ total data)",
                        "paginate": {
                            "first": "Pertama",
                            "last": "Terakhir",
                            "next": "Selanjutnya",
                            "previous": "Sebelumnya"
                        }
                    }
                });
            }
        });

        // Fallback jika DOMContentLoaded tidak bekerja
        window.addEventListener('load', function() {
            console.log('Window loaded - checking burger button...');
            const burgerBtn = document.querySelector('.burger-btn');
            if (burgerBtn) {
                console.log('Burger button found on window load');
            }
        });
    </script>
    
    @stack('scripts')
</body>

</html>