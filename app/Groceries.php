<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Groceries extends Model
{
    protected $table = 'groceries';
    protected $fillable = array(
        'user',
        'productID',
        'description',
        'quantity',
        'priceWas',
        'priceNow',
        'completed',
        'image'
    );

    public function setProperties($data)
    {
        $this->user = $data['user'];
        $this->productID = $data['productID'];
        $this->description = ucfirst($data['description']);
        $this->quantity = $this->quantity + $data['quantity'];
        $this->priceWas = $data['priceWas'] ?? null;
        $this->priceNow = $data['priceNow'];
        $this->completed = $data['completed'];
        $this->image = $data['image'] ?? null;
        $this->save();
    }

    public static function sortArray($groceries)
    {
        //Loop through the array
        for ($i = 0; $i < count($groceries); $i++)
        {
            //2 decimals behind comma
            if ($groceries[$i]->priceWas)
            {
                $groceries[$i]->priceWas = number_format($groceries[$i]->priceWas, 2);
            }
            $groceries[$i]->priceNow = number_format($groceries[$i]->priceNow, 2);

            //Convert to int
            $groceries[$i]->quantity = (int)$groceries[$i]->quantity;
            $groceries[$i]->completed = (int)$groceries[$i]->completed;
        }

        return $groceries;
    }
}
