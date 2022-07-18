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
        Schema::table('ricambi', function (Blueprint $table) {
            $table->string('nome')->after('fornitore_id')->default('pippo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ricambi', function (Blueprint $table) {
            $table->dropColumn('nome');
        });
    }
};
