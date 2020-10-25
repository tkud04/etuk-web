<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Preferences extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'user_id', 'city', 'state', 'id_required', 'amount', 'children', 'max_adults', 'max_children', 'pets', 'payment_type', 'rating'
    ];
}
