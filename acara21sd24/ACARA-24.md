# Acara 24 — Authorization: Gates, Policies, dan Middleware

Praktikum ini menunjukkan otorisasi dengan contoh post yang hanya boleh diedit oleh pemiliknya. Implementasi menggunakan pola Laravel 12; perintah Artisan tidak dijalankan.

## 1. Gates

Gate adalah kemampuan bernama untuk aturan otorisasi yang tidak harus terikat pada satu model. Pada Laravel 11/12, aplikasi ini tidak memiliki `AuthServiceProvider` bawaan. Gate latihan didefinisikan di `boot()` milik `app/Providers/AppServiceProvider.php`:

```php
Gate::define('edit-post', function (User $user, Post $post): bool {
    return $user->id === $post->user_id;
});
```

`User` adalah pengguna yang sedang login, dan `Post` adalah objek yang aksinya hendak dilakukan. Gate menolak akses bila ID pemilik post berbeda dengan ID pengguna.

Controller dapat menjalankan `Gate::authorize('edit-post', $post)`. Blade dapat memeriksa izin dengan `@can('edit-post', $post)`.

## 2. Policies

Policy mengelompokkan aturan otorisasi yang berhubungan dengan model tertentu. `app/Policies/PostPolicy.php` memiliki metode:

```php
public function update(User $user, Post $post): bool
{
    return $user->id === $post->user_id;
}
```

Laravel 12 menemukan `PostPolicy` secara otomatis karena nama dan lokasinya mengikuti konvensi `App\Policies\PostPolicy` untuk model `App\Models\Post`. Pendaftaran manual melalui `$policies` pada `AuthServiceProvider` tidak diperlukan. Di controller gunakan `$this->authorize('update', $post)`; di Blade gunakan `@can('update', $post)`.

## 3. Middleware Authorization

Middleware `can` memeriksa Policy sebelum controller dijalankan. Contoh route latihan:

```php
Route::get('/posts/{post}/middleware-edit', [PostController::class, 'edit'])
    ->middleware('can:update,post');
```

Laravel meneruskan model hasil route binding `{post}` ke kemampuan `update` milik `PostPolicy`. Jika pengguna tidak memiliki izin, Laravel membalas dengan HTTP 403.

## 4. Implementasi latihan

- `app/Models/Post.php` dan migration `database/migrations/2026_10_06_000000_create_posts_table.php` menyimpan post dengan `user_id` pemilik.
- `app/Providers/AppServiceProvider.php` mendefinisikan Gate `edit-post`.
- `app/Policies/PostPolicy.php` mendefinisikan izin `update`.
- `app/Http/Controllers/PostController.php` menyediakan daftar, pembuatan, serta tiga variasi halaman edit untuk membandingkan Gate, Policy, dan route middleware. Update juga memeriksa Policy agar tidak bisa dilewati lewat pengiriman form langsung.
- `routes/web.php` melindungi semua route latihan post dengan middleware `auth`.
- View `resources/views/posts/` menampilkan post serta tautan edit hanya jika pengguna diizinkan (`@can`).
- Dashboard memiliki tautan ke daftar latihan post.

## 5. Langkah menjalankan dan menguji

Migration post baru harus dijalankan agar tabel tersedia:

```powershell
php artisan migrate
```

1. Login, buka `/dashboard`, lalu pilih tautan latihan Authorization.
2. Buat post. Post otomatis terhubung ke pengguna yang sedang login.
3. Di `/posts`, pemilik akan melihat tautan Edit (Gate), Edit (Policy), dan Edit (Middleware can).
4. Buat/login sebagai pengguna kedua. Pengguna kedua tidak melihat tautan edit dan jika membuka URL edit milik pengguna pertama secara langsung, ia menerima HTTP 403.
5. Ulangi pengujian untuk ketiga metode edit; semua hanya mengizinkan pemilik.

Route dan file:

| Route | Implementasi |
|---|---|
| `GET /posts`, `GET /posts/create`, `POST /posts` | `routes/web.php`, `PostController.php` |
| `GET /posts/{post}/gate-edit` | Gate `edit-post` di `AppServiceProvider.php` |
| `GET /posts/{post}/policy-edit` | `PostPolicy::update()` melalui `$this->authorize()` |
| `GET /posts/{post}/middleware-edit` | Middleware `can:update,post` |
| `PUT /posts/{post}` | Policy `update`, validasi, lalu simpan |

## Screenshot yang dilampirkan

- Form pembuatan post atau daftar yang menampilkan post dan tombol edit bagi pemilik.
- Halaman edit yang mencantumkan metode yang digunakan (Gate, Policy, atau middleware).
- Akun pemilik lain mencoba membuka URL edit dan mendapat halaman HTTP 403.
- Jika diminta, tampilkan potongan Gate, Policy, middleware route, dan directive `@can` di editor.

Jangan tampilkan kredensial akun pada screenshot.

## J. Penjelasan

Pada praktikum ini saya membuat aturan agar post hanya dapat diedit oleh pemiliknya. Saya menguji aturan tersebut menggunakan Gate, Policy, middleware `can`, dan directive `@can` di Blade.

## K. Kesimpulan

Gates, Policies, dan middleware membantu membatasi aksi pengguna berdasarkan izin. Pengujian dengan akun pemilik dan pengguna lain menunjukkan bahwa aturan otorisasi mencegah pengguna mengubah post yang bukan miliknya.
