<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDonorTypeTargetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donor_type_targets', function (Blueprint $table) {
            $table->increments('donor_type_target_id');
            $table->integer('donor_type_target_year');
            $table->integer('donor_type_target_quarter');
            $table->decimal('donor_type_target_amount');
            $table->char('donor_type_id');
        });    
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('donor_type_targets');
    }
}
