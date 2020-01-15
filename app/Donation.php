<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    protected $primaryKey = 'donation_id';

    public function campuses()
    {
    	return $this->belongsToMany(Campus::class, 'campus_donation', 'donation_id', 'campus_id');
    }

    public function donor()
    {
    	return $this->belongsTo(Donor::class, 'donor_id');
    }

    public function program()
    {
    	return $this->belongsTo(Program::class, 'program_id');
    }

    public function committeeMember()
    {
    	return $this->belongsTo(CommitteeMember::class, 'committee_member_id');
    }
}
