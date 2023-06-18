<?php

use App\Http\Controllers\Web\AlurController;
use App\Http\Controllers\Web\EditProfileController;
use App\Http\Controllers\Web\InvoicesController;
use App\Http\Controllers\Web\LaporanController;
use App\Http\Controllers\Web\LayananController;
use App\Http\Controllers\Web\LoginController;
use App\Http\Controllers\Web\LoketController;
use App\Http\Controllers\Web\ProfileController;
use App\Http\Controllers\Web\QuotationsController;
use App\Http\Controllers\Web\UmumController;
use App\Http\Controllers\Web\UploadController;
use App\Http\Controllers\Web\UsersController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/', function () {

    // redirect to dashboard
    return redirect('/dashboard');
});

// route group for middleware web

// login
Route::get('/login', [LoginController::class, 'index'])->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

// Route::get('/login', [LoginController::class, 'index'])->Auth::guest();

// // Route::get('/login', [LoginController::class, 'index'])->middleware('guest');
// Route::post('/login', [LoginController::class, 'authenticate']);

// Route::get('/', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
// route group middle ware auth
Route::get('/invoice-print', function () {
    // return html view
    return view('sales/invoice-print');
});

Route::get('/downloadpdf', function () {
    // return html view
    return view('sales/invoice-print');
});
Route::get('/view_invoice/{vtoken}', [InvoicesController::class, 'view']);
Route::get('/view_quotation/{vtoken}', [QuotationsController::class, 'view']);
Route::post('/uploadImage', [UploadController::class, 'store']);
Route::delete('/deleteImage', [UploadController::class, 'destroy']);

Route::group([
    'middleware' => 'auth',
], function ($router) {
    Route::get('/dashboard', function () {
        return view('dashboard', ['title' => 'Dashboard']);
    });

    Route::get('/lihat_antrean', function () {
        return view(
            'lihat_antrean/lihat_antrean',
            [
                'title' => 'Live Antrean',
            ]
        );
    });
    // Konfigurasi
    Route::get('/konfigurasi/layanan', [LayananController::class, 'index']);
    Route::get('/konfigurasi/loket', [LoketController::class, 'index']);
    Route::get('/konfigurasi/umum', [UmumController::class, 'index']);
    Route::get('/konfigurasi/alur', [AlurController::class, 'index'])->name('alur');

    // Users
    Route::get('/users', [UsersController::class, 'index']);
    // delete user
    Route::delete('/users/{id}', [UsersController::class, 'destroy']);

    // laporan
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan');



    // Edit Profile
    Route::get('/profile_saya/edit_profile', [EditProfileController::class, 'show']);

    // My Profile
    Route::get('/edit_profile', [ProfileController::class, 'show']);
});

// Upload image
// Route::controller(ImageController::class)->group(function () {
//     Route::get('/image', 'index');
//     Route::post('/submit', 'store')->name('submitImage');
// });
// Route::controller(UploadController::class)->group(function () {
//     Route::post('/upload', 'store')->name('upload');
//     Route::delete('/hapus', 'destroy')->name('hapus');
// });
