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
        Schema::create('pays', function (Blueprint $table) {
            $table->id();
            $table->string('nom_pays');
            $table->decimal('longitude_pays', 10, 8); // 10 chiffres au total, 8 après la virgule
            $table->decimal('lattitude_pays', 10, 8);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pays');
    }
};
