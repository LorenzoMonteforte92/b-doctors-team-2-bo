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
        Schema::create('profile_specialisation', function (Blueprint $table) {
            
            $table->unsignedBigInteger('profile_id');
            $table->foreign('profile_id')
            ->references('id')
            ->on('profiles')
            ->onDelete('cascade');

            $table->unsignedBigInteger('specialisation_id');
            $table->foreign('specialisation_id')
            ->references('id')
            ->on('specialisations')
            ->onDelete('cascade');

            $table->primary(['profile_id', 'specialisation_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profile_specialisation');
    }
};
