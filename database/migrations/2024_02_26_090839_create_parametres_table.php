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
        Schema::create('parametres', function (Blueprint $table) {
            $table->id();
            $table->string('accentColor')->nullable();
            $table->string('childIndentSidebarCheckbox');
            $table->string('compactSidebarCheckbox');
            $table->string('flatSidebarCheckbox');
            $table->string('logoColor')->nullable();
            $table->string('sidebarDarkColor')->nullable();
            $table->string('sidebarLightColor')->nullable();
            $table->string('variantsBarreNavigation')->nullable();
            $table->string('textSmBodyCheckbox');
            $table->string('textSmBrandCheckbox');
            $table->string('textSmFooterCheckbox');
            $table->string('textSmHeaderCheckbox');
            $table->string('textSmSidebarCheckbox');
            $table->integer('created_by_id')->nullable();
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
        Schema::dropIfExists('parametres');
    }
};
