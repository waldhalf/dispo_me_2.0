<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropColFromUserProfile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_profile', function (Blueprint $table) {
            $table->dropColumn('profile_google');
            $table->dropColumn('profile_google_visible');
            $table->dropColumn('profile_linkedin');
            $table->dropColumn('profile_linkedin_visible');
            $table->dropColumn('profile_viadeo');
            $table->dropColumn('profile_viadeo_visible');
            $table->dropColumn('profile_facebook');
            $table->dropColumn('profile_facebook_visible');
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
            $table->string('profile_google')->nullable();
            $table->boolean('profile_google_visible')->default(False);
            $table->string('profile_linkedin')->nullable();
            $table->boolean('profile_linkedin_visible')->default(False);
            $table->string('profile_viadeo')->nullable();
            $table->boolean('profile_viadeo_visible')->default(False);
            $table->string('profile_facebook')->nullable();
            $table->boolean('profile_facebook_visible')->default(False);
        });
    }
}
