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
        Schema::table('ricambi_ordinati', function (Blueprint $table) {
        
            $table->string('nome_ricambio')->after('testata_id')->nulluble()->default(null);
            $table->string('codice_ricambio')->after('nome_ricambio')->nulluble()->default(null);
       
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $table->dropColumn('nome_ricambio');
        $table->dropColumn('codice_ricambio');
    }
};
