<!DOCTYPE html>

<!-- =========================================================
* Sneat - Bootstrap 5 HTML Admin Template - Pro | v1.0.0
==============================================================

* Product Page: https://themeselection.com/products/sneat-bootstrap-html-admin-template/
* Created by: ThemeSelection
* License: You must have a valid license purchased in order to legally use the theme for your project.
* Copyright ThemeSelection (https://themeselection.com)

=========================================================
 -->
<!-- beautify ignore:start -->
<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="{{ asset('../assets') }}/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Magang Log</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('../assets') }}/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('../assets') }}/vendor/fonts/boxicons.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('../assets') }}/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('../assets') }}/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('../assets') }}/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('../assets') }}/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <link rel="stylesheet" href="{{ asset('../assets') }}/vendor/libs/apex-charts/apex-charts.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{ asset('../assets') }}/vendor/js/helpers.js"></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar/index.global.min.js'></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('../assets') }}/js/config.js"></script>
  </head>
<style>
  @import url("https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css");
</style>
  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
            <a href="index.html" class="app-brand-link">
              <span class="app-brand-logo demo">
                <img src="{{ asset('assets') }}\img\LOGO4A.png" alt="Magang Log Logo" width="25">
              </span>
              <span class="app-brand-text demo menu-text fw-bolder ms-2">Magang Log</span>
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
            <!-- Dashboard -->
            <li class="menu-item {{ request()->is('home') ? 'active' : '' }}">
              <a href="/home" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Beranda</div>
              </a>
            </li>

            @if (Auth::user()->role_id == 2)
<li class="menu-item {{ request()->is('users') ? 'active' : '' }}">
                    <li class="menu-item {{ request()->is('users/create') ? 'active' : '' }}">
              <a href="/users" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Buat Akun</div>
              </a>
            </li>
            <li class="menu-item {{ request()->is('kriteria-penilaian*') ? 'active' : '' }}">
              <a href= "{{ route('kriteria-penilaian.index') }}" class="menu-link">
              <i class="menu-icon tf-icons bx bx-home-circle"></i>
              <div data-i18n="Analytics">Kriteria Penilaian</div>
              </a>
            </li>
            <li class="menu-item {{ request()->is('') ? 'active' : '' }}">
              <a href="/settings_magang" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Setting</div>
              </a>
            </li>
@endif

          @if (Auth::user()->role_id == 4)
<li class="menu-item {{ request()->is('dosen/rekap_logbook*') || request()->is('dosen/detail_rekap_logbook*') ? 'active' : '' }}">
              <a href="{{ route('dosen.rekap_logbook.index') }}" class="menu-link">
                  <i class="menu-icon tf-icons bx bx-home-circle"></i>
                  <div data-i18n="Analytics">Rekap Logbook</div>
              </a>
          </li>
          <li class="menu-item {{ request()->is('dosen/laporan_akhir*') || request()->is('dosen/laporan_akhir') ? 'active' : '' }}">
              <a href= "{{ route('dosen.laporan_akhir.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Laporan Akhir</div>
              </a>
          </li>
            
          <li class="menu-item {{ request()->is('dosen/riwayat*') ? 'active' : '' }}">
              <a href= "{{ route('riwayat.index') }}" class="menu-link">
              <i class="menu-icon tf-icons bx bx-home-circle"></i>
              <div data-i18n="Analytics">Riwayat</div>
              </a>
          </li>
@endif

@if (Auth::User()->role_id == 1)
<li class="menu-item {{ request()->is('job') ? 'active' : '' }}">
          <a href= "{{ route('jobdescs.index') }}" class="menu-link">
          <i class="menu-icon tf-icons bx bx-home-circle"></i>
          <div data-i18n="Analytics">Jobdesc</div>
          </a>
          </li>
<li class="menu-item {{ request()->is('mahasiswa/logbook*') ? 'active' : '' }}">
              <a href= "{{ route('mahasiswa.logbook.index') }}" class="menu-link">
              <i class="menu-icon tf-icons bx bx-home-circle"></i>
              <div data-i18n="Analytics">Logbook</div>
              </a>
          </li>
          <li class="menu-item {{ request()->is('mahasiswa/laporan_akhir*') ? 'active' : '' }}">
            <a href= "{{ route('mahasiswa.laporan_akhir.index') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-home-circle"></i>
            <div data-i18n="Analytics">Laporan Akhir</div>
            </a>
          </li>
          <li class="menu-item {{ request()->is('mahasiswa/nilaimagang') ? 'active' : '' }}">
            <a href= "{{ route('mahasiswa.nilai_magang.index') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-home-circle"></i>
            <div data-i18n="Analytics">Nilai Magang</div>
            </a>
          </li>
@endif

          @if (Auth::user()->role_id == 3)
<li class="menu-item {{ request()->is('mitra/logbook*') ? 'active' : '' }}">
            <a href= "{{ route('mitra.logbook.index') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-home-circle"></i>
            <div data-i18n="Analytics">Logbook</div>
          </a>
          <li class="menu-item {{ request()->is('job*') ? 'active' : '' }}">
            <a href= "{{ route('jobdescs.index') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-home-circle"></i>
            <div data-i18n="Analytics">Jobdesc</div>
            </a>
          </li>
@endif

@if (Auth::user()->role_id == 4 || Auth::user()->role_id == 3)
<li class="menu-item {{ request()->is('penilaian*') ? 'active' : '' }}">
  <a href= "{{ route('penilaian.index') }}" class="menu-link">
  <i class="menu-icon tf-icons bx bx-home-circle"></i>
  <div data-i18n="Analytics"> Penilaian</div>
</a>
  </li>
@endif
          
            
            <li class="menu-item fixed-bottom ">
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="" class="menu-link">

                    <button type="submit" class="btn btn-primary">
                        <i class="menu-icon tf-icons bx bx-home-circle"></i> Logout</button>
                </a>
            </form>
            </li>
          </ul>
        </aside>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

          <nav
            class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
            id="layout-navbar"
          >
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
              </a>
            </div>

            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
           

              <ul class="navbar-nav flex-row align-items-center ms-auto">
                <!-- Place this tag where you want the button to render. -->

                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <a class="nav-link dropdown-toggle hide-arrow d-flex align-items-center" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <span class="mx-2">{{ Auth::user()->name }}</span>
                    <div class="avatar avatar-online">
                      @if (Auth::user()->mahasiswa)
<img src="{{ asset('images/' . Auth::user()->mahasiswa->gambar) }}" alt="Gambar Mahasiswa" style="border-radius: 50%; width: 40px; height: 40px;">
@elseif (Auth::user()->dosen)
<img src="{{ asset('images/' . Auth::user()->dosen->gambar) }}" alt="{{ Auth::user()->dosen->gambar }}" style="border-radius: 50%; width: 40px; height: 40px;">
@else
<img src="https://www.shutterstock.com/image-vector/default-avatar-profile-icon-social-600nw-1677509740.jpg" alt="Gambar Default" style="border-radius: 50%; width: 40px; height: 40px;">
@endif
                  </div>
                  
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                      <li>
                          <a class="dropdown-item" href="{{ route('mahasiswa.profil') }}">
                              <i class="bx bx-user me-2"></i>
                              <span class="align-middle">My Profile</span>
                          </a>
                      </li>
                  </ul>
              </li>
                <!--/ User -->
              </ul>
            </div>
          </nav>

          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <div class="container">

                @yield('content')
            </div>
            
            </div>
            <!-- / Content -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->


    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('../assets') }}/vendor/libs/jquery/jquery.js"></script>
    <script src="{{ asset('../assets') }}/vendor/libs/popper/popper.js"></script>
    <script src="{{ asset('../assets') }}/vendor/js/bootstrap.js"></script>
    <script src="{{ asset('../assets') }}/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="{{ asset('../assets') }}/vendor/js/menu.js"></script>
    <!-- endbuild -->
@yield('scripts')
    <!-- Vendors JS -->
    <script src="{{ asset('../assets') }}/vendor/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="{{ asset('../assets') }}/js/main.js"></script>

    <!-- Page JS -->
    <script src="{{ asset('../assets') }}/js/dashboards-analytics.js"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
</html>
