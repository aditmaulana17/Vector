@extends('layouts.mantis') <!-- Sesuaikan dengan nama master layout template kamu -->

@section('content')
<div class="container-fluid px-4 py-4">
    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-8">
            <div class="card border-0 shadow-sm overflow-hidden">
                <!-- Header Kartu dengan background gradasi -->
                <div class="bg-gradient bg-primary p-4 text-white text-center position-relative" style="height: 140px;">
                    <h4 class="fw-bold mb-0 pt-2">Profil Pengguna</h4>
                </div>
                
                <!-- Isi Konten Profil -->
                <div class="card-body px-4 pb-4 text-center position-relative" style="margin-top: -60px;">
                    <!-- Avatar Foto Profil -->
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=0D6EFD&color=fff&size=128" 
                         class="rounded-circle img-thumbnail shadow-sm mb-3 bg-white" alt="User Avatar" style="width: 120px; height: 120px;">
                    
                    <h3 class="fw-bold mb-1">{{ $user->name }}</h3>
                    <p class="text-muted mb-3">{{ $user->email }}</p>
                    
                    <span class="badge bg-light text-primary text-capitalize px-3 py-2 border border-primary fs-6 mb-4">
                        Role: {{ $user->role->role_name ?? 'Pegawai' }}
                    </span>

                    <!-- Detail Informasi Akun dalam bentuk tabel bersih -->
                    <div class="text-start border rounded-3 p-3 bg-light mt-2">
                        <div class="row py-2 border-bottom g-0">
                            <div class="col-4 fw-semibold text-muted">ID Pengguna</div>
                            <div class="col-8">: {{ $user->id }}</div>
                        </div>
                        <div class="row py-2 border-bottom g-0">
                            <div class="col-4 fw-semibold text-muted">Nama Lengkap</div>
                            <div class="col-8">: {{ $user->name }}</div>
                        </div>
                        <div class="row py-2 border-bottom g-0">
                            <div class="col-4 fw-semibold text-muted">Email Sistem</div>
                            <div class="col-8">: {{ $user->email }}</div>
                        </div>
                        <div class="row py-2 g-0">
                            <div class="col-4 fw-semibold text-muted">Dibuat Pada</div>
                            <div class="col-8">: {{ $user->created_at ? $user->created_at->format('d M Y') : '-' }}</div>
                        </div>
                    </div>

                    <!-- Tombol Aksi di bagian bawah -->
                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('home') }}" class="btn btn-outline-secondary px-4">
                            <i class="ti ti-arrow-left"></i> Kembali ke Dashboard
                        </a>
                        <a href="{{ route('profile.edit') }}" class="btn btn-primary px-4">
                            <i class="ti ti-edit"></i> Edit Profil
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection