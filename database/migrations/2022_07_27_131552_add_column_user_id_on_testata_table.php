<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {

        Schema::table('testata_ordini', function (Blueprint $table) {
            $table->biginteger('user_id')->unsigned()->after('id')->nullable()->default(null);
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('testata_ordini', function (Blueprint $table) {
          
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};
