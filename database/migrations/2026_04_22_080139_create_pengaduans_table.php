<?php
 use Illuminate\Database\Migrations\Migration;
 use Illuminate\Database\Schema\Blueprint;
 use Illuminate\Support\Facades\Schema;
 
 return new class extends Migration
 {
     public function up(): void
     {
         Schema::create('pengaduan', function (Blueprint $table) {
             $table->id();
             $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
             $table->foreignId('kategori_id')->constrained('kategori');
             $table->string('judul_laporan');
             $table->text('isi_laporan');
             $table->date('tgl_pengaduan');
             $table->string('lokasi');
             $table->string('foto');
             $table->enum('status', ['0', '1', '2', '3'])->default('0');
             $table->timestamp('processed_at')->nullable();
             $table->timestamp('completed_at')->nullable();
             $table->timestamp('rejected_at')->nullable();
             $table->timestamps();
         });
     }
 
     public function down(): void
     {
         Schema::dropIfExists('pengaduan');
     }
 };