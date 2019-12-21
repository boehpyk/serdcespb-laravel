<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    /**
     * Properties available for fot massive deployment
     * @var array
     */
    protected $fillable = [
        'title'
    ];

    /**
     * Get the gallery that owns the photo.
     */
    public function gallery()
    {
        return $this->belongsTo('App\Gallery');
    }
}
