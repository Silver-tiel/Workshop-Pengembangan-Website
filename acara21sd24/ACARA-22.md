# Acara 22 — Authentication (Part 1)

Materi ini menggunakan Laravel 12, Breeze dengan Blade, dan Sanctum untuk API token. Breeze dan Sanctum sudah/akan dipasang pada proyek ini, tetapi perintah terminal di bagian **Perintah yang perlu dijalankan** sengaja tidak dijalankan oleh penyusun materi. Jalankan sendiri sesuai urutan, lalu kerjakan latihan dan simpan screenshot.

## 1. Breeze: autentikasi siap pakai

Breeze adalah starter kit ringan yang menyediakan halaman dan alur autentikasi: register, login, logout, reset password, dan verifikasi email. Di proyek ini, halaman Breeze berada di `resources/views/auth/`, controller autentikasinya di `app/Http/Controllers/Auth/`, dan route tambahannya di `routes/auth.php`.

Jalankan perintah instalasi hanya jika Breeze belum dipasang. Proyek ini sudah memiliki Breeze dan file-file yang dihasilkan Breeze; mengulang installer bisa mengubah berkas yang ada. Untuk Laravel 12, pilih Blade saat installer menanyakan stack.

```powershell
composer require laravel/breeze --dev
php artisan breeze:install
php artisan migrate
npm install
npm run dev
php artisan serve
```

`npm install` memasang dependensi frontend yang terdaftar di `package.json`. `npm run dev` menjalankan Vite agar aset CSS/JavaScript tersedia selama pengembangan. Biarkan proses Vite berjalan, dan gunakan terminal lain untuk `php artisan serve`.

Reset password sudah disediakan Breeze. `php artisan make:auth` sudah tidak tersedia sejak Laravel 6, jadi jangan jalankan perintah tersebut.

### Uji Breeze dan screenshot

Gunakan `/register`, `/login`, dan `/forgot-password`. Coba daftar akun, login, logout, lalu minta tautan reset password. Simpan screenshot:

- Form register dan hasil setelah mendaftar.
- Form login dan kondisi setelah login/logout.
- Form lupa password dan pesan bahwa tautan reset diminta.

Jangan masukkan password atau token yang masih berlaku ke screenshot. Pada proyek ini kolom `users.role` wajib diisi; registrasi Breeze sudah memberi nilai default `user` di sisi server. Jangan menambahkan pilihan role yang dapat diisi pengguna pada form pendaftaran.

## 2. Guards dan Providers

**Guard** menentukan bagaimana Laravel mengautentikasi permintaan. **Provider** menentukan dari mana Laravel mencari data pengguna.

- `session`: guard web yang menyimpan identitas login pada session/cookie browser. Ini adalah guard default Breeze (`web`).
- `token`: guard bearer token sederhana bawaan Laravel. Ini bukan Sanctum dan tidak memberi manajemen token yang sama.
- `sanctum`: guard yang disediakan package Sanctum. Dapat mengautentikasi token API personal dan, bila dikonfigurasi untuk SPA, session/cookie stateful.
- `Passport`: package OAuth2 Laravel untuk kebutuhan OAuth seperti authorization server dan access token OAuth. Bukan nama guard bawaan yang tersedia tanpa memasang serta mengonfigurasi package Passport.
- `eloquent`: provider yang memuat pengguna melalui model Eloquent, biasanya `App\Models\User`.
- `database`: provider yang membaca tabel pengguna secara langsung melalui query builder.

Potongan konfigurasi aktif pada `config/auth.php`:

```php
'defaults' => [
    'guard' => env('AUTH_GUARD', 'web'),
    'passwords' => env('AUTH_PASSWORD_BROKER', 'users'),
],

'guards' => [
    'web' => [
        'driver' => 'session',
        'provider' => 'users',
    ],
],

'providers' => [
    'users' => [
        'driver' => 'eloquent',
        'model' => env('AUTH_MODEL', App\Models\User::class),
    ],

    // Alternatif database:
    // 'users' => [
    //     'driver' => 'database',
    //     'table' => 'users',
    // ],
],
```

Guard session memakai provider `users`; provider Eloquent menghubungkannya ke model `User`. Pengaturan Sanctum ditambahkan oleh instalasi Sanctum dan dipakai melalui middleware `auth:sanctum`, tidak dengan mengganti guard web Breeze.

## 3. Jetstream (teori saja)

Jetstream adalah starter kit lebih lengkap daripada Breeze, dengan fitur opsional seperti manajemen sesi browser, autentikasi dua faktor, dan tim. Dapat menggunakan Livewire atau Inertia. Pilih Breeze **atau** Jetstream untuk satu proyek; jangan memasang Jetstream ke proyek latihan yang sudah memakai Breeze.

Perintah berikut hanya untuk proyek terpisah yang belum menggunakan Breeze; jangan jalankan di proyek ini:

```powershell
composer require laravel/jetstream
php artisan jetstream:install livewire
```

## 4. Latihan autentikasi manual

Contoh latihan sudah tersedia pada URL terpisah supaya tidak mengambil alih `/login` dan `/register` milik Breeze:

- `GET /manual/login` dan `POST /manual/login`
- `GET /manual/register` dan `POST /manual/register`
- `POST /manual/logout` (wajib login)

Lihat `app/Http/Controllers/ManualAuthenticationController.php`, `routes/web.php`, serta dua view di `resources/views/manual-auth/`.

Inti login:

```php
if (! Auth::attempt($credentials, $request->boolean('remember'))) {
    return back()->withErrors(['email' => 'Email atau password tidak cocok.']);
}

$request->session()->regenerate();
```

`Auth::attempt()` memeriksa kredensial menggunakan provider aktif. Regenerasi session setelah sukses mengurangi risiko session fixation.

Inti register: validasi nama/email/password, pastikan email unik dan password terkonfirmasi, lalu simpan pengguna. Tetapkan `role` default di server (`user`), bukan dari input form. `event(new Registered($user))` memicu email verifikasi karena model mengimplementasikan `MustVerifyEmail`. Setelah itu `Auth::login($user)` memasukkan akun baru ke sesi.

Inti logout:

```php
Auth::logout();
$request->session()->invalidate();
$request->session()->regenerateToken();
```

Form POST web harus menyertakan `@csrf`. Uji login dengan kredensial salah, register dengan password tidak cocok, akses route terlindungi sebagai guest, dan logout.

## 5. Sanctum: API bearer token

Sanctum menyediakan personal access token. Proyek sudah disiapkan dengan `HasApiTokens` pada model `User`, route API, dan controller untuk login token. Route API terdapat di `routes/api.php`; routing file API didaftarkan pada `bootstrap/app.php`.

Login API memvalidasi email/password, membandingkan password dengan `Hash::check()`, lalu membuat token:

```php
$token = $user->createToken('postman')->plainTextToken;
```

`plainTextToken` dikembalikan hanya saat dibuat. Simpan dengan aman; jangan mencatat atau membagikannya.

Jalankan instalasi Sanctum Laravel 11/12:

```powershell
php artisan install:api
php artisan migrate
```

Perintah pertama memasang Sanctum, menyiapkan konfigurasi, migration token, dan API routing. Jalankan setelah file materi ini tersedia; periksa `bootstrap/app.php` dan `routes/api.php` sesudah installer agar route/controller latihan tetap ada. Jalankan migrasi agar tabel personal access token dibuat.

Untuk menguji di Postman atau Thunder Client:

1. `POST http://127.0.0.1:8000/api/login` dengan JSON:
   ```json
   {
     "email": "alamat-akunmu@example.com",
     "password": "password-akunmu",
     "device_name": "Thunder Client"
   }
   ```
2. Salin `access_token` dari respons dan simpan sebagai Bearer Token pada permintaan berikutnya.
3. `GET http://127.0.0.1:8000/api/user` dengan header `Authorization: Bearer <token>`. Dengan token valid, respons berisi pengguna; tanpa token, API harus menolak akses dengan `401`.
4. Opsional: `POST /api/logout` dengan Bearer Token untuk mencabut token tersebut.

Ambil screenshot respons login dan `/api/user`; samarkan token (dan data pribadi) sebelum menyimpan atau menyerahkan screenshot.

Middleware `auth` dipakai untuk sesi web. Middleware `auth:sanctum` dipakai pada endpoint API yang menerima token personal. Untuk SPA berbasis cookie/session Sanctum ada konfigurasi stateful tambahan; alur Postman di atas menggunakan bearer token dan tidak membutuhkannya.

## 6. Middleware web

Pada `routes/web.php`:

```php
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Route profil yang hanya boleh dibuka setelah login.
});
```

`auth` menolak guest (untuk web, biasanya mengarahkannya ke login). `verified` mensyaratkan alamat email telah diverifikasi. Untuk API, gunakan `auth:sanctum`; permintaan tanpa token valid mendapat respons API `401`. Uji `/dashboard` dan `/profile` dalam jendela browser tanpa login.

## 7. Verifikasi email

Model `User` mengimplementasikan `Illuminate\Contracts\Auth\MustVerifyEmail`. Route dashboard sudah memakai `['auth', 'verified']`. Migrasi pengguna sudah memiliki `email_verified_at`.

Breeze telah membuat route bernama `verification.notice`, `verification.verify`, dan `verification.send` dalam `routes/auth.php`, serta view pemberitahuan dengan tombol **Resend Verification Email** di `resources/views/auth/verify-email.blade.php`. Jangan menambahkan route tersebut lagi karena akan duplikat.

Atur `.env` lokal (jangan commit file `.env`):

```dotenv
APP_URL=http://127.0.0.1:8000
MAIL_MAILER=log
```

`MAIL_MAILER=log` menulis isi email lokal ke `storage/logs/laravel.log`; buka tautan verifikasi dari log tersebut. Alternatifnya, konfigurasi Mailtrap sesuai kredensial akun sendiri. Jangan memasukkan kredensial Mailtrap ke repositori.

Uji urutan register → lihat email/log → buka tautan verifikasi → akses dashboard. Sebelum verifikasi, dashboard akan meminta verifikasi email; sesudah verifikasi, dashboard dapat dibuka. Di halaman pemberitahuan verifikasi, tekan tombol kirim ulang dan periksa status/log.

## Checklist sebelum selesai

- [ ] Jalankan perintah setup yang diperlukan; `npm run dev` tetap aktif saat menguji tampilan.
- [ ] Uji register, login, logout, lupa/reset password Breeze dan simpan screenshot yang telah disamarkan.
- [ ] Uji manual login/register/logout, validasi input, serta perlindungan route web.
- [ ] Jalankan `php artisan install:api` dan migrasi; uji token login, `GET /api/user` tanpa/dengan token, serta screenshot tanpa membocorkan token.
- [ ] Uji verifikasi email dan tombol kirim ulang.
- [ ] Jangan pasang Jetstream pada proyek Breeze.
