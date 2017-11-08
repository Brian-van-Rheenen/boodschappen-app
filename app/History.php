<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $table = 'histories';
    protected $fillable = array(
        'groceryId',
        'user',
        'textBefore',
        'description',
        'textAfter',
        'quantity'
    );

    public function getCreatedAtAttribute($value)
    {
        date_default_timezone_set('Europe/Amsterdam');
        return date('j M, H:i', strtotime($value));
    }
}
