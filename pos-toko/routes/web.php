<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified']);

Route::get('/profile', function () {
    return view('profile');
})->middleware(['auth']);

// ── Acara 21: Middleware ─────────────────────────────────────────────
// Skenario 3: Login Admin → halaman tampil ✅
// Skenario 2: Login Non-Admin → 403 🚫
// Skenario 1: Belum login → redirect /login 🔀
Route::get('/admin', function () {
    return view('admin.index');
})->middleware('admin');

// Middleware dengan parameter (CekRole)
Route::get('/admin-role', function () {
    return view('admin.index');
})->middleware('cek.role:admin');

Route::get('/petugas', function () {
    return view('petugas.index');
})->middleware('petugas');

Route::get('/siswa', function () {
    return view('siswa.index');
})->middleware('siswa');

require __DIR__.'/auth.php';

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (Request $request, $id, $hash) {
    $request->fulfill();

    return redirect('/dashboard');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/resend', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.resend');