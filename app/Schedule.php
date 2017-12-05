<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $table = 'schedules';

    public $timestamps = false;
    protected $fillable = array(
        'day',
        'productID',
        'description',
        'quantity',
        'priceWas',
        'priceNow',
        'discount',
        'image'
    );

    public function setProperties($data)
    {
        $this->day = $data['day'];
        $this->productID = $data['productID'];
        $this->description = ucfirst($data['description']);
        $this->quantity = $this->quantity + $data['quantity'];
        $this->priceWas = $data['priceWas'] ?? null;
        $this->priceNow = $data['priceNow'];
        $this->discount = $data['discount'];
        $this->image = $data['image'] ?? null;
        $this->save();
    }
}
