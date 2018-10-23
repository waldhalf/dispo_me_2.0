<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColUrlToPartnerUserProfile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('partners_UserProfile', function (Blueprint $table) {
            $table->string('urlPartner')->default('Non renseigné');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('partners_UserProfile', function (Blueprint $table) {
            $table->dropColumn('urlPartner');
        });
    }
}
