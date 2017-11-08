<?php

namespace App\Http\Controllers;

use Auth;
use App\History;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HistoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //If the user is an admin
        if (Auth::user()->isAdmin())
        {
            //Retrieve the history and sort it by 'latest'
            $history = History::latest()
            ->get();

            //Return the history view and send the history data with it
            return view('history', compact('history'));
        }
        else
        {
            //Redirect the user to the home page
            return redirect()->home();
        }
    }
}
