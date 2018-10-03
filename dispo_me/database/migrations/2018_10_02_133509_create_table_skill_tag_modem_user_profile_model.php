<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSkillTagModemUserProfileModel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_skill_tags', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('profile_id')->unsigned();
            //On indique en dur qu'il s'agit d'une FK
            //      foreign(nom du champ)-references(champ à lier)->on(table à lier)
            $table->foreign('profile_id')->references('id')->on('user_profile');
            $table->integer('skill_tag_id')->unsigned();
            $table->foreign('skill_tag_id')->references('id')->on('skill_tags');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_skill_tags');
    }
}
