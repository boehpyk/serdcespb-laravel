<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $fillable = [
        'title',
        'description'
    ];


    /**
     * Get the photos for the gallery.
     */
    public function photos()
    {
        return $this->hasMany('App\Photo');
    }
}
