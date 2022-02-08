<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCotisationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cotisations', function (Blueprint $table) {
            $table->id();
            
            $table->string('code_deces', 191)->nullable();
            $table->dateTime('date_annonce')->nullable();
            $table->dateTime('date_butoire')->nullable();
            $table->string('image', 191)->default('/img/Femme stressé.webp');
            $table->enum('type',['annuelle', 'exceptionnelle']);
            $table->dateTime('date_cotis')->nullable();
            $table->integer('annee_cotis')->nullable();
            $table->integer('montant')->default(0);
            $table->boolean('parcouru')->default(false);

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
        Schema::dropIfExists('cotisations');
    }
}
