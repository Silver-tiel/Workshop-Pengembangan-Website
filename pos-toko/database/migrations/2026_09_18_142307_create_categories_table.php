<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up(): void
{
 Schema::create('categories', function (Blueprint $table) {
 $table->id();

 $table->string('name')->unique();
 // Nama kategori (Makanan, Minuman, Kosmetik, dll)

 $table->string('slug')->unique();
 // URL ramah SEO (makanan, minuman)

 $table->timestamps();
 });
}
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
