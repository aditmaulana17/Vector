@extends('layouts.mantis') {{-- Sesuaikan dengan nama file layout utama Anda --}}

@section('content')
<div class="">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title">Data Pegawai</h4>
            <div>
                <a href="{{ route('pegawai.create') }}" class="btn btn-primary">
                    Tambah Data
                </a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped" id="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pegawai</th> 
                        <th>Bagian</th>
                        <th>Email</th>
                         <th>NIK</th>
                        <th>Jenis Kelamin</th>
                        <th>Umur</th>
                        <th>Tempat Tanggal Lahir</th>
                        <th>Alamat</th>
                        <th>Foto Pegawai</th>
                        <th class="text-center">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pegawai as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->nama_pegawai }}</td>
                        <td>{{ $item->bagian?->nama_bagian }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->nik }}</td>
                        <td>{{ $item->jenis_kelamin }}</td>
                        <td>{{ $item->umur }}</td>
                        <td>
                            {{ $item->tempat_lahir }}, 
                            {{ \Carbon\Carbon::parse($item->tanggal_lahir)->locale('id')->translatedFormat('d F Y') }}
                        </td>
                        <td>{{ $item->alamat }}</td>
                        <td>
                             <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalFoto{{ $item->id }}">
                             Lihat Foto
                             </button>
                        </td>
                        <td>
                            <div class="dropdown">
                            <a class="btn btn-primary btn-sm dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                             Aksi
                            </a>

                            <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('pegawai.edit', $item->id) }}">Edit</a></li>
                            <li>
                                <button type="button" class="dropdown-item text-danger" data-bs-toggle="modal"
                                 data-bs-target="#confirmDeleteModal{{ $item->id }}">
                                 Delete data
                                </button>
                            </li>
                                 </ul>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


{{-- Modal Konfirmasi Hapus --}}
@foreach ($pegawai as $item)
<div class="modal fade" id="confirmDeleteModal{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" 
    aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Lanjutkan penghapusan Data?</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Data akan terhapus secara permanen. Klik <b>Lanjutkan</b> untuk menghapus data.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <form action="{{ route('pegawai.destroy', $item->id) }}" method="POST" >
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Lanjutkan</button>
            </form>
      </div>
    </div>
  </div>
</div>
@endforeach


{{-- Modal Lihat Foto --}}
@foreach ($pegawai as $item)
<div class="modal fade" id="modalFoto{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Foto Pegawai: {{ $item->nama_pegawai }}</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
        @if (!empty($item->foto))
            <img src="{{ asset('storage/foto_pegawai/' . $item->foto) }}" alt="Foto {{ $item->nama_pegawai }}" class="img-fluid rounded" style="max-height: 400px;">
        @else
            <p class="text-muted mb-0">Foto belum diunggah.</p>
        @endif
      </div>
    </div>
  </div>
</div>
@endforeach

@endsection