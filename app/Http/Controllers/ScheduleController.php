<?php

namespace App\Http\Controllers;

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
}
