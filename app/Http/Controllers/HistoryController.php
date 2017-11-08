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
        if (Auth::user()->isAdmin())
        {
            $history = History::latest()
            ->get();

            return view('history', compact('history'));
        }
        else
        {
            return redirect()->home();
        }
    }
}
