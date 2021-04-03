<?php

namespace App\Http\Middleware;

use App\Models\User;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if(!$request->expectsJson()){
            return route('login');
        }
    }

    protected function authenticate($request, array $guards)
    {
       $username = $request->server('AUTH_USER') ?? env('AUTH_USER');
       $username = strtoupper($username);
       /**
        * @var User
        */
       $user = User::where('username', $username)->first();
       if ($user === null){
           abort(401);
       }
       $this->auth->login($user);
    }
}
