<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('depenses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('lib');
            $table->string('montant');
            $table->dateTime('date_depense');
            $table->string('observation');
            $table->integer('parcouru');
            $table->integer('id_admin');
            $table->integer('id_ordonnateur');
            $table->integer('status');
            $table->integer('id_adherent');
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
        Schema::dropIfExists('depenses');
    }
}
