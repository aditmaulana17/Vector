@extends('layouts.mantis')
@section('content')
    <div class="card">
        <div class="d-flex justify-content-between mb-3">
    <h3>Data Bagian</h3>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahBagian">
        Tambah Bagian
    </button>
</div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Bagian</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bagians as $index => $bagian)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $bagian->nama_bagian }}</td>
                            <td>
                                <a href="{{ route('bagian.show', $bagian->id) }}"class="btn btn-primary">Detail</a>
                                <a href="{{ route('bagian.destroy', $bagian->id) }}"class="btn btn-danger" data-confirm-delete="true">Hapus</a>
                            </td>
                            <td>
                                <div class="modal fade" id="modalTambahBagian" tabindex="-1" aria-labelledby="modalTambahBagianLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                     <div class="modal-content">
                                           <div class="modal-header">
                                                  <h5 class="modal-title" id="modalTambahBagianLabel">Tambah Data Bagian Baru</h5>
                                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                          <form action="{{ route('bagian.store') }}" method="POST">
                                           @csrf
                                        <div class="modal-body">
                                        <div class="mb-3">
                                        <label for="nama_bagian" class="form-label">Nama Bagian</label>
                                        <input type="text" class="form-control" id="nama_bagian" name="nama_bagian" required placeholder="Contoh: pemasaran, HRD">
                                        </div>
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                                         </div>
                                                    </form>
                                             </div>
                                      </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection