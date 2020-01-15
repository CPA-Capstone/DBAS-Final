<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Campus extends Model
{
	protected $primaryKey = 'campus_id';

    public function campusTargets()
	{
		return $this->hasMany(CampusTarget::class);
	}

	public function donations()
	{
		return $this->belongsToMany(Donation::class);
	}

	public function programs()
	{
		return $this->belongsToMany(Program::class, 'program_campus', 'campus_id', 'program_id');
	}
}
