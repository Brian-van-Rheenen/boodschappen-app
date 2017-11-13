<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
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
            //Return the history view and send the history data with it
            return view('users');
        }
        else
        {
            //Redirect the user to the home page
            return redirect()->home();
        }
    }

    public function store()
    {
        //Validate the data
        $this->validate(request(), [
            'email' => 'required',
            'password' => 'required|min:5|confirmed'
        ]);

        // Create and save the user
        $user = User::create([
            'email' => request('email'),
            'password' => bcrypt(request('password')),
            'role' => request('role')
        ]);

        session()->flash('message', 'Account voor ' . $user->email . ' aangemaakt.');

        return view('users');
    }
}
