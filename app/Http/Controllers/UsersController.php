<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use Illuminate\Http\Request;
use Mail;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //Retrieve the users
        $users = User::get();
        $user = Auth::user();

        //Show the page
        return view('users', compact('user', 'users'));
    }

    public function store()
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
            //Create a flash message
            $message['description'] = $user->email . ' bestaat al.';
            $message['type'] = 'error';
            return ['duplicate', $message];
        }
        else
        {
            //Create temporary variables
            $temp_password = str_random(30);
            $confirmation_code = str_random(30);

            // Create and save the user
            $user = User::create([
                'email' => request('email'),
                'password' => bcrypt($temp_password),
                'role' => request('role'),
                'confirmation_code' => $confirmation_code
            ]);

            //Temporary array
            $data['confirmation_code'] = $confirmation_code;

            //Send a mail to the created emailaddress
            Mail::send('email.verify', $data, function($message) {
                $message->to(request('email'))
                        ->subject('Boodschappen: Verifieer je account');
            });

            //Create a flash message
            $message['description'] = 'Account voor ' . $user->email . ' aangemaakt.';
            $message['type'] = 'success';
            $email['description'] = 'Er is een e-mail verzonden naar ' . $user->email . '.';
            $email['type'] = 'success';

            //Return to the view
            return [$user, $message, $email];
        }
    }

    public function update($id)
    {
        //Validate the data
        $this->validate(request(), [
            'email' => 'required|email'
        ]);

        //Find the user by its id
        $user = User::find($id);

        //Change the user properties
        $user->email = request()->email;
        $user->role = request()->role;

        //Save the changes
        $user->save();

        //Create a flash message
        $message['description'] = 'Veranderingen succesvol opgeslagen.';
        $message['type'] = 'success';

        //Return the saved user
        return [$user, $message];
    }

    public function destroy($id)
    {
        //Find the user by its id
        $user = User::find($id);

        //If the users are the same
        if ($user == Auth::user())
        {
            //Create a flash message
            $message['description'] = 'Je kan jezelf niet verwijderen..';
            $message['type'] = 'error';
            return $message;
        }

        //Delete the user
        $user->delete();

        //Create a flash message
        $message['description'] = $user->email . ' is verwijderd.';
        $message['type'] = 'success';
        return $message;
    }
}
