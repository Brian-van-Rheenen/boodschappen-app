<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionsController extends Controller
{
    public function store()
    {
        // Attempt to authenticate the user
        if (! auth()->attempt(request(['email', 'password'])))
        {
            return back()->withErrors([
                'message' => 'Uw inloggegevens zijn incorrect.'
            ]);
        }

        // Redirect to the home page
        return redirect()->home();
    }
}
