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
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->date('date_entree');
            $table->unsignedBigInteger('id_user');
            $table->timestamps();

            // Clé étrangère vers user
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
       

            });
    }

    public function down()
    {
        Schema::dropIfExists('stocks');
    }
};
