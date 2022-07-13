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
        Schema::create('fornitori', function (Blueprint $table) {
            $table->id();
            $table->string('ragione_sociale')->unique();
            $table->string('indirizzo');
            $table->string('comune');
            $table->string('cap');
            $table->string('provincia');
            $table->string('partita_iva')->unique();
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
        Schema::dropIfExists('fornitori');
    }
};
