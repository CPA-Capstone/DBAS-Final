<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $primaryKey = 'program_id';

    public function campuses()
    {
    	return $this->belongsToMany(Campus::class, 'program_campus', 'program_id', 'campus_id');
    }

    public function committeeMembers()
    {
    	return $this->belongsToMany(CommitteeMember::class);
    }

    public function donations()
    {
    	return $this->hasMany(Donation::class);
    }
}
