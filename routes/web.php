<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BagianController;
use App\Http\Controllers\ProfileController;


Route::get('/', function () {
    return view('Auth.login');
});

Auth::routes();

Route::fallback(function () {
    return view('404');
});


Route::middleware('auth')->group(function () {

    // =====================================
    // Semua user yang sudah login
    // Admin, Supervisor, Pegawai
    // =====================================

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
        ->name('home');

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');


    // Profile semua role
    Route::get('/profile', [ProfileController::class, 'show'])
        ->name('profile.show');

    Route::get('/profile/edit', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::put('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');



    // =====================================
    // ADMIN SAJA
    // role_id = 2
    //
    // Bisa:
    // - Data User
    // - Data Bagian
    // - Data Pegawai
    // =====================================

    Route::middleware('role:2')->group(function () {

        Route::resource('users', UserController::class);

        Route::post(
            'user-update-role',
            [UserController::class, 'updateRole']
        )->name('user.update-role');
    });

        Route::middleware('role:2,1')->group(function () {
        Route::resource('bagian', BagianController::class);

    });



    // =====================================
    // ADMIN + SUPERVISOR
    // role_id = 2 dan 1
    //
    // Bisa:
    // - Data Pegawai
    // =====================================

    Route::middleware('role:2,1')->group(function () {

        Route::resource('pegawai', PegawaiController::class);

    });



    // =====================================
    // PEGAWAI
    // role_id = 3
    //
    // Tidak ada akses CRUD
    // hanya dashboard/profile
    // =====================================

});
