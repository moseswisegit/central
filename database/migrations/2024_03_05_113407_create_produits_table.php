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
        Schema::create('produits', function (Blueprint $table) {
            $table->id();
            $table->text('designation');
            $table->integer('qte_command');
            $table->integer('qte_recu');
            $table->integer('prix_unitaire');
            $table->integer('montant');
            $table->string('etat_livraison'); // Modifié pour respecter la convention de nommage
            $table->date('date_livraison');
            $table->unsignedBigInteger('categorie_id');
            $table->unsignedBigInteger('fournisseur_id');
            $table->unsignedInteger('user_id'); // Ajoutez cette ligne pour la clé étrangère
            $table->foreign('categorie_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('fournisseur_id')->references('id')->on('fournisseurs')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // Ajoutez cette ligne pour la clé étrangère
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
        Schema::dropIfExists('produits');
    }
};
