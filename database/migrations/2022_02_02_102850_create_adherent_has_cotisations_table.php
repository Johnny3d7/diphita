<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdherentHasCotisationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adherent_has_cotisations', function (Blueprint $table) {
            $table->id();
            $table->integer('nbre_benef')->default(1);
            $table->integer('montant')->default(0);
            $table->boolean('reglee')->default(false);
            $table->boolean('parcouru')->default(false);

            $table->integer('id_adherent')->unsigned();
            $table->integer('id_cotisation')->unsigned();

            $table->integer('id_admin')->nullable();
            $table->integer('status')->default(1);

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
        Schema::dropIfExists('adherent_has_cotisations');
    }
}
