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
            $table->string('notransaksi')->nullable();
            $table->string('metode_pembayaran')->nullable();
            $table->string('estimasi')->nullable();
            $table->string('harga_total')->nullable();
            $table->integer('status')->nullable();
            $table->string('ongkir')->nullable();
            $table->string('bukti')->nullable();
            $table->string('jadwal_pengiriman')->nullable();
            $table->timestamps();
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
