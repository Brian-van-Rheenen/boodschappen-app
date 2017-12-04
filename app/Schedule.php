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
        'priceWas',
        'priceNow',
        'image'
    );

    public function setProperties($data)
    {
        $this->day = $data['day'];
        $this->description = ucfirst($data['description']);
        $this->quantity = $this->quantity + $data['quantity'];
        $this->priceWas = $data['priceWas'] ?? null;
        $this->priceNow = $data['priceNow'];
        $this->image = $data['image'] ?? null;
        $this->save();
    }
}
