<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Groceries extends Model
{
    protected $table = 'groceries';
    protected $fillable = array(
        'user',
        'description',
        'quantity',
        'completed'
    );
}
