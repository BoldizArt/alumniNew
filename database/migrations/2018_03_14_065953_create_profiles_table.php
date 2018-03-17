<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->smallInteger('uid')->unique();
            $table->string('ime', 45);
            $table->string('prezime', 45);
            $table->string('jezik_sajta', 3);
            $table->string('smer', 65);
            $table->string('nivo_studija', 45);
            $table->year('godina_diplomiranja');
            $table->string('radno_mesto', 250);
            $table->mediumText('biografija');
            $table->string('poruka');
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
        Schema::dropIfExists('profiles');
    }
}
