# Acara 23 — Authentication (Part 2)

Materi ini melanjutkan autentikasi Acara 22: redirect setelah login, profil, logout, dan proteksi route serta tampilan. Perintah instalasi atau server tidak dijalankan di sini.

## Implementasi

- Setelah login, Breeze dan latihan manual mengarahkan pengguna ke `/dashboard`. Laravel 11/12 tidak memiliki `RouteServiceProvider::HOME`; `bootstrap/app.php` menggunakan `$middleware->redirectUsersTo('/dashboard')` untuk mengarahkan pengguna yang sudah login menjauh dari halaman guest seperti login/register.
- `/dashboard` memakai middleware `auth` saja, sesuai Acara 23. Pengunjung yang belum login dialihkan ke login; pengguna yang sudah login dapat membuka dashboard tanpa harus memverifikasi email. Fitur verifikasi email Breeze dari Acara 22 masih tersedia, tetapi bukan syarat akses dashboard pada latihan ini.
- Profil latihan tersedia di `GET /my-profile`, menggunakan `Auth::user()` dan menampilkan nama pengguna. Route ini terpisah dari `GET /profile`, yang tetap digunakan Breeze untuk mengedit profil.
- `Auth::id()` menampilkan ID saat login dan bernilai `null` ketika guest. View profil menampilkan kedua kondisi tersebut.
- `POST /logout` bernama `logout` menjalankan `AuthController@logout`, mengakhiri autentikasi, menginvalidasi session, meregenerasi token CSRF, lalu kembali ke `/`. Form logout POST dengan `@csrf` berada pada `resources/views/layouts/app.blade.php`.
- Logout manual tambahan tersedia di `POST /manual/logout`; formulir login/register manual berasal dari latihan Acara 22.
- Pada welcome page, directive `@auth` dan `@guest` menampilkan navigasi berbeda. Route `GET /api/user` tetap dilindungi `auth:sanctum`.

## Route dan file terkait

| Route / aksi | File route | File implementasi / view |
|---|---|---|
| `POST /login` → redirect `/dashboard` | `routes/auth.php` | `app/Http/Controllers/Auth/AuthenticatedSessionController.php`; `bootstrap/app.php` |
| `GET /my-profile` | `routes/web.php` | `app/Http/Controllers/AuthController.php`; `resources/views/profile.blade.php` |
| `POST /logout` (named `logout`) | `routes/auth.php` | `app/Http/Controllers/AuthController.php`; `resources/views/layouts/app.blade.php` |
| `GET /dashboard` (auth) | `routes/web.php` | `resources/views/dashboard.blade.php` |
| `GET /profile` (edit profil Breeze, auth) | `routes/web.php` | `app/Http/Controllers/ProfileController.php`; `resources/views/profile/edit.blade.php` |
| `POST /manual/logout` | `routes/web.php` | `app/Http/Controllers/AuthController.php` |
| `GET /api/user` (Sanctum) | `routes/api.php` | `bootstrap/app.php` mendaftarkan file API |
| Kondisi login/guest | — | `resources/views/welcome.blade.php`; `resources/views/profile.blade.php` |

## Pengujian dan screenshot

1. Login dan pastikan diarahkan ke `/dashboard`.
2. Buka `/dashboard` dan `/profile` dalam jendela tanpa login; pastikan diarahkan ke login. Setelah login dengan akun yang belum diverifikasi, pastikan `/dashboard` tetap dapat dibuka.
3. Buka `/my-profile` sebelum login; pastikan nama tampil sebagai Guest dan ID sebagai `null`. Setelah login, pastikan nama serta ID pengguna tampil.
4. Ambil screenshot `/` saat guest dan saat login untuk membuktikan `@guest` dan `@auth` menampilkan kondisi yang sesuai.
5. Tekan tombol logout, pastikan kembali ke `/`, lalu coba buka dashboard lagi.
6. Uji `GET /api/user` tanpa bearer token (harus ditolak/401) dan dengan token valid dari Acara 22.

Hindari menampilkan kredensial, token API, atau data pribadi yang tidak diperlukan di screenshot.

## J. Penjelasan

Pada praktikum ini saya mempelajari redirect setelah login, menampilkan data pengguna dengan `Auth::user()` dan `Auth::id()`, serta logout dengan mengakhiri session. Saya juga menguji middleware `auth` dan `auth:sanctum`, serta directive Blade `@auth` dan `@guest`.

## K. Kesimpulan

Autentikasi Laravel membantu mengarahkan pengguna setelah login dan melindungi halaman maupun API. Informasi autentikasi dapat ditampilkan secara kondisional, sedangkan logout yang benar mengakhiri session dan memperbarui token CSRF.
