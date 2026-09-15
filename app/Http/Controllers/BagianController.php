<?php

namespace App\Http\Controllers;

use App\Models\Bagian;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class BagianController extends Controller
{
    public function index(){
        $bagians = Bagian::all();
         $title = 'Konfirmasi Hapus Data Bagian';
        $text = "Data akan dihapus secara permanen, Lanjutkan?";
        confirmDelete($title, $text);
        return view('bagian.index', compact('bagians'));
    }

    public function show(String $id) {
        $bagian = Bagian::find($id);
        return view('bagian.show', compact('bagian'));
}

    public function destroy(String $id){
        $bagian =  Bagian::find($id);
        $bagian->delete();

        Alert::success('Berhasil', 'Data berhasil dihapus.');
        return redirect()->route('bagian.index');
    }

    public function store(Request $request)
{
    // 1. Validasi input agar nama bagian wajib diisi
    $request->validate([
        'nama_bagian' => 'required|string|max:255',
    ]);

    // 2. Simpan ke database (sesuaikan nama kolom di database Anda, misal: 'nama_bagian')
    Bagian::create([
        'nama_bagian' => $request->nama_bagian
    ]);

    // 3. Kembali ke halaman data bagian dengan pesan sukses
    return redirect()->route('bagian.index')->with('success', 'Data bagian berhasil ditambahkan!');
}
}
