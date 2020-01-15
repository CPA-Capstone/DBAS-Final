<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDonationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donations', function (Blueprint $table) {
            $table->increments('donation_id');
            $table->decimal('donation_amount', 11, 2);
            $table->datetime('donation_date');
            $table->integer('donor_id');
            $table->integer('program_id');
            $table->integer('committee_member_id');
        });

        Schema::create('campus_donation', function (Blueprint $table) {
            $table->integer('campus_id');
            $table->char('donation_id');
            $table->decimal('campus_donation_amount', 11, 2);
            $table->datetime('campus_donation_date');
            $table->primary(['campus_id', 'donation_id']);          
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('donations');
    }
}
