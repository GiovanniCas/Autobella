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
        Schema::create('ricambi', function (Blueprint $table) {
            $table->id();
            $table->biginteger('categoria_id')->unsigned()->nullable();
            $table->foreign('categoria_id')->references('id')->on('categorie')->onDelete('set Null');
            $table->biginteger('fornitore_id')->unsigned();
            $table->foreign('fornitore_id')->references('id')->on('fornitori')->onDelete('cascade');
            $table->string('codice_pezzo');
            $table->string('descrizione');
            $table->decimal('prezzo');
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
        $table->dropForeign(["categoria_id"]);
        $table->dropForeign(["fornitore_id"]);
        Schema::dropIfExists('ricambi');
    }
};
