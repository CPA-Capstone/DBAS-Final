<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommitteeMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('committee_members', function (Blueprint $table) {
            $table->increments('committee_member_id');
            $table->string('committee_member_first_name');
            $table->string('committee_member_last_name');
            $table->string('committee_member_type');
            $table->string('committee_member_status');
            $table->string('user_id');
        });

        Schema::create('donor_committee_member', function (Blueprint $table) {
            $table->integer('donor_id');
            $table->integer('committee_member_id');
            $table->datetime('start_date');
            $table->datetime('end_date')->nullable();
            $table->primary(['donor_id', 'committee_member_id', 'start_date']);          
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('committee_members');
    }
}
