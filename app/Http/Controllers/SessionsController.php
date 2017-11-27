<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class SessionsController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function store()
    {
        $credentials = [
            'email' => request('email'),
            'password' => request('password'),
            'confirmed' => 1
        ];
        // Attempt to authenticate the user
        if (! auth()->attempt($credentials))
        {
            // Not logged in, return back with errors
            return back()->withErrors([
                'message' => 'Uw inloggegevens zijn incorrect of uw account is nog niet geverifieerd.'
            ]);
        }

        // Redirect to the home page
        return redirect()->home();
    }

    public function show($confirmation_code)
    {
        //If there isn't a confirmation code
        if(!$confirmation_code)
        {
            //Show 404 not found
            return view('errors.404');
        }

        //Else, show the page
        return view('email.activation', compact('confirmation_code'));
    }

    public function update($confirmation_code)
    {
        //Validate the data
        $this->validate(request(), [
            'password' => 'required|min:5|confirmed'
        ]);

        //If there isn't a confirmation code
        if(!$confirmation_code)
        {
            //Return error
            return 'error';
        }

        //Find the user whom matches the confirmation code
        $user = User::whereConfirmationCode($confirmation_code)->first();

        //If that user does not exist
        if (!$user)
        {
            //Return error
            return 'error';
        }

        //Create the user's properties
        $user->password = bcrypt(request('password'));
        $user->confirmed = 1;
        $user->confirmation_code = null;
        $user->save();

        //If succesful
        if ($user->save())
        {
            //Login
            auth()->login($user);
            return 'success';
        }
    }

    public function destroy()
    {
        //Log out
        auth()->logout();

        //Redirect to the home page
        return redirect()->home();
    }
}
