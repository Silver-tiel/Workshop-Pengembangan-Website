<?php

namespace App\Http\Controllers;
use App\Http\Controllers\ProdukController;
use Illuminate\Http\Request;

class LaporanPenjualanController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $kategori = "Elektronik";
        $produkController = new ProdukController();
        $daftarProduk = $produkController->getDaftarProduk();
        $dataLaporan =[
            ['nama' => $daftarProduk[0]['nama'], 'terjual' => 15, 'tersisa' => 5],
            ['nama' => $daftarProduk[1]['nama'], 'terjual' => 10, 'tersisa' => 20],
            ['nama' => $daftarProduk[2]['nama'], 'terjual' => 5, 'tersisa' => 15],
        ];
        return view('laporan', compact('kategori', 'daftarProduk', 'dataLaporan'));
    }
}
