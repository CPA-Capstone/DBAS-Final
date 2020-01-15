<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommitteeMemberTargetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('committee_member_targets', function (Blueprint $table) {
            $table->increments('committee_member_target_id');
            $table->integer('committee_member_target_year');
            $table->integer('committee_member_target_quarter');
            $table->decimal('committee_member_target_amount');
            $table->integer('committee_member_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('committee_member_targets');
    }
}
