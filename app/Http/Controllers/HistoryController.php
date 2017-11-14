<?php

namespace App\Http\Controllers;

use Auth;
use App\History;
use Illuminate\Http\Request;

class HistoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //Retrieve the history and sort it by 'latest'
        $history = History::latest()
        ->get();

        //Return the history view and send the history data with it
        return view('history', compact('history'));
    }

    public function entireHistory()
    {
        //Retrieve the history and sort it by 'latest'
        $history = History::latest()
        ->get();

        //Return the history data
        return $history;
    }
}
