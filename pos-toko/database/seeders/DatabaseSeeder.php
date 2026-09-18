<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;
public function run(): void
{
 // 1. Jalankan Seeder Kategori terlebih dahulu
 // agar data kategorinya ada
 $this->call(CategorySeeder::class);

 $this->call(SupplierSeeder::class);
 // 2. Jalankan Factory Produk untuk membuat 50
 // data dummy produk
 \App\Models\Product::factory(50)->create();
}

}
