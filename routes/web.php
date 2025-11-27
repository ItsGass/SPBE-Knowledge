<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController; 
use App\Http\Controllers\ProfileController; 
use App\Http\Controllers\AdminManagementController; 
use App\Http\Controllers\KnowledgeController; 


/*
|--------------------------------------------------------------------------
| ROUTE HALAMAN UTAMA (PUBLIK)
|--------------------------------------------------------------------------
*/
Route::get('/', [DashboardController::class, 'index'])->name('home');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');



/*
|--------------------------------------------------------------------------
| ROUTE KNOWLEDGE PUBLIK (Index & Show)
| — Guest & User bisa lihat data
|--------------------------------------------------------------------------
*/
Route::get('knowledge', [KnowledgeController::class, 'index'])
     ->name('knowledge.index');

Route::get('knowledge/{knowledge}', [KnowledgeController::class, 'show'])
     ->name('knowledge.show');



/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.process');

Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.process');



/*
|--------------------------------------------------------------------------
| ROUTE YANG MEMBUTUHKAN LOGIN
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // Logout
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Profile
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('/profile/update', [ProfileController::class, 'updateProfile'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');


    /*
    |--------------------------------------------------------------------------
    | ROUTE MANAJEMEN KNOWLEDGE (WRITE: hanya admin/superadmin)
    |--------------------------------------------------------------------------
    |
    | Resource digunakan untuk method create, store, edit, update, destroy
    | dan TIDAK akan override route publik (index, show)
    |
    */
    Route::middleware('role:superadmin,admin')->group(function () {

        Route::resource('knowledge', KnowledgeController::class)
            ->only(['create', 'store', 'edit', 'update', 'destroy'])
            ->names('knowledge');

    });


    /*
    |--------------------------------------------------------------------------
    | ROUTE MANAJEMEN ADMIN (write: admin & superadmin)
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:superadmin,admin')->group(function () {

        // semua kecuali destroy
        Route::resource('admin', AdminManagementController::class)
            ->except(['destroy'])
            ->names('admin');

        // destroy khusus superadmin
        Route::delete('admin/{admin}', [AdminManagementController::class, 'destroy'])
            ->middleware('role:superadmin')
            ->name('admin.destroy');
    });
});
