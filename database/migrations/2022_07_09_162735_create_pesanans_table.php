<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesanans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('produk_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->integer('jumlah_produk')->nullable();
            $table->string('metode_pembayaran')->nullable();
            $table->string('estimasi')->nullable();
            $table->integer('status')->nullable();
            $table->timestamps();
            $table->foreign('produk_id')->references('id')->on('produks')->onDelete('restrict');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pesanans');
    }
};
