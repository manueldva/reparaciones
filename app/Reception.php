<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reception extends Model
{
    
    protected $fillable = [
		'client_id', 'equipment_id', 'description', 'reason_id', 'concept', 'status'
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
}
