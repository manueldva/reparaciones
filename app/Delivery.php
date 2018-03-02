<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    
    protected $fillable = [
		'reception_id', 'deliverDate', 'workPrice', 'workDone'
	];
	    

	public function reception(){
		
		return $this->belongsTo(Reception::class);
	}
}
