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
            $query->where('deliverDate', $valor)->orderBy('id', 'ASC');
        } else if ($type == 'id')
        {
            $query->where('id', $valor)->orderBy('id', 'ASC');
        } else if ($type == 'client') 
        {
        	$query->select('*')
			->from('deliveries as d')
			->join('receptions as r', function($join) {
				$join->on('d.reception_id', '=', 'r.id');
				})
			->join('clients as c', function($join) {
				$join->on('r.client_id', '=', 'c.id');
				})
			->where('c.name', 'like', '%' . $valor . '%')
			->orderBy('d.id', 'ASC');
        } else
        {
            $query;
        }
    }
}
