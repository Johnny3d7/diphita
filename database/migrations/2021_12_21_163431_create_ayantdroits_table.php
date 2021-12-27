<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAyantdroitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ayantdroits', function (Blueprint $table) {
            $table->increments('id');
            $table->string('num_ayant')->unique()->nullable();
            $table->string('slug');
            $table->string('nom');
            $table->string('pnom');
            $table->string('civilite');
            $table->string('email')->unique()->nullable();
            $table->dateTime('date_naiss')->nullable();
            $table->string('lieu_hab')->nullable();
            $table->string('contact')->unique()->nullable();
            $table->integer('priorite');
            $table->integer('status')->default(1);
            $table->timestamps();

            //Foreign_key
            $table->integer('id_adherent')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ayantdroits');
    }
}
