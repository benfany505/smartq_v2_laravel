<?php

namespace App\Http\Middleware;

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

        if (!$request->expectsJson()) {
            return ('/login');
        }
    }

    // if request from web browser, redirect to login page
    // if request from api, return 401

    // protected function unauthenticated($request, array $guards)
    // {
    //     // dd($request);
    //     $this->redirectTo($request);
    //     abort(response()->json(['message' => 'Unauthenticated.'], 401));
    // }
}
