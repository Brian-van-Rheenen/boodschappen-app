<?php

namespace App\Http\Controllers;

use Auth;
use App\Groceries;
use App\Log;
use App\PopularItem;
use Illuminate\Http\Request;

class GroceriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //Retrieve all the groceries and order them by 'completed' and 'latest'
        $groceries = Groceries::orderBy('completed')
            ->latest()
            ->get();

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

        //Return the groceries view and send the groceries with it
        return view('groceries', compact('groceries'));
    }
    public function specificPopularGroceries($description)
    {
        //Retrieve all the popular groceries
        $popularItem = PopularItem::where('description', 'like', '%' . $description . '%')
            ->get();

        //Loop through the array
        for ($i = 0; $i < count($popularItem); $i++)
        {
            //2 decimals behind comma
            if ($popularItem[$i]->priceWas)
            {
                $popularItem[$i]->priceWas = number_format($popularItem[$i]->priceWas, 2);
            }
            $popularItem[$i]->priceNow = number_format($popularItem[$i]->priceNow, 2);
        }

        //Return the groceries
        return $popularItem;
    }
    public function allPopularGroceries()
    {
        //Retrieve all the popular groceries and order them by 'popularity'
        $popularItem = PopularItem::orderBy('popularity', 'DESC')
            ->get();

        //Loop through the array
        for ($i = 0; $i < count($popularItem); $i++)
        {
            //2 decimals behind comma
            if ($popularItem[$i]->priceWas)
            {
                $popularItem[$i]->priceWas = number_format($popularItem[$i]->priceWas, 2);
            }
            $popularItem[$i]->priceNow = number_format($popularItem[$i]->priceNow, 2);
        }

        //Return the groceries
        return $popularItem;
    }
    public function allGroceries()
    {
        //Retrieve all the groceries and order them by 'completed' and 'latest'
        $groceries = Groceries::orderBy('completed')
            ->latest()
            ->get();

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

        //Return the groceries
        return $groceries;
    }
    public function store()
    {
        //Validate the data
        $this->validate(request(), [
            'description' => 'required',
            'quantity' => 'required'
        ]);

        //Add properties to the form data
        $data = request(['description', 'quantity', 'priceWas', 'priceNow']);
        $data['user'] = Auth::user()->getName();
        $data['description'] = ucfirst(request('description'));
        $data['completed'] = 0;
        $data['image'] = request('image');

        //Find the grocery if it exists
        $grocery = Groceries::where('description', '=', request('description'))->first();

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
            $grocery = Groceries::create($data);
        }

        //Find the grocery if it exists
        $popularItem = PopularItem::where('description', '=', request('description'))->first();

        //If it does
        if ($popularItem)
        {
            //Popularity + 1
            $popularItem->popularity++;

            //Update values
            $popularItem->priceWas = request('priceWas');
            $popularItem->priceNow = request('priceNow');
            $popularItem->image = $data['image'];
            $popularItem->save();
        }
        else
        {
            //Temporary array to use
            $item['description'] = preg_replace('/[^\x00-\x7f]/', '', $data['description']);
            $item['priceWas'] = request('priceWas');
            $item['priceNow'] = request('priceNow');
            $item['image'] = $data['image'];
            $item['popularity'] = 1;

            //Create the grocery
            PopularItem::create($item);
        }

        //Create a history log and insert it into the database
        Log::createLog(
            Auth::user()->getName(),
            ' heeft ',
            $grocery->description,
            ' toegevoegd.',
            $data['quantity'] . 'x'
        );

        //Convert to int
        $grocery->quantity = (int)$grocery->quantity;
        $grocery->completed = (int)$grocery->completed;

        //Return the inserted grocery
        return $grocery;
    }
    public function update($id)
    {
        //Find the grocery by its id
        $grocery = Groceries::find($id);

        //Change the completed state
        $grocery->completed = request()->completed;

        //Save the changes
        $grocery->save();

        //If the grocery has been checked of
        if ($grocery->completed)
        {
            //Create text
            $textAfter = ' afgecheckt.';
        }
        else
        {
            //Create text
            $textAfter = ' ongedaan gemaakt.';
        }

        //Create a history log and insert it into the database
        Log::createLog(
            Auth::user()->getName(),
            ' heeft ',
            $grocery->description,
            $textAfter
        );

        //Return the saved grocery
        return $grocery;
    }
    public function destroy($id)
    {
        //Find the grocery by its id
        $grocery = Groceries::find($id);

        //Delete the grocery
        $grocery->delete();

        //Create a history log and insert it into the database
        Log::createLog(
            Auth::user()->getName(),
            ' heeft ',
            $grocery->description,
            ' verwijderd.'
        );
    }
    public function reset()
    {
        //Remove every grocery in the database
        Groceries::truncate();

        //Create a history log and insert it into the database
        Log::createLog(
            Auth::user()->getName(),
            ' heeft ',
            'de boodschappenlijst',
            ' gereset.'
        );
    }
}
