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
        Schema::create('historiques', function (Blueprint $table) {
            $table->id();
            $table->date('date_action');
            $table->string('type_action');
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_vente');
            $table->timestamps();

            // Clés étrangères
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_vente')->references('id')->on('ventes')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('historiques');
    }
};
