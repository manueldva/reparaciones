<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    
    protected $fillable = [
		'name', 'address', 'cellPhone', 'phone', 'email'
	];
	    

    public function receptions(){
    	return $this->HasMany(Reception::class);
    }
}
