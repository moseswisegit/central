<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('villes', function (Blueprint $table) {
            $table->id();
            $table->string('libelle');
            $table->unsignedBigInteger('pays_id'); // Définition de la colonne pour la clé étrangère
            $table->foreign('pays_id')->references('id')->on('pays'); // Ajout de la contrainte de clé étrangère
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
        Schema::dropIfExists('villes');
    }
};
