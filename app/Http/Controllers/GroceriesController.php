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

        $data = request(['description', 'quantity']);
        $data['user'] = Auth::user()->getName();
        $data['completed'] = 0;

        $grocery = Groceries::create($data);

        $data = Log::createLog(
            Auth::user()->getName(),
            ' heeft ',
            $grocery->description,
            ' toegevoegd.',
            $grocery->id,
            $grocery->quantity . 'x'
        );

        return $grocery;
    }
    public function findById($id)
    {
        $grocery = Groceries::find($id);
        return $grocery;
    }
    public function update($id)
    {
        $grocery = Groceries::find($id);
        $grocery->completed = request()->completed;
        $grocery->save();

        if ($grocery->completed)
        {
            $textAfter = ' afgecheckt.';
        }
        else
        {
            $textAfter = ' ongedaan gemaakt.';
        }

        $data = Log::createLog(
            Auth::user()->getName(),
            ' heeft ',
            $grocery->description,
            $textAfter,
            $grocery->id
        );

        return $grocery;
    }
    public function reset()
    {
        Groceries::truncate();

        $data = Log::createLog(
            Auth::user()->getName(),
            ' heeft ',
            'de boodschappenlijst',
            ' gereset.'
        );

        return 'reset';
    }
}
