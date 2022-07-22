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
        Schema::create('ricambi_ordinati', function (Blueprint $table) {
            $table->id();
            $table->biginteger("ricambio_id")->unsigned();
            $table->foreign("ricambio_id")->references("id")->on("ricambi");
            $table->biginteger("testata_id")->unsigned();
            $table->foreign("testata_id")->references("id")->on("testata_ordini")->onDelete('cascade');
            $table->integer("quantita");
            $table->decimal("prezzo_unitario");
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
       
        Schema::dropIfExists('ricambi_ordinati');
    }
};
