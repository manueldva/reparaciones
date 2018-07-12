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
            $query->where('deliverDate', $valor)->orderBy('id', 'DESC');
        } else if ($type == 'id')
        {
            $query->where('id', $valor)->orderBy('id', 'DESC');
        } else if ($type == 'client') 
        {
			$query->whereHas('reception', function ($receptions) use($valor) {
				$receptions->whereHas('client', function ($clients) use($valor) {
    				$clients->where('name', 'like', '%' . $valor . '%');
    			})->orderBy('id', 'DESC');
			})->orderBy('id', 'DESC');
        } else
        {
            $query->orderBy('id', 'DESC');;
        }
    }
}
