<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->string('reference');
            $table->text('corps');
            $table->enum('status', ['sent', 'unsent', 'pending', 'draft']);
            $table->dateTime('sent_at')->nullable();
            $table->integer('id_destinataires')->unsigned();
            $table->integer('id_campagnes')->unsigned();

            // $table->foreign('id_destinataires')->references('num_adhesion')->on('adherents')->onDelete('cascade');
            // $table->foreign('id_destinataires')->references('id')->on('campages')->onDelete('cascade');

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
        Schema::dropIfExists('messages');
    }
}
