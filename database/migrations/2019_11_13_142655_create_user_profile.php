<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserProfile extends Migration
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
            $table->integer('user_id');
            $table->string('user_profile_pic');
            $table->date('user_birthdate');
            $table->string('user_civil_status');
            $table->string('user_gender');
            $table->string('user_address');
            $table->string('user_street');
            $table->string('user_brgy');
            $table->string('user_mobile_num')->nullable()->default(null);
            $table->string('user_phone_num')->nullable()->default(null);
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
