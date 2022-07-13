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
        Schema::create('modelli', function (Blueprint $table) {
            $table->id();
            $table->biginteger('marca_id')->unsigned();
            $table->foreign('marca_id')->references('id')->on('marche')->ondelete('cascade');
            $table->string('name');
            $table->date('anno_produzione');
            $table->date('anno_ritiro');
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
        $table->dropForeign(['marca_id']);
        Schema::dropIfExists('modello');
    }
};
