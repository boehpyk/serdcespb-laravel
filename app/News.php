<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $guarded = [
        'is_publish',
        'image',
        'date'
    ];

    /**
     * @var array
     */
    protected $fillable = [
        'text',
        'widget',
    ];

    /**
     * The date are automatically converted into Carbon format
     * @var array
     */
    protected $dates = ['date'];

}
