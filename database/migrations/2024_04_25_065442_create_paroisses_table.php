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
        Schema::create('paroisses', function (Blueprint $table) {
            $table->id();
            $table->string('nom_paroisse');
            $table->unsignedBigInteger('pays_id');
            $table->unsignedBigInteger('ville_id');
            $table->unsignedBigInteger('commune_id');
            $table->unsignedBigInteger('quartier_id');
            $table->string('adresse_paroisse');
            $table->string('nom_charge');
            $table->string('numero_charge');
            $table->string('nom_secretaire');
            $table->string('numero_secretaire');
            $table->string('nom_maitre_choeur');
            $table->string('numero_maitre_choeur');
            $table->string('image_eglise'); // Assurez-vous de gérer le stockage de l'image correctement dans votre application
            $table->timestamps();
    
            // Contraintes de clé étrangère
            $table->foreign('pays_id')->references('id')->on('pays');
            $table->foreign('ville_id')->references('id')->on('villes');
            $table->foreign('commune_id')->references('id')->on('communes');
            $table->foreign('quartier_id')->references('id')->on('quartiers');
        });
    }
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('paroisses');
    }
};
