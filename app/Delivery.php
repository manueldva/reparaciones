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


	public function scopeType($query, $type, $valor) 
    {
        if ($type == 'date'){
            $query->where('deliverDate', $valor);
        } else if ($type == 'id')
        {
            $query->where('id', $valor);
        } else 
        {
            $query;
        }
    }
}
