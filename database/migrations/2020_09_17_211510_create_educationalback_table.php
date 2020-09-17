<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEducationalbackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('educationalback', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('member_id')->nullable()->default(null);
            $table->string('education_level',50)->nullable()->default(null);
            $table->string('name_of_school',50)->nullable()->default(null);
            $table->string('year_graduated',50)->nullable()->default(null);
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
        Schema::dropIfExists('educationalback');
    }
}
