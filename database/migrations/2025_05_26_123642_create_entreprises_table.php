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
        Schema::create('entreprises', function (Blueprint $table) {
            $table->id(); // id auto-increment primary key
            $table->string('nom_entreprise');
            $table->string('logo_entreprise')->nullable();
            $table->timestamps(); // created_at et updated_at
            
        });
    }

    public function down()
    {
        Schema::dropIfExists('entreprises');
    }
};
