<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProgramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('programs', function (Blueprint $table) {
            $table->increments('program_id');
            $table->string('program_name');
        });

        Schema::create('committee_member_program', function (Blueprint $table) {
            $table->integer('committee_member_id');
            $table->integer('program_id');
            $table->datetime('start_date');
            $table->datetime('end_date')->nullable();
            $table->primary(['committee_member_id', 'program_id', 'start_date']);          
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('programs');
    }
}
