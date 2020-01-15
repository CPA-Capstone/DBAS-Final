<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DonorType extends Model
{
    protected $primaryKey = 'donor_type_id';
    public $incrementing = false;

    public function donors()
    {
    	return $this->hasMany(Donor::class);
    }

    public function committeeMembers()
    {
    	return $this->belongsToMany(CommitteeMember::class);
    }

    public function donorTypeTargets()
    {
    	return $this->hasMany(DonorTypeTarget::class);
    }
}
