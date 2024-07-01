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
        Schema::table('user_messages', function (Blueprint $table) {
            $table->unsignedBigInteger('profile_id')->nullable()->after('id');

            $table->foreign('profile_id')
            ->references('id')
            ->on('profiles')
            ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_messages', function (Blueprint $table) {
            $table->dropForeign('user_messages_profile_id_foreign');
            $table->dropColumn('profile_id');
        });
    }
};
