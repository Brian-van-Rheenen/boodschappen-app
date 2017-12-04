<?php

namespace App\Http\Controllers;

use App\PopularItem;
use App\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //Retrieve the schedule
        $schedule = Schedule::get();

        //Show the page
        return view('schedule', compact('schedule'));
    }

    public function store()
    {
        //Validate the data
        $this->validate(request(), [
            'description' => 'required',
            'quantity' => 'required'
        ]);

        //Add properties to the form data
        $data = request(['day', 'description', 'quantity', 'priceWas', 'priceNow']);
        $data['description'] = ucfirst(request('description'));
        $data['image'] = request('image');

        //Find the grocery if it exists
        $grocery = Schedule::where('description', '=', request('description'))
                           ->where('day', '=', request('day'))
                           ->first();

        //If it does
        if ($grocery)
        {
            //Quantity + 1
            $grocery->quantity = $grocery->quantity + $data['quantity'];
            $grocery->priceWas = request('priceWas');
            $grocery->priceNow = request('priceNow');
            $grocery->image = $data['image'];
            $grocery->save();
        }
        else
        {
            //Insert the grocery into the database
            $grocery = Schedule::create($data);
        }

        //Find the grocery if it exists
        $popularItem = PopularItem::where('description', '=', request('description'))->first();

        //If it does
        if ($popularItem)
        {
            //Update values
            $popularItem->priceWas = request('priceWas');
            $popularItem->priceNow = request('priceNow');
            $popularItem->image = $data['image'];
            $popularItem->save();
            return $popularItem;
        }

        //Convert to int
        $grocery->quantity = (int)$grocery->quantity;

        //Return the inserted grocery
        return $grocery;
    }

    public function destroy($id)
    {
        //Find the scheduled grocery by its id
        $grocery = Schedule::find($id);

        //Delete the scheduled grocery
        $grocery->delete();
    }
}
