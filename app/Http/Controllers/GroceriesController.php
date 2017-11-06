<?php

namespace App\Http\Controllers;

use App\Groceries;
use Illuminate\Http\Request;

class GroceriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $groceries = Groceries::orderBy('completed')
            ->latest()
            ->get();

        return view('groceries', compact('groceries'));
    }
    public function store()
    {
        $this->validate(request(), [
            'description' => 'required',
            'quantity' => 'required'
        ]);

        $grocery = new Groceries(request(['description', 'quantity']), 'false');
        $grocery->save();

        // And then redirect to the home page
        return redirect('/boodschappen');
    }
}
