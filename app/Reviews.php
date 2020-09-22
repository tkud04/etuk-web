<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reviews extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'rental_id', 'points', 'anon', 'service', 'location', 'value', 'cleanliness', 'comment', 'status'
    ];
    
}
