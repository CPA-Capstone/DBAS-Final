<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DonorTypeTarget extends Model
{
	protected $primaryKey = 'donor_type_target_id';

    public function donorType()
    {
    	return $this->belongsTo(DonorType::class);
    }
}
