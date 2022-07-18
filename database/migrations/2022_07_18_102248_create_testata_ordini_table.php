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
        Schema::create('testata_ordini', function (Blueprint $table) {
            $table->id();
            $table->string("name")->nullable();
            $table->string("cognome")->nullable();
            $table->string("citta")->nullable();
            $table->string("indirizzo")->nullable();
            $table->string("cap")->nullable();
            $table->string("email")->nullable();
            $table->string("totale")->nullable();
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
        
        Schema::dropIfExists('testata_ordini');
    }
};
