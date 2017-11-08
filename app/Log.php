<?php

namespace App;

use App\History;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    public static function createLog($user, $textBefore, $description, $textAfter, $groceryId = null, $quantity = null)
    {
        $data['groceryId'] = $groceryId;
        $data['user'] = $user;
        $data['textBefore'] = $textBefore;
        $data['description'] = strtolower($description);
        $data['textAfter'] = $textAfter;
        $data['quantity'] = $quantity;

        History::create($data);

        return $data;
    }
}
