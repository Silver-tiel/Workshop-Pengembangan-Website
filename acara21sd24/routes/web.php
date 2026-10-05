<?php
use App\Http\Controllers\ManualAuthenticationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');

Route::get('/my-profile', [AuthController::class, 'showProfile'])->name('profile.show');

Route::middleware('auth')->group(function () {
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/{post}/gate-edit', [PostController::class, 'editWithGate'])->name('posts.gate-edit');
    Route::get('/posts/{post}/policy-edit', [PostController::class, 'editWithPolicy'])->name('posts.policy-edit');
    Route::get('/posts/{post}/middleware-edit', [PostController::class, 'edit'])
        ->middleware('can:update,post')
        ->name('posts.middleware-edit');
    Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
});

Route::middleware('guest')->prefix('manual')->name('manual.')->group(function () {
    Route::get('/login', [ManualAuthenticationController::class, 'createLogin'])->name('login');
    Route::post('/login', [ManualAuthenticationController::class, 'login'])->name('login.store');
    Route::get('/register', [ManualAuthenticationController::class, 'createRegister'])->name('register');
    Route::post('/register', [ManualAuthenticationController::class, 'register'])->name('register.store');
});
Route::post('/manual/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('manual.logout');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
require __DIR__.'/auth.php';
