<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('ventes', function (Blueprint $table) {
            $table->id();
            $table->date('date_vente');          // Date de la vente
            $table->string('canal_vente');       // Canal de vente
            $table->unsignedBigInteger('id_user'); // Référence a l'employe (vendeur)
            $table->unsignedBigInteger('id_client');   // Référence au client

            $table->timestamps();

            // Clés étrangères
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_client')->references('id')->on('clients')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('ventes');
    }
};
