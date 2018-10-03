<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnToUserProfile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_profile', function (Blueprint $table) {
            $table->string('searched_job')->default('no-value');
            $table->string('actuel_job')->default('no-value');
            $table->string('actual_company')->default('no-value');
            $table->string('status_job');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_profile', function (Blueprint $table) {
            $table->dropColumn('searched_job');
            $table->dropColumn('actuel_job');
            $table->dropColumn('actual_company');
            $table->dropColumn('status_job');
        });
    }
}
