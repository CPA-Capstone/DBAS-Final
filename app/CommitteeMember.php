<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommitteeMember extends Model
{
    protected $primaryKey = 'committee_member_id';

    public function donors()
    {
    	return $this->belongsToMany(Donor::class, 'donor_committee_member', 'committee_member_id', 'donor_id')->withPivot('start_date', 'end_date');
    }

    public function user()
    {
    	return $this->belongsTo(User::class, 'user_id');
    }

    public function donorTypes()
    {
    	return $this->belongsToMany(DonorType::class, 'committee_member_donor_type', 'committee_member_id', 'donor_type_id')->withPivot('start_date', 'end_date');
    }

    public function programs()
    {
    	return $this->belongsToMany(Program::class, 'committee_member_program', 'committee_member_id', 'program_id')->withPivot('start_date', 'end_date');
    }

    public function committeeMemberTargets()
    {
    	return $this->hasMany(CommitteeMemberTarget::class);
    }

    public function donations()
    {
    	return $this->hasMany(Donation::class);
    }

    public static function activeMembers()
    {
        return static::selectRaw('*')->whereRaw('committee_member_type = "m" and committee_member_status = "e"')->get()->toArray();
    }
}
