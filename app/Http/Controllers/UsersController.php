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
        //Show the page
        return view('users');
    }

    public function store()
    {
        session()->forget('error');
        session()->forget('message');

        //Validate the data
        $this->validate(request(), [
            'email' => 'required|email',
            'password' => 'required|min:5|confirmed'
        ]);

        //Find the user if it exists
        $user = User::where('email', '=', request('email'))->first();

        //If it does
        if ($user)
        {
            //Create a flash message
            session()->flash('error', $user->email . ' bestaat al.');
        }
        else
        {
            // Create and save the user
            $user = User::create([
                'email' => request('email'),
                'password' => bcrypt(request('password')),
                'role' => request('role')
            ]);

            //Create a flash message
            session()->flash('message', 'Account voor ' . $user->email . ' aangemaakt.');
        }

        //Return to the view
        return view('users');
    }
}
