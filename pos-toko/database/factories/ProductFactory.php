<?php
namespace Database\Factories;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // Mengambil ID kategori secara acak dari data yang sudah ada
            'category_id' => Category::inRandomOrder()->first()->id ?? 1,
            'name' => $this->faker->words(2, true),
            // Menghasilkan 2 kata nama produk
            'sku' => 'PRD-' . $this->faker->unique()->numberBetween(10000, 99999),
            'price' => $this->faker->numberBetween(2000, 50000),
            // Rentang harga barang
            'stock' => $this->faker->numberBetween(5, 100),
            // Rentang jumlah stok
        ];
    }
}