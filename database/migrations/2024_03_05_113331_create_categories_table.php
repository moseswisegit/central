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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('libelle');
            $table->unsignedInteger('user_id'); // Ajoutez cette ligne pour la clé étrangère
            $table->timestamps();
        
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // Ajoutez onDelete('cascade') si vous souhaitez supprimer automatiquement les enregistrements liés lorsqu'un utilisateur est supprimé
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
};
