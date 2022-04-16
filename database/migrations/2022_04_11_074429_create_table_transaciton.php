<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableTransaciton extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('nama_customer');
            $table->string('ticket_code');
            $table->enum('tipe',['group','individual']);
            $table->integer('amount');
            $table->integer('amount_scanned');
            $table->enum('status',['open','closed']);
            $table->integer('harga_ticket');
            $table->string('created_by');
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
        Schema::dropIfExists('table_transaciton');
    }
}
