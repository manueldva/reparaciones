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



    public function scopeType($query, $type, $valor) 
    {
		
		if ($type == 'address')
        {
            $query->where('address', 'like', '%' . $valor . '%')->orderBy('name');
        } else if ($type == 'client') 
        {
			//$query->where('id', $valor)->orderBy('id', 'ASC');
    		$query->where('name', 'like', '%' . $valor . '%')->orderBy('name');
			//$query->client()->where('name', 'like', '%' . $valor . '%')->orderBy('id', 'ASC');

        } else
        {
            $query->orderBy('name');
        }
    }
}
