<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show()
    {
        $request = Request::create('/api/auth/me', 'GET',
            [
                'requestoremail' => auth()->user()->email,
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
        $responseProfile = app()->handle($request);

        if ($responseProfile->status() == 200) {
            $profile = json_decode(json_encode($responseProfile->getData()), true);
            // $profile = $responseProfile['data'];
            // dd($profile);
            return view('/my_profile/edit_profile', [
                'title' => 'Edit Profile',
                'profile' => $profile,
            ]);
        }

    }
}
