<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class Authenticate
{

    protected $auth;

    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }


    public function handle($request, Closure $next)
    {
        if ($this->auth->guest()) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('');
            }
        }

        if ($user = $this->auth->user()) {
            $user->user_agent = $_SERVER['HTTP_USER_AGENT'];
            $user->remote_addr = $_SERVER['REMOTE_ADDR'];
            $user->save();
        }

        return $next($request);
    }
}
