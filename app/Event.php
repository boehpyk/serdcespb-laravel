<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $guarded = [
        'is_publish',
        'date_begin',
        'date_end',
        'cover'
    ];

    /**
     * The date are automatically converted into Carbon format
     * @var array
     */
    protected $dates = ['date_begin', 'date_end'];

}
