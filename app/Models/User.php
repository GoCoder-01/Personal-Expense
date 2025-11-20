<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    protected $table = 'users';
    use HasFactory, Notifiable;
    protected $fillable = [
        'name', 'email', 'username', 'password', 'otp_max_count', 'pass_max_count', 'is_active', 'last_otp_sent_at'
    ];

    public static function checkUsername($username)
    {
        return User::select('*')->where('username', '=', $username)->first();
    }

    public static function checkUserActive($userid)
    {
        $user = User::select('*')->where('id', '=', $userid)->where('active_status', '=', '1')->first();

        if(is_null($user))
        {
            return false;
        }

        return $user;
    }

    public static function checkUserid($userid)
    {
        $user = User::find($userid);

        if(is_null($user))
        {
            return false;
        }
        
        return $user;
    }
}
