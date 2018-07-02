<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Profiles extends Migration
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
            $table->smallInteger('uid')->nullable()->default(0);
            $table->string('langcode', 12);
            $table->string('ime', 45);
            $table->string('prezime', 45);
            $table->string('slika', 125);
            $table->string('smer', 65);
            $table->string('nivo_studija', 45);
            $table->year('godina_diplomiranja');
            $table->string('naziv_firme', 250)->nullable();
            $table->string('radno_mesto', 250)->nullable();
            $table->mediumText('biografija');
            $table->string('poruka', 550);
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
