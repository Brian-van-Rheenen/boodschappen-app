<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use Illuminate\Http\Request;
use Mail;

class PasswordResetController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
        return view('passwordreset.request');
    }

    public function mail()
    {
        //Validate the data
        $this->validate(request(), [
            'email' => 'required|email'
        ]);

        //Find the user if it exists
        $user = User::where('email', '=', request('email'))->first();

        //If it does
        if ($user)
        {
            //Create temporary variables
            $password_reset = str_random(30);

            //Temporary array
            $data['password_reset'] = $password_reset;

            //Send a mail to the inserted emailaddress
            Mail::send('email.password', $data, function($message) {
                $message->to(request('email'))
                        ->subject('Boodschappen: Wijzig je wachtwoord');
            });

            $user->password_reset = $password_reset;
            $user->save();

            //Return success
            return 'success';
        }
        else
        {
            //Return error
            return 'error';
        }
    }

    public function show($password_reset)
    {
        //If there isn't a password_reset code
        if(!$password_reset)
        {
            //Show 404 not found
            return view('errors.404');
        }

        //Else, show the page
        return view('email.reset', compact('password_reset'));
    }

    public function update($password_reset)
    {
        //Validate the data
        $this->validate(request(), [
            'password' => 'required|min:5|confirmed'
        ]);

        //If there isn't a password_reset code
        if(!$password_reset)
        {
            //Return error
            return 'error';
        }

        //Find the user whom matches the password_reset code
        $user = User::wherePasswordReset($password_reset)->first();

        //If that user does not exist
        if (!$user)
        {
            //Return error
            return 'error';
        }

        //Create the user's properties
        $user->password = bcrypt(request('password'));
        $user->password_reset = null;
        $user->save();

        //If succesful
        if ($user->save())
        {
            //Login
            auth()->login($user);
            return 'success';
        }
    }
}