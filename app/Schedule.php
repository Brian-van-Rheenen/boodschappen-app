<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $table = 'schedules';

    public $timestamps = false;
    protected $fillable = array(
        'day',
        'description',
        'quantity',
        'image'
    );
}
