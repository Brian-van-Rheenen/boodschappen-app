<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionsController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function store()
    {
        // Attempt to authenticate the user
        if (! auth()->attempt(request(['email', 'password'])))
        {
            // Not logged in, return back with errors
            return back()->withErrors([
                'message' => 'Uw inloggegevens zijn incorrect.'
            ]);
        }

        // Redirect to the home page
        return redirect()->home();
    }

    public function destroy()
    {
        //Log out
        auth()->logout();

        //Redirect to the home page
        return redirect()->home();
    }
}
