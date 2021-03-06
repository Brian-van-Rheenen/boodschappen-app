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

        //Sort the array
        Groceries::sortArray($groceries);

        //Return the groceries view and send the groceries with it
        return view('groceries', compact('groceries'));
    }
    public function specificPopularGroceries($description)
    {
        //Retrieve all the popular groceries
        $popularItem = PopularItem::where('description', 'like', '%' . $description . '%')
            ->get();

        //Sort the array
        Groceries::sortArray($popularItem);

        //Return the groceries
        return $popularItem;
    }
    public function allPopularGroceries()
    {
        //Retrieve all the popular groceries and order them by 'popularity'
        $popularItem = PopularItem::orderBy('popularity', 'DESC')
            ->get();

        //Sort the array
        Groceries::sortArray($popularItem);

        //Return the groceries
        return $popularItem;
    }
    public function allGroceries()
    {
        //Retrieve all the groceries and order them by 'completed' and 'latest'
        $groceries = Groceries::orderBy('completed')
            ->latest()
            ->get();

        //Sort the array
        Groceries::sortArray($groceries);

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
        $data = request(['productID', 'description', 'quantity', 'priceWas', 'priceNow', 'discount']);
        $data['user'] = Auth::user()->getName();
        $data['description'] = ucfirst(request('description'));
        $data['completed'] = 0;
        $data['image'] = request('image');

        //If there is a productID
        if (request('productID'))
        {
            //Find the grocery if it exists
            $grocery = Groceries::where('productID', '=', request('productID'))->where('completed', $data['completed'])->first();
        }
        else
        {
            //Find the grocery if it exists
            $grocery = Groceries::where('description', '=', request('description'))->where('completed', $data['completed'])->first();
        }

        //If it does
        if ($grocery)
        {
            //If it is completed
            if ($grocery->completed)
            {
                //Insert the grocery into the database
                $grocery = Groceries::create($data);
            }
            else
            {
                //Update properties
                $grocery->setProperties($data);
            }
        }
        else
        {
            //Insert the grocery into the database
            $grocery = Groceries::create($data);
        }

        //Find the grocery if it exists
        $popularItem = PopularItem::where('productID', '=', request('productID'))->first();

        //If it does
        if ($popularItem)
        {
            //Update properties
            $popularItem->setProperties($data);
        }
        else
        {
            //Temporary array to use
            $item['productID'] = request('productID');
            $item['description'] = preg_replace('/[^\x00-\x7f]/', '', $data['description']);
            $item['priceWas'] = request('priceWas');
            $item['priceNow'] = request('priceNow');
            $item['discount'] = request('discount');
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
