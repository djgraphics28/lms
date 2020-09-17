<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactPerson extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_person', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('record_id');
            $table->string('cp_fname');
            $table->string('cp_lname');
            $table->string('cp_mname');
            $table->string('cp_ename')->nullable()->default(null);
            $table->string('cp_address');
            $table->string('relationship');
            $table->string('cp_phone_num', 50)->nullable()->default(null);
            $table->string('cp_tel_num', 50)->nullable()->default(null);
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
        Schema::dropIfExists('contact_person');
    }
}
