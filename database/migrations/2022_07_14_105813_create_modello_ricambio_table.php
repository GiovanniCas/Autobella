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
        Schema::create('modello_ricambio', function (Blueprint $table) {
            $table->id();
            $table->biginteger('ricambio_id')->unsigned()->nullable();
            $table->foreign('ricambio_id')->references('id')->on('ricambi')->onDelete('set null');
            $table->biginteger('modello_id')->unsigned()->nullable();
            $table->foreign('modello_id')->references('id')->on('modelli')->onDelete('set null');
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
        Schema::dropIfExists('modello_ricambio');
    }
};
