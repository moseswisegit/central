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
        Schema::create('paroisse_decisions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('paroisse_id');
            $table->unsignedBigInteger('decision_id');
            $table->string('chaine_paroisse');
            $table->string('chaine_secretaire');
            $table->string('chaine_mc');
            $table->foreign('paroisse_id')->references('id')->on('paroisses');
            $table->foreign('decision_id')->references('id')->on('decisions');
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
        Schema::dropIfExists('paroisse_decisions');
    }
};
