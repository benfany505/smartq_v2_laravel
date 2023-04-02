<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;

class UsersController extends Controller
{
    //
    public function index()
    {
        $request = Request::create('/api/users', 'GET',
            [
                'requestorUsername' => auth()->user()->username,
            ],
            [],
            [],
            [
                'HTTP_HOST' => $_SERVER['SERVER_NAME'],
                'SERVER_NAME' => $_SERVER['SERVER_NAME'],
            ]

        );

        $request->headers->set('Authorization', 'Bearer ' . session()->get('tokenJwt'));
        $request->headers->set('Accept', 'application/json');
        $responseUsers = app()->handle($request);
        // get "data" from response
        $responseUsers = json_decode($responseUsers->getContent());
        $responseUsers = $responseUsers->data;

        return view('users.users', [
            'title' => 'Users',
            'users' => $responseUsers,
        ]);

    }

}
