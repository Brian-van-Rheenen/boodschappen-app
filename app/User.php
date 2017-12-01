<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password', 'role', 'confirmation_code', 'password_reset'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getName()
    {
        $user = $this->email;
        $user = ucfirst($user);
        $user = substr($user, 0, strpos($user, "@"));

        return $user;
    }

    public function isAdmin()
    {
        if($this->role == 'admin')
        {
            return true;
        }
        return false;
    }
}
