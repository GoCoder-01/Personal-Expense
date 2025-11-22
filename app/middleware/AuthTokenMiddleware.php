<?php
namespace App\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserToken;

class AuthTokenMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if(!session()->has('user_id') || !session()->has('token')) 
        {
            return redirect()->route('login')->with('Your session has been expired, login again');
        }

        $user_id = session('user_id');
        $token = session('token');

        $tokenData = UserToken::where('user_id', $user_id)
                        ->where('token', $token)
                        ->where('token_status', '1')
                        ->first();

        if(!$tokenData) 
        {
            session()->flush();
            return redirect()->route('login')->with('Token has been expired, login again');
        }

        return $next($request);
    }
}
