<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommitteeMemberTarget extends Model
{
	protected $primaryKey = 'committee_member_target_id';

    public function committeeMember()
    {
    	return $this->belongsTo(CommitteeMember::class);
    }
}
