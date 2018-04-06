<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TemporaryProfileUpdate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('temporary_profiles', function (Blueprint $table)
        {
            $table->string('status', 12)->default('created');
            $table->string('komentare', 550)->default('Vaš profil još nije aktivan, čeka se na odobrenje.');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('temporary_profiles', function (Blueprint $table)
        {
            $table->dropColumn('status');
            $table->dropColumn('komentare');
        });
    }
}