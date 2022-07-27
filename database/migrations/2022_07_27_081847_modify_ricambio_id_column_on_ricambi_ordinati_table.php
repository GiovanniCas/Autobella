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
        
            $table->biginteger("ricambio_id")->unsigned()->nullable()->onDelete('restrict')->change();
            
    
        });
    }

    public function down()
    {
        
    }
};
