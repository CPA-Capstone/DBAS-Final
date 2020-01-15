<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCampusTargetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campus_targets', function (Blueprint $table) {
            $table->increments('campus_target_id');
            $table->integer('campus_target_year');
            $table->integer('campus_target_quarter');
            $table->decimal('campus_target_amount');
            $table->integer('campus_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('campus_targets');
    }
}
