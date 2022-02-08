<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssistancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assistances', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_benef')->unsigned();
            $table->dateTime('date_deces');
            $table->string('lieu_deces');
            $table->dateTime('date_obseques');
            $table->dateTime('date_assistance')->nullable();
            $table->string('moyen_assistance')->nullable();
            $table->string('enfant_defunt')->nullable();
            $table->string('enfant_contact')->nullable();
            $table->string('proche_defunt')->nullable();
            $table->string('proche_contact')->nullable();
            $table->string('num_compte')->nullable();
            $table->string('num_depot')->nullable();
            $table->string('status')->default(1);
            $table->string('valide')->default(0);
            $table->string('assiste')->default(0);
            $table->string('code_deces')->nullable();
            $table->timestamps();
            
            //Foreign_key
            $table->integer('id_souscripteur')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assistances');
    }
}
