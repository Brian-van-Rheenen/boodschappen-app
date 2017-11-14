<?php

namespace App;

use App\History;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    public static function createLog($user, $textBefore, $description, $textAfter, $quantity = null)
    {
        //Create and fill the properties in the array
        $data['user'] = $user;
        $data['textBefore'] = $textBefore;
        $data['description'] = strtolower($description);
        $data['textAfter'] = $textAfter;
        $data['quantity'] = $quantity;

        //Insert the history log into the database
        History::create($data);
    }
}
