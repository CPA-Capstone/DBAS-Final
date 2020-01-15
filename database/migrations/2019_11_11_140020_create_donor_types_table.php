<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDonorTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donor_types', function (Blueprint $table) {
            $table->char('donor_type_id');
            $table->string('donor_type_name');
        });

        Schema::create('committee_member_donor_type', function (Blueprint $table) {
            $table->integer('committee_member_id');
            $table->char('donor_type_id');
            $table->datetime('start_date');
            $table->datetime('end_date')->nullable();
            $table->primary(['committee_member_id', 'donor_type_id', 'start_date']);          
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('donor_types');
    }
}
