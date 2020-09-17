<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCharacterrefTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('characterref', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('member_id')->nullable()->default(null);
            $table->string('name',100)->nullable()->default(null);
            $table->string('contact_number',10)->nullable()->default(null);
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
        Schema::dropIfExists('characterref');
    }
}
