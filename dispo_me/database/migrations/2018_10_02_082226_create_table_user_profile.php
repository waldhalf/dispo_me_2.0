<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableUserProfile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_profile', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->boolean('free')->default(FALSE);
            $table->boolean('search_job')->default(FALSE);
            $table->boolean('listen')->default(FALSE);
            $table->integer('notice')->unsigned()->default(0);
            $table->date('free_date')->nullable();
            $table->integer('percentage')->default(100)->unsigned();
            $table->boolean('visible_on_web')->default(FALSE);
            $table->boolean('visible_on_website')->default(FALSE);
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
        Schema::dropIfExists('user_profile');
    }
}
