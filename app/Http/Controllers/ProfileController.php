<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert; // Pastikan pakai library alert kamu jika ada

class ProfileController extends Controller
{
    // Menampilkan halaman View & Edit Profil jadi satu biar praktis
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    // Memproses perubahan data profil & password
    public function update(Request $request)
    {
        // 1. Ambil data user yang sedang login terlebih dahulu
        $user = Auth::user();

        // Validasi inputan
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // Update nama dan email
        $user->name = $request->name;
        $user->email = $request->email;

        // Jika user mengisi password baru, maka ganti passwordnya
        if ($request->filled('password')) {
            $user->password = \Illuminate\Support\Facades\Hash::make($request->password);
        }

        // Gunakan huruf kecil '$user' bukan '$User'
        \App\Models\User::where('id', $user->id)->update([
        'name' => $user->name,
        'email' => $user->email,
        'password' => $user->password,
    ]);

        \RealRashid\SweetAlert\Facades\Alert::success('Berhasil', 'Profil Anda telah diperbarui!');
        return redirect()->route('home');
    }

    public function show()
{
    $user = Auth::user();
    return view('profile.show', compact('user'));
}
}