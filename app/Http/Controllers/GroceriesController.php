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

        //Return the groceries view and send the groceries with it
        return view('groceries', compact('groceries'));
    }
    public function specificPopularGroceries($description)
    {
        //Retrieve all the popular groceries
        $popularItem = PopularItem::where('description', 'like', '%' . $description . '%')
            ->get();

        //Return the groceries
        return $popularItem;
    }
    public function allPopularGroceries()
    {
        //Retrieve all the popular groceries and order them by 'popularity'
        $popularItem = PopularItem::orderBy('popularity', 'DESC')
            ->get();

        //Return the groceries
        return $popularItem;
    }
    public function allGroceries()
    {
        //Retrieve all the groceries and order them by 'completed' and 'latest'
        $groceries = Groceries::orderBy('completed')
            ->latest()
            ->get();

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
        $data = request(['description', 'quantity']);
        $data['user'] = Auth::user()->getName();
        $data['description'] = ucfirst(request('description'));
        $data['completed'] = 0;
        $data['image'] = request('image');

        //Find the grocery if it exists
        $grocery = Groceries::where('description', '=', request('description'))->first();

        //If it does
        if ($grocery) {

            //Quantity + 1
            $grocery->quantity = $grocery->quantity + $data['quantity'];
            $grocery->image = $data['image'];
            $grocery->save();

            $isNew = false;
        }
        else
        {
            //Insert the grocery into the database
            $grocery = Groceries::create($data);

            $isNew = true;
        }

        //Find the grocery if it exists
        $popularItem = PopularItem::where('description', '=', request('description'))->first();

        //If it does
        if ($popularItem) {

            //Popularity + 1
            $popularItem->popularity++;
            $popularItem->image = $data['image'];
            $popularItem->save();
        }
        else
        {

            //Temporary array to use
            $item['description'] = preg_replace('/[^\x00-\x7f]/', '', $data['description']);
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
            $grocery->quantity . 'x'
        );

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

        return 'reset';
    }
}
