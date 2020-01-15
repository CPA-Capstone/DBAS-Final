<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DonorProjection extends Model
{
	protected $primaryKey = 'donor_projection_id';

    public function donor()
    {
    	return $this->belongsTo(Donor::class);
    }
}
