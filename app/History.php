<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $table = 'histories';
    protected $fillable = array(
        'user',
        'textBefore',
        'description',
        'textAfter',
        'quantity'
    );

    public function getCreatedAtAttribute($value)
    {
        //Format the given date to day-month hour-minute
        date_default_timezone_set('Europe/Amsterdam');
        return date('j M, H:i', strtotime($value));
    }
}
