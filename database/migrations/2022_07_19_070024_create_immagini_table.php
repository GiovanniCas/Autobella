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
        Schema::create('immagini', function (Blueprint $table) {
            $table->id();
            $table->biginteger('ricambio_id')->unsigned();
            $table->foreign('ricambio_id')->references('id')->on('ricambi')->onDelete('cascade');
            $table->string('nome')->nullable()->default(null);
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
        Schema::dropIfExists('immagini');
    }
};
