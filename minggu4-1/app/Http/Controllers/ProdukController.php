<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
class ProdukController extends Controller
{
 // Menampilkan daftar produk
public function getkategori()
 {
    return [
        ['id' => 1, 'nama' => 'Elektronik'],
        ['id' => 2, 'nama' => 'Pakaian'],
        ['id' => 3, 'nama' => 'Makanan'],
    ];
 }
public function getDaftarProduk()
 {
    return [
        ['id' => 1, 'nama' => 'Laptop ThinkPad', 'harga' => 12500000],
        ['id' => 2, 'nama' => 'Mouse Wireless', 'harga' => 250000],
        ['id' => 3, 'nama' => 'Mechanical Keyboard', 'harga' => 850000],
 ]; 
 }
 public function index()
 {
 $kategori = $this->getkategori()[1];
 $daftarProduk = $this->getDaftarProduk();
 return view('index', compact('kategori', 'daftarProduk'));
 }
 // Menampilkan detail produk berdasarkan parameter ID
 public function show($id)
 {
 return view('detail', ['id' => $id]);
 }
}
