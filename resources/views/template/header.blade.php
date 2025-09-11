<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>{{ $title }}</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <link rel="icon" href="{{ asset('admin/assets/img/kaiadmin/favicon.ico') }}" type="image/x-icon" />

    <!-- Notification icons -->
    <style>
        .notif-icon {
            width: 40px;
            height: 40px;
            background-color: #28a745;
            /* warna latar hijau, sesuaikan jika perlu */
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            /* jangan mengecil saat ruang terbatas */
            margin-right: 10px;
        }

        .notif-icon i {
            color: white;
            font-size: 18px;
        }
    </style>



    <!-- Fonts and icons -->
    <script src={{ asset('admin/assets/js/plugin/webfont/webfont.min.js') }}></script>
    <script src={{ asset('admin/assets/js/plugin/webfont/webfont.min.js') }}></script>
    <script>
        WebFont.load({
            google: {
                families: ["Public Sans:300,400,500,600,700"]
            },
            custom: {
                families: [
                    "Font Awesome 5 Solid",
                    "Font Awesome 5 Regular",
                    "Font Awesome 5 Brands",
                    "simple-line-icons",
                ],
                urls: ["{{ asset('admin/assets/css/fonts.min.css') }}"],
                urls: ["{{ asset('admin/assets/css/fonts.min.css') }}"],
            },
            active: function() {
                sessionStorage.fonts = true;
            },
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/plugins.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/css/kaiadmin.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/css/plugins.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/css/kaiadmin.min.css') }}" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/demo.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/css/demo.css') }}" />

    @php
        use App\Models\Notification;

        $user = auth()->user();
        $notifications = \App\Models\Notification::where('user_id', $user->id)
            ->where('is_read', false)
            ->latest()
            ->limit(5)
            ->get();

        $totalUnread = $notifications->count();
    @endphp
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <div class="sidebar" data-background-color="dark">
            <div class="sidebar-logo">
                <!-- Logo Header -->
                <div class="logo-header" data-background-color="dark">
                    <div class="logo">
                        <img src="{{ asset('admin/assets/img/Logo2.png') }}" alt="navbar brand" class="navbar-brand"
                            height="50" />
                        <img src="{{ asset('admin/assets/img/Logo2.png') }}" alt="navbar brand" class="navbar-brand"
                            height="50" />
                    </div>
                    <div class="nav-toggle">
                        <button class="btn btn-toggle toggle-sidebar">
                            <i class="gg-menu-right"></i>
                        </button>
                        <button class="btn btn-toggle sidenav-toggler">
                            <i class="gg-menu-left"></i>
                        </button>
                    </div>
                    <button class="topbar-toggler more">
                        <i class="gg-more-vertical-alt"></i>
                    </button>
                </div>
                <!-- End Logo Header -->
            </div>
            <div class="sidebar-wrapper scrollbar scrollbar-inner">
                <div class="sidebar-content">
                    <ul class="nav nav-secondary">
                        <li class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
                            <a href="{{ route('dashboard') }}">
                                <i class="fas fa-home"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>

                        <li class="nav-section">
                            <span class="sidebar-mini-icon">
                                <i class="fa fa-ellipsis-h"></i>
                            </span>
                            <h4 class="text-section">Manajemen</h4>
                        </li>
                        <li class="nav-item">
                            <a data-bs-toggle="collapse" href="#base">
                                <i class="fas fa-concierge-bell"></i>
                                <p>Surat</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse {{ request()->is('suratktm*') || request()->is('suratktu*') || request()->is('suratdomisili*') || request()->is('suratpindah*') || request()->is('suratkpt*') || request()->is('suratlainnya*') ? 'show' : '' }}"
                                <div
                                class="collapse {{ request()->is('suratktm*') || request()->is('suratktu*') || request()->is('suratdomisili*') || request()->is('suratpindah*') || request()->is('suratkpt*') || request()->is('suratlainnya*') ? 'show' : '' }}"
                                id="base">
                                <ul class="nav nav-collapse">
                                    <li class="nav-item {{ request()->is('suratktm*') ? 'active' : '' }}">
                                        <a href="{{ url('/suratktm') }}">
                                            <span class="sub-item">
                                                <p>Surat Keterangan Tidak Mampu</p>
                                            </span>
                                        </a>
                                    </li>
                                    <li class="nav-item {{ request()->is('suratktu*') ? 'active' : '' }}">
                                        <a href="{{ url('/suratktu') }}">
                                            <span class="sub-item">
                                                <p>Surat Keterangan Tempat Usaha</p>
                                            </span>
                                        </a>
                                    </li>
                                    <li class="nav-item {{ request()->is('suratdomisili*') ? 'active' : '' }}">
                                        <a href="{{ url('/suratdomisili') }}">
                                            <span class="sub-item">
                                                <p>Surat Keterangan Domisili</p>
                                            </span>
                                        </a>
                                    </li>
                                    <li class="nav-item {{ request()->is('suratpindah*') ? 'active' : '' }}">
                                        <a href="{{ url('/suratpindah') }}">
                                            <span class="sub-item">
                                                <p>Surat Keterangan Pindah</p>
                                            </span>
                                        </a>
                                    </li>
                                    <li class="nav-item {{ request()->is('suratkpt*') ? 'active' : '' }}">
                                        <a href="{{ url('/suratkpt') }}">
                                            <span class="sub-item">
                                                <p>Surat Keterangan Perhasilan Tetap</p>
                                            </span>
                                        </a>
                                    </li>
                                    <li class="nav-item {{ request()->is('suratlainnya*') ? 'active' : '' }}">
                                        <a href="{{ url('/suratlainnya') }}">
                                            <span class="sub-item">
                                                <p>Surat Lainnya</p>
                                            </span>
                                        </a>
                                    </li>
                                    <li class="nav-item {{ request()->is('arsipsurat*') ? 'active' : '' }}">
                                        <a href="{{ url('/arsip') }}">
                                            <span class="sub-item">
                                                <p>Arsip Surat</p>
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item {{ request()->is('berita*') ? 'active' : '' }}">
                            <a href="{{ url('/berita') }}">
                                <i class="fas fa-newspaper"></i>
                                <p>Berita</p>

                            </a>
                            {{-- <div class="collapse" id="sidebarLayouts">
                                <ul class="nav nav-collapse">
                                    <li>
                                        <a href="sidebar-style-2.html">
                                            <span class="sub-item">Sidebar Style 2</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="icon-menu.html">
                                            <span class="sub-item">Icon Menu</span>
                                        </a>
                                    </li>
                                </ul>
                            </div> --}}
                        </li>
                        <li class="nav-item {{ request()->is('apbdes*') ? 'active' : '' }}">
                            <a href="{{ url('/apbdes') }}">
                                <i class="fa-solid fa-money-check-dollar"></i>
                                <p>APBDes</p>
                            </a>
                        </li>
                        <li class="nav-item {{ request()->is('keluhan*') ? 'active' : '' }}">
                            <a href="{{ url('/keluhan') }}">
                                <i class="fas fa-file-alt"></i>
                                <p>Laporan / Keluhan</p>
                                {{-- <span class="caret"></span> --}}
                            </a>
                        </li>
                        <li class="nav-item {{ request()->is('verifikasi*') ? 'active' : '' }}">
                            <a href="{{ route('verifikasi.index') }}">
                                <i class="fas fa-check-circle"></i>
                                <p>Riwayat Verifikasi Surat</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a data-bs-toggle="collapse" href="#charts">
                                <i class="fas fa-globe"></i>
                                <p>Landing Page</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse {{ request()->is('fasilitas*') || request()->is('struktur*') || request()->is('galeri*') ? 'show' : '' }}"
                                id="charts">
                                <ul class="nav nav-collapse">
                                    <li class="nav-item {{ request()->is('fasilitas*') ? 'active' : '' }}">
                                        <a href="{{ url('/fasilitas') }}">
                                            <span class="sub-item">
                                                <p>Kelola Fasilitas</p>
                                            </span>
                                        </a>
                                    </li>
                                    <li class="nav-item {{ request()->is('struktur*') ? 'active' : '' }}">
                                        <a href="{{ url('/struktur') }}">
                                            <span class="sub-item">Struktur Desa</span>
                                        </a>
                                    </li>
                                    <li class="nav-item {{ request()->is('galeri*') ? 'active' : '' }}">
                                        <a href="{{ url('/galeri') }}">
                                            <span class="sub-item">Galeri Desa</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        {{-- <li class="nav-item">
                            <a href="widgets.html">
                                <i class="fas fa-desktop"></i>
                                <p>Widgets</p>
                                <span class="badge badge-success">4</span>
                            </a>
                        </li> --}}
                        {{-- <li class="nav-item {{ request()->is('fasilitas*') ? 'active' : '' }}">
                            <a href="{{ url('/fasilitas') }}">
                                <i class="fas fa-hospital"></i>
                                <p>Kelola Fasilitas</p>
                            </a>
                        </li> --}}
                        <li class="nav-item ">
                            <a data-bs-toggle="collapse" href="#pendudukmenu">
                                <i class="fas fa-users"></i>
                                <p>Data Penduduk</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse  {{ request()->is('kk*') || request()->is('penduduk*') ? 'show' : '' }}"
                                id="pendudukmenu">

                                <ul class="nav nav-collapse">
                                    <li class="nav-item  {{ request()->is('kk*') ? 'active' : '' }}">
                                        <a href="{{ url('/kk') }}">
                                            <span class="sub-item">Kelola KK</span>
                                        </a>
                                    </li>
                                    <li class="nav-item {{ request()->is('penduduk*') ? 'active' : '' }}">
                                        <a href="{{ url('/penduduk') }}">
                                            <span class="sub-item">Kelola Penduduk</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item {{ request()->is('pengguna*') ? 'active' : '' }}">
                            <a href="{{ url('/pengguna') }}">
                                <i class="fas fa-users"></i>
                                <p>Kelola User</p>
                            </a>
                        </li>

                        {{-- <li class="nav-item">
                            <a data-bs-toggle="collapse" href="#submenu">
                                <i class="fas fa-bars"></i>
                                <p>Menu Levels</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse" id="submenu">
                                <ul class="nav nav-collapse">
                                    <li>
                                        <a data-bs-toggle="collapse" href="#subnav1">
                                            <span class="sub-item">Level 1</span>
                                            <span class="caret"></span>
                                        </a>
                                        <div class="collapse" id="subnav1">
                                            <ul class="nav nav-collapse subnav">
                                                <li>
                                                    <a href="#">
                                                        <span class="sub-item">Level 2</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <span class="sub-item">Level 2</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li>
                                        <a data-bs-toggle="collapse" href="#subnav2">
                                            <span class="sub-item">Level 1</span>
                                            <span class="caret"></span>
                                        </a>
                                        <div class="collapse" id="subnav2">
                                            <ul class="nav nav-collapse subnav">
                                                <li>
                                                    <a href="#">
                                                        <span class="sub-item">Level 2</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="sub-item">Level 1</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li> --}}
                    </ul>
                </div>
            </div>
        </div>
        <!-- End Sidebar -->

        <div class="main-panel">
            <div class="main-header">
                <div class="main-header-logo">
                    <!-- Logo Header -->
                    <div class="logo-header" data-background-color="dark">
                        <a href="{{ route('home') }}" class="logo">
                            <img src={{ asset('admin/assets/img/Logo2.png') }} alt="navbar brand" <img
                                src={{ asset('admin/assets/img/Logo2.png') }} alt="navbar brand" class="navbar-brand"
                                height="20" />
                        </a>
                        <div class="nav-toggle">
                            <button class="btn btn-toggle toggle-sidebar">
                                <i class="gg-menu-right"></i>
                            </button>
                            <button class="btn btn-toggle sidenav-toggler">
                                <i class="gg-menu-left"></i>
                            </button>
                        </div>
                        <button class="topbar-toggler more">
                            <i class="gg-more-vertical-alt"></i>
                        </button>
                    </div>
                    <!-- End Logo Header -->
                </div>
                <!-- Navbar Header -->
                <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
                    <div class="container-fluid">
                        {{-- <nav
                            class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button type="submit" class="btn btn-search pe-1">
                                        <i class="fa fa-search search-icon"></i>
                                    </button>
                                </div>
                                <input type="text" placeholder="Search ..." class="form-control" />
                            </div>
                        </nav> --}}

                        <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
                            <li class="nav-item topbar-icon dropdown hidden-caret d-flex d-lg-none">
                                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#"
                                    role="button" aria-expanded="false" aria-haspopup="true">
                                    <i class="fa fa-search"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-search animated fadeIn">
                                    <form class="navbar-left navbar-form nav-search">
                                        <div class="input-group">
                                            <input type="text" placeholder="Search ..." class="form-control" />
                                        </div>
                                    </form>
                                </ul>
                            </li>
                            {{-- <li class="nav-item topbar-icon dropdown hidden-caret">
                                <a class="nav-link dropdown-toggle" href="#" id="messageDropdown"
                                    role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    <i class="fa fa-envelope"></i>
                                </a>
                                <ul class="dropdown-menu messages-notif-box animated fadeIn"
                                    aria-labelledby="messageDropdown">
                                    <li>
                                        <div class="dropdown-title d-flex justify-content-between align-items-center">
                                            Messages
                                            <a href="#" class="small">Mark all as read</a>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="message-notif-scroll scrollbar-outer">
                                            <div class="notif-center">
                                                <a href="#">
                                                    <div class="notif-img">
                                                        <img src="assets/img/jm_denis.jpg" alt="Img Profile" />
                                                    </div>
                                                    <div class="notif-content">
                                                        <span class="subject">Jimmy Denis</span>
                                                        <span class="block"> How are you ? </span>
                                                        <span class="time">5 minutes ago</span>
                                                    </div>
                                                </a>
                                                <a href="#">
                                                    <div class="notif-img">
                                                        <img src="assets/img/chadengle.jpg" alt="Img Profile" />
                                                    </div>
                                                    <div class="notif-content">
                                                        <span class="subject">Chad</span>
                                                        <span class="block"> Ok, Thanks ! </span>
                                                        <span class="time">12 minutes ago</span>
                                                    </div>
                                                </a>
                                                <a href="#">
                                                    <div class="notif-img">
                                                        <img src="assets/img/mlane.jpg" alt="Img Profile" />
                                                    </div>
                                                    <div class="notif-content">
                                                        <span class="subject">Jhon Doe</span>
                                                        <span class="block">
                                                            Ready for the meeting today...
                                                        </span>
                                                        <span class="time">12 minutes ago</span>
                                                    </div>
                                                </a>
                                                <a href="#">
                                                    <div class="notif-img">
                                                        <img src="assets/img/talha.jpg" alt="Img Profile" />
                                                    </div>
                                                    <div class="notif-content">
                                                        <span class="subject">Talha</span>
                                                        <span class="block"> Hi, Apa Kabar ? </span>
                                                        <span class="time">17 minutes ago</span>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <a class="see-all" href="javascript:void(0);">See all messages<i
                                                class="fa fa-angle-right"></i>
                                        </a>
                                    </li>
                                </ul>
                            </li> --}}

                            <!-- Notification Dropdown -->
                            <li class="nav-item topbar-icon dropdown hidden-caret">
                                <a class="nav-link dropdown-toggle" href="#" id="notifDropdown" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-bell"></i>
                                    <span class="notification" id="notification-count">
                                        {{ $totalUnread > 0 ? $totalUnread : '0' }}
                                    </span>

                                </a>
                                <ul class="dropdown-menu notif-box animated fadeIn" aria-labelledby="notifDropdown">
                                    <li>
                                        <div class="dropdown-title">
                                            You have {{ $totalUnread }} new
                                            notification{{ $totalUnread == 1 ? '' : 's' }}
                                        </div>
                                    </li>
                                    <li>
                                        <div class="notif-scroll scrollbar-outer">
                                            <div class="notif-center">
                                                @forelse($notifications as $notification)
                                                    <a href="{{ route('notifications.mark-read-link', $notification->id) }}"
                                                        class="notification-item">
                                                        <div class="notif-icon notif-success">
                                                            <i class="fa fa-bell"></i>
                                                        </div>
                                                        <div class="notif-content">
                                                            <span class="block">{{ $notification->message }}</span>
                                                            <span
                                                                class="time">{{ \Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}</span>
                                                        </div>
                                                    </a>
                                                @empty
                                                    <div class="text-center text-muted py-2">
                                                        Tidak ada notifikasi baru.
                                                    </div>
                                                @endforelse
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <a class="see-all" href="{{ route('notifications.mark-all-read-link') }}">

                                            Tandai semua telah dibaca <i class="fa fa-angle-right"></i>
                                        </a>
                                    </li>
                                </ul>

                            </li>
                            {{-- <li class="nav-item topbar-icon dropdown hidden-caret">
                                <a class="nav-link" data-bs-toggle="dropdown" href="#" aria-expanded="false">
                                    <i class="fas fa-layer-group"></i>
                                </a>
                                <div class="dropdown-menu quick-actions animated fadeIn">
                                    <div class="quick-actions-header">
                                        <span class="title mb-1">Quick Actions</span>
                                        <span class="subtitle op-7">Shortcuts</span>
                                    </div>
                                    <div class="quick-actions-scroll scrollbar-outer">
                                        <div class="quick-actions-items">
                                            <div class="row m-0">
                                                <a class="col-6 col-md-4 p-0" href="#">
                                                    <div class="quick-actions-item">
                                                        <div class="avatar-item bg-danger rounded-circle">
                                                            <i class="far fa-calendar-alt"></i>
                                                        </div>
                                                        <span class="text">Calendar</span>
                                                    </div>
                                                </a>
                                                <a class="col-6 col-md-4 p-0" href="#">
                                                    <div class="quick-actions-item">
                                                        <div class="avatar-item bg-warning rounded-circle">
                                                            <i class="fas fa-map"></i>
                                                        </div>
                                                        <span class="text">Maps</span>
                                                    </div>
                                                </a>
                                                <a class="col-6 col-md-4 p-0" href="#">
                                                    <div class="quick-actions-item">
                                                        <div class="avatar-item bg-info rounded-circle">
                                                            <i class="fas fa-file-excel"></i>
                                                        </div>
                                                        <span class="text">Reports</span>
                                                    </div>
                                                </a>
                                                <a class="col-6 col-md-4 p-0" href="#">
                                                    <div class="quick-actions-item">
                                                        <div class="avatar-item bg-success rounded-circle">
                                                            <i class="fas fa-envelope"></i>
                                                        </div>
                                                        <span class="text">Emails</span>
                                                    </div>
                                                </a>
                                                <a class="col-6 col-md-4 p-0" href="#">
                                                    <div class="quick-actions-item">
                                                        <div class="avatar-item bg-primary rounded-circle">
                                                            <i class="fas fa-file-invoice-dollar"></i>
                                                        </div>
                                                        <span class="text">Invoice</span>
                                                    </div>
                                                </a>
                                                <a class="col-6 col-md-4 p-0" href="#">
                                                    <div class="quick-actions-item">
                                                        <div class="avatar-item bg-secondary rounded-circle">
                                                            <i class="fas fa-credit-card"></i>
                                                        </div>
                                                        <span class="text">Payments</span>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li> --}}

                            <li class="nav-item topbar-user dropdown hidden-caret">
                                <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" href="#"
                                    aria-expanded="false">
                                    <div class="avatar-sm">
                                        <img src="{{ asset('admin/assets/img/profile.jpg') }}" alt="..." <img
                                            src="{{ asset('admin/assets/img/profile.jpg') }}" alt="..."
                                            class="avatar-img rounded-circle" />
                                    </div>
                                    <span class="profile-username">
                                        <span class="op-7">Hi,</span>
                                        <span class="fw-bold">{{ $user->name ?? 'Guest' }}</span>
                                    </span>
                                </a>
                                <ul class="dropdown-menu dropdown-user animated fadeIn">
                                    <div class="dropdown-user-scroll scrollbar-outer">
                                        <li>
                                            <div class="user-box">
                                                <div class="avatar-lg">
                                                    <img src="{{ asset('admin/assets/img/profile.jpg') }}" <img
                                                        src="{{ asset('admin/assets/img/profile.jpg') }}"
                                                        alt="image profile" class="avatar-img rounded" />
                                                </div>
                                                <div class="u-text">
                                                    <h4>{{ $user->name }}</h4>
                                                    <p class="text-muted">{{ $user->email }}</p>
                                                    <a href="profile.html"
                                                        class="btn btn-xs btn-secondary btn-sm">View Profile</a>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="{{ route('profile.edit') }}">My
                                                Profile</a>
                                            <a class="dropdown-item" href="#">My Balance</a>
                                            <a class="dropdown-item" href="#">Inbox</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Account Setting</a>
                                            <div class="dropdown-divider"></div>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                style="display: none;">
                                                @csrf
                                            </form>

                                            <a class="dropdown-item" href="#"
                                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                Logout
                                            </a>

                                        </li>
                                    </div>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
                <!-- End Navbar -->
            </div>
