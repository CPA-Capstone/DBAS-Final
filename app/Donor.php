<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Donor extends Model
{
    protected $primaryKey = 'donor_id';

    public function committeeMembers()
    {
    	return $this->belongsToMany(CommitteeMember::class, 'donor_committee_member', 'donor_id', 'committee_member_id');
    }

    public function donorType()
    {
    	return $this->belongsTo(DonorType::class);
    }

    public function donations()
    {
    	return $this->hasMany(Donation::class, 'donor_id');
    }

    public function donorProjections()
    {
    	return $this->hasMany(DonorProjection::class);
    }
}
