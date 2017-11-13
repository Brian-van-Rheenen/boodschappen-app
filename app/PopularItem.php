<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PopularItem extends Model
{
    protected $table = 'popular_items';
    protected $fillable = array(
        'description',
        'image',
        'popularity'
    );
}
