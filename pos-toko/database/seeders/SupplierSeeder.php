<?php
namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Suppliers;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Tambahkan data supplier di sini
        $suppliers = [
            ['name' => 'PT Unilever Indonesia Tbk', 'phone' => '(021) 8082-7000', 'address' => 'Grha Unilever, BSD Green Office Park Kav. 3, Jl. BSD Boulevard Barat, BSD City, Tangerang 15345'],
            ['name' => 'pt indofood cbp sukses makmur tbk', 'phone' => '(+62-21) 5793 7500', 'address' => 'Sudirman Plaza, Indofood Tower, Lantai 23Jl. Jend. Sudirman Kav. 76-78Jakarta Selatan, DKI Jakarta 12910Indonesia'],
            ['name' => 'PT Japfa Comfeed Indonesia Tbk', 'phone' => '(021) 2854 5680', 'address' => 'PT Japfa Comfeed Indonesia TbkWisma Millenia Lt. 7Jl. M.T. Haryono Kav. 16, Jakarta 12810Indonesia'],
            ['name' => 'PT Mayora Indah Tbk', 'phone' => '(021) 2960-8888', 'address' => 'PT Mayora Indah TbkJl. Jend. Gatot Subroto Kav. 32-34Jakarta 12950Indonesia'],
            ['name' => 'PT Wings Surya', 'phone' => '(021) 5793-7500', 'address' => 'PT Wings SuryaJl. Raya Bogor Km. 26, CibinongBogor, Jawa Barat 16915Indonesia'],
            ['name' => 'PT Kalbe Farma Tbk', 'phone' => '(021) 521-1234', 'address' => 'PT Kalbe Farma TbkJl. Letjen Suprapto No. 2Jakarta Pusat, DKI Jakarta 10510Indonesia'],
            ['name' => 'PT Sarihusada Generasi Mahardhika', 'phone' => '(021) 5793-7500', 'address' => 'PT Sarihusada Generasi MahardhikaJl. Raya Bogor Km. 26, CibinongBogor, Jawa Barat 16915Indonesia'],
            ['name' => 'PT Indofood Sukses Makmur Tbk', 'phone' => '(021) 5793-7500', 'address' => 'PT Indofood Sukses Makmur TbkJl. Jend. Sudirman Kav. 76-78Jakarta Selatan, DKI Jakarta 12910Indonesia'],
            ['name' => 'PT Nestle Indonesia', 'phone' => '(021) 5793-7500', 'address' => 'PT Nestle IndonesiaJl. Jend. Gatot Subroto Kav. 32-34Jakarta Selatan, DKI Jakarta 12950Indonesia'],
        ];
        foreach ($suppliers as $sup) {
            Suppliers::firstOrCreate(
                ['name' => $sup['name']],
                [
                    'phone'   => $sup['phone'],
                    'address' => $sup['address'],
                ]
            );
        }
    }
}