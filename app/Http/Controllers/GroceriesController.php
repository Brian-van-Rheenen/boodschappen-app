<?php

namespace App\Http\Controllers;

use Auth;
use App\Groceries;
use App\Log;
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

        //Insert the grocery into the database
        $grocery = Groceries::create($data);

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
    public function findById($id)
    {
        //Find the grocery by its id
        $grocery = Groceries::find($id);

        //Return that grocery
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
