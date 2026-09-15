@extends('layouts.mantis')
@section('content')
    <div class="container-fluid px-4 py-4">
    <div class="row">
        <div class="col-12 col-lg-4 mb-4">
            <div class="card border-0 shadow-sm text-center p-4">
                <div class="card-body">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=0D6EFD&color=fff&size=128" 
                         class="rounded-circle img-thumbnail mb-3" alt="User Avatar" style="width: 120px; height: 120px;">
                    <h4 class="fw-bold mb-1">{{ $user->name }}</h4>
                    <p class="text-muted small mb-3">{{ $user->email }}</p>
                    <span class="badge bg-light text-primary text-capitalize px-3 py-2 border border-primary">
                        {{ $user->role->role_name ?? 'Pegawai' }}
                    </span>
                </div>
                 <a href="{{ route('home') }}" class="btn btn-primary">
                    Kembali
                </a>
            </div>
        </div>

        <div class="col-12 col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-transparent border-0 pt-4 px-4">
                    <h5 class="fw-bold mb-0">Pengaturan Profil</h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row g-3">
                            <div class="col-12 col-md-6">
                                <label class="form-label fw-semibold">Nama Lengkap</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12 col-md-6">
                                <label class="form-label fw-semibold">Alamat Email</label>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <hr class="my-4 text-muted">
                            <p class="text-warning small fw-bold mb-2"><i class="ti ti-info-circle"></i> Kosongkan password di bawah ini jika tidak ingin mengubahnya.</p>

                            <div class="col-12 col-md-6">
                                <label class="form-label fw-semibold">Password Baru</label>
                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Minimal 8 karakter">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12 col-md-6">
                                <label class="form-label fw-semibold">Konfirmasi Password Baru</label>
                                <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi password baru">
                            </div>

                            <div class="col-12 text-end mt-4">
                                <button type="submit" class="btn btn-primary px-4 py-2">
                                    <i class="ti ti-device-floppy"></i> Simpan Perubahan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection