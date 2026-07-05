<?php

// database/migrations/xxxx_xx_xx_create_bank_sampah_tables.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('admin', function (Blueprint $table) {
            $table->string('id_admin')->primary();
            $table->string('username')->unique();
            $table->string('password');
            $table->timestamps();
        });

        Schema::create('warga', function (Blueprint $table) {
            $table->string('id_warga')->primary();
            $table->string('nama');
            $table->text('alamat');
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamps();
        });

        Schema::create('jenis_sampah', function (Blueprint $table) {
            $table->string('id_jenis')->primary();
            $table->string('nama_sampah');
            $table->integer('harga_perkg');
            $table->timestamps();
        });

        Schema::create('transaksi', function (Blueprint $table) {
            $table->string('id_transaksi')->primary();
            $table->string('id_warga');
            $table->date('tanggal');
            $table->double('total_berat', 8, 2);
            $table->decimal('total_saldo', 12, 2);
            $table->timestamps();

            $table->foreign('id_warga')->references('id_warga')->on('warga')->onDelete('cascade');
        });

        Schema::create('detail_transaksi', function (Blueprint $table) {
            $table->id();
            $table->string('id_transaksi');
            $table->string('id_jenis');
            $table->double('berat', 8, 2);
            $table->decimal('subtotal', 12, 2);
            $table->timestamps();

            $table->foreign('id_transaksi')->references('id_transaksi')->on('transaksi')->onDelete('cascade');
            $table->foreign('id_jenis')->references('id_jenis')->on('jenis_sampah')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detail_transaksi');
        Schema::dropIfExists('transaksi');
        Schema::dropIfExists('jenis_sampah');
        Schema::dropIfExists('warga');
        Schema::dropIfExists('admin');
    }
};