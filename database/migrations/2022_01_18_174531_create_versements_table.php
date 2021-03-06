<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVersementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('versements', function (Blueprint $table) {
            $table->increments('id');
            $table->string('montant');
            $table->integer('id_admin')->nullable();
            $table->string('parcouru')->default(0);
            $table->integer('status')->default(1);
            $table->text('description')->nullable();
            $table->timestamps();

            //foreign key
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
        Schema::dropIfExists('versements');
    }
}
