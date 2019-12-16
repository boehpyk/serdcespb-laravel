<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    protected $table = 'carousel';

    /**
     * The date are automatically converted into Carbon format
     * @var array
     */
    protected $dates = ['date_begin'];

}
