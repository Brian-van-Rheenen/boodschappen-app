<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //Show the page
        return view('settings');
    }

    public function update($id)
    {
        //Validate the data
        $this->validate(request(), [
            'password' => 'required|min:5|confirmed'
        ]);

        //Find the user by its id
        $user = User::find($id);

        //Change the user's password
        $user->password = bcrypt(request('password'));

        //Save the changes
        $user->save();

        //Create a flash message
        $message['description'] = 'Wachtwoord succesvol opgeslagen.';
        $message['type'] = 'success';

        //Return the message
        return $message;
    }
}
