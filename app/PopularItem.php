<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PopularItem extends Model
{
    protected $table = 'popular_items';
    protected $fillable = array(
        'productID',
        'description',
        'priceWas',
        'priceNow',
        'discount',
        'image',
        'popularity'
    );

    public function setProperties($data)
    {
        $this->productID = $data['productID'];
        $this->description = ucfirst($data['description']);
        $this->priceWas = $data['priceWas'] ?? null;
        $this->priceNow = $data['priceNow'];
        $this->discount = $data['discount'];
        $this->image = $data['image'] ?? null;
        $this->popularity++;
        $this->save();
    }
}
