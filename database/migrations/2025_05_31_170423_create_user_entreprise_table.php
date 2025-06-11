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
        Schema::create('user_entreprise', function (Blueprint $table) {
    $table->id();
    $table->boolean('is_creator')->default(false); // indique si ce user a créé cette entreprise
    $table->timestamps();
    $table->unsignedBigInteger('id_user');
    $table->unsignedBigInteger('id_entreprise');

    $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
    $table->foreign('id_entreprise')->references('id')->on('entreprises')->onDelete('cascade');

});

    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('user_entreprise');
    }
};
