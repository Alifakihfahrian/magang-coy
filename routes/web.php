<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangControllerDB;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ManageUsersController;
use App\Http\Controllers\StokController;

    // Home Route
Route::get('/home', [HomeController::class, 'index'])->name('home.index');

// Routes for guests (not logged in)
Route::middleware(['guest'])->group(function() {
    // Register Routes
    Route::get('/register', [RegisterController::class, 'show'])->name('register.show');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.perform');
    Route::get('/login', [RegisterController::class, 'showLoginForm'])->name('login');

    // Login Routes
    Route::get('/login', [LoginController::class, 'show'])->name('login.show');
    Route::post('/login', [LoginController::class, 'login'])->name('login.perform');
    Route::get('/login', [LoginController::class, 'show'])->name('login');
});

// Routes for authenticated users
Route::middleware(['auth'])->group(function() {
    // Logout Route
    Route::get('/logout', [LogoutController::class, 'perform'])->name('logout.perform');

    // View for layouts (replace this with actual routes you need)
    Route::get('/layouts', function () {
        return view('layouts');
    })->name('layouts.view');
    // ManageUsers
    Route::resource('users', ManageUsersController::class);
    Route::get('/ManageUsers', function (){   
        return view('layouts.ManageUsers');}
     )->name('ManageUsers');
    // Dashboard
    Route::get('/dashboard', function (){   
        return view('layouts.index');}
     )->name('index');
     Route::get('/ManageUsers', [ManageUsersController::class, 'navbar'])->name('navbar');
     Route::get('/users', [ManageUsersController::class, 'index'])->name('ManageUsers');
});

    //Routes for posts
    Route::get('/posts', [BarangController::class, 'index'])->name('posts.index');
    Route::get('/posts/create', [BarangController::class, 'create'])->name('posts.create');
    Route::post('/posts', [BarangController::class, 'store'])->name('posts.store');
    Route::get('/posts/{post}/edit', [BarangController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{post}', [BarangController::class, 'update'])->name('posts.update');
    Route::get('/posts/{post}', [BarangController::class, 'show'])->name('posts.show');
    Route::delete('/posts/{post}', [BarangController::class, 'destroy'])->name('posts.destroy');

    //Routes for barangs
    Route::resource('barangs', BarangControllerDB::class);
    Route::get('/barangs', [BarangController::class, 'index'])->name('barangs.index');  // Menampilkan daftar barang
    Route::get('/barangs/create', [BarangController::class, 'create'])->name('barangs.create');  // Menampilkan form pembuatan barang
    Route::post('/barangs', [BarangController::class, 'store'])->name('barangs.store');  // Menyimpan barang baru
    Route::get('/barangs/{barang}', [BarangController::class, 'show'])->name('barangs.show');  // Menampilkan detail barang
    Route::get('/barangs/{barang}/edit', [BarangController::class, 'edit'])->name('barangs.edit');  // Menampilkan form edit barang
    Route::put('/barangs/{barang}', [BarangController::class, 'update'])->name('barangs.update');  // Memperbarui barang
    Route::delete('/barangs/{barang}', [BarangController::class, 'destroy'])->name('barangs.destroy');  // Menghapus barang
    Route::get('/stok/{id}/edit', [StokController::class, 'edit'])->name('stok.edit');
    Route::post('/stok/{id}/update', [StokController::class, 'update'])->name('stok.update');
    
Route::get('/', [BarangController::class, 'index'])->name('home');