<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApartmentDetails extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'apartment_id', 'category','property_type','max_children','amount','landmarks'
	];
}
