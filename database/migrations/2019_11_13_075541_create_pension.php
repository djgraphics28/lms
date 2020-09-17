<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePension extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pensions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('senior_id');
            $table->float('pension_amount');
            $table->boolean('status')->nullable()->default(1)->comment("1=active;0=inactive");
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
        Schema::dropIfExists('pensions');
    }
}
