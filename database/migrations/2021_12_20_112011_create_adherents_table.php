<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdherentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adherents', function (Blueprint $table) {
            $table->increments('id');
            $table->string('num_adhesion')->unique()->nullable();
            $table->string('num_contrat')->nullable();
            $table->string('slug');
            $table->string('nom');
            $table->string('pnom');
            $table->string('civilite');
            $table->string('email')->unique()->nullable();
            $table->dateTime('date_naiss')->nullable();
            $table->string('num_cni')->unique()->nullable();
            $table->string('lieu_naiss')->nullable();
            $table->string('lieu_hab')->nullable();
            $table->string('contact')->nullable();
            $table->string('contact_format')->nullable();
            $table->integer('role');
            $table->dateTime('date_adhesion')->nullable();
            $table->dateTime('date_fincarence')->nullable();
            $table->dateTime('date_debutcotisation')->nullable();
            $table->integer('parent')->nullable();
            $table->integer('valide')->default(0);
            $table->integer('cas')->default(0);
            $table->integer('status')->default(1);
            $table->integer('admin_id')->nullable();
            $table->integer('solde')->nullable();
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
        Schema::dropIfExists('adherents');
    }
}
