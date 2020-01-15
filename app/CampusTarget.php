<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CampusTarget extends Model
{
	protected $primaryKey = 'campus_target_id';

    public function campus()
    {
    	return $this->belongsTo(Campus::class);
    }
}
