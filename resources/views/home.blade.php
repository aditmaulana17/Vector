@extends('layouts.mantis')

@section('content')
<div class="container-fluid px-4">
    <!-- 1. Jumbotron/Banner Sambutan yang Kreatif -->
    <div class="card border-0 shadow-sm bg-gradient bg-secondary text-white mb-4">
        <div class="card-body p-4 p-md-5">
            <h2 class="fw-bold display-6 mb-2">Halo, {{ Auth::user()->name }}! 👋</h2>
           <p class="fs-5 mb-3 opacity-75">
            Anda login sebagai: 
            @if(Auth::user()->role_id == 2)
            <span class="badge bg-danger text-white fs-6 px-3 py-2 shadow-sm fw-semibold">Admin</span>
            @elseif(Auth::user()->role_id == 1)
            <span class="badge bg-warning text-dark fs-6 px-3 py-2 shadow-sm fw-semibold">Supervisor</span>
            @else
        <!-- Jika role_id selain 1 dan 2 (Pegawai) -->
            <span class="badge bg-success text-white fs-6 px-3 py-2 shadow-sm fw-semibold">Pegawai</span>
             @endif
                </p>
            <div class="border-top border-light opacity-25 my-3"></div>
            <p class="lead mb-0">Selamat datang kembali di Aplikasi Manajemen Pegawai. Kelola data hari ini dengan mudah.</p>
        </div>
    </div>

    <!-- 2. Baris Grid untuk Kartu Statistik (Widget) -->
    <div class="row g-4">
        <!-- Kartu 1: Total Pegawai -->
        <div class="col-12 col-md-6 col-lg-4">
            <div class="card border-0 shadow-sm h-100 border-start border-4 border-info">
                <div class="card-body p-4 d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="text-muted text-uppercase small fw-bold mb-1">Total Pegawai</h6>
                        <span class="h3 fw-bold mb-0">15</span> <!-- Ganti dengan data dinamis jika ada -->
                    </div>
                    <div class="bg-info bg-opacity-10 text-info p-3 rounded-3">
                        <i class="ti ti-users fs-3"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kartu 2: Total Bagian/Divisi -->
        <div class="col-12 col-md-6 col-lg-4">
            <div class="card border-0 shadow-sm h-100 border-start border-4 border-success">
                <div class="card-body p-4 d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="text-muted text-uppercase small fw-bold mb-1">Total Bagian</h6>
                        <span class="h3 fw-bold mb-0">7</span> <!-- Ganti dengan data dinamis jika ada -->
                    </div>
                    <div class="bg-success bg-opacity-10 text-success p-3 rounded-3">
                        <i class="ti ti-briefcase fs-3"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kartu 3: Pengguna Sistem -->
        <div class="col-12 col-md-6 col-lg-4">
            <div class="card border-0 shadow-sm h-100 border-start border-4 border-warning">
                <div class="card-body p-4 d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="text-muted text-uppercase small fw-bold mb-1">Pengguna Aktif</h6>
                        <span class="h3 fw-bold mb-0">15</span> <!-- Ganti dengan data dinamis jika ada -->
                    </div>
                    <div class="bg-warning bg-opacity-10 text-warning p-3 rounded-3">
                        <i class="ti ti-user-check fs-3"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
