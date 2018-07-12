<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reception extends Model
{
    
    protected $fillable = [
		'client_id', 'equipment_id', 'description' ,'file', 'reason_id', 'concept', 'status'
	];
	    

   	public function reason(){
		
		return $this->belongsTo(Reason::class);
	}

	public function equipment(){
		
		return $this->belongsTo(Equipment::class);
	}

	public function client(){
		
		return $this->belongsTo(Client::class);
	}



    public function deliveries(){
    	return $this->HasMany(Delivery::class);
    }

    public function scopeType($query, $type, $valor, $status) 
    {
		
		if ($type == 'id')
        {
            $query->where('id', $valor)->orderBy('id', 'DESC');
        } else if ($type == 'client') 
        {
			$query->whereHas('client', function ($clients) use($valor) {
    			$clients->where('name', 'like', '%' . $valor . '%');
			})->orderBy('id', 'DESC');
			//$query->client()->where('name', 'like', '%' . $valor . '%')->orderBy('id', 'ASC');
		} else if ($type == 'status') 
        {
			$query->where('status', $status)->orderBy('id', 'DESC');
			//$query->client()->where('name', 'like', '%' . $valor . '%')->orderBy('id', 'ASC');
				
        } else
        {
            $query->orderBy('id', 'DESC');
        }
    }

}
