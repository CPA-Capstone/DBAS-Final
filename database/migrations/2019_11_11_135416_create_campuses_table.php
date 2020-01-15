<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCampusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campuses', function (Blueprint $table) {
            $table->increments('campus_id');
            $table->string('campus_name');
            $table->string('campus_address');
            $table->string('campus_phone_number');
            $table->string('campus_email');
        });

        Schema::create('program_campus', function (Blueprint $table) {
            $table->integer('program_id');
            $table->integer('campus_id');
            $table->primary(['program_id', 'campus_id']);          
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('campuses');
    }
}
