<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fname')->nullable()->default(null);
            $table->string('lname')->nullable()->default(null);
            $table->string('mname')->nullable()->default(null);
            $table->string('ename')->nullable()->default(null);
            $table->string('gender', 10)->nullable()->default(null);
            $table->date('birthdate')->nullable()->default(null);
            $table->string('place_of_birth')->nullable()->default(null);
            $table->string('home_address')->nullable()->default(null);
            $table->integer('civil_status')->nullable()->default(null);
            $table->string('occupation', 50)->nullable()->default(null);
            $table->string('tin_no')->nullable()->default(null);
            $table->string('valid_no')->nullable()->default(null);
            $table->string('area_of_tillage')->nullable()->default(null);
            $table->string('location')->nullable()->default(null);
            $table->string('other_source_income')->nullable()->default(null);
            $table->string('tenurial_status')->nullable()->default(null);
            $table->string('initial_capital')->nullable()->default(null);
            $table->string('name_of_spouse')->nullable()->default(null);
            $table->string('profile_pic')->nullable()->default(null);
            $table->string('phone_num', 50)->nullable()->default(null);
            $table->integer('status')->nullable()->default(1)->comment("1=active;0=inactive");
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
        Schema::dropIfExists('members');
    }
}
