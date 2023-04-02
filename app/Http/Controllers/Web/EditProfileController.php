<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EditProfileController extends Controller
{
    public function show()
    {
        $request = Request::create('/api/edit_profile', 'GET',
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
        $responseProfile = app()->handle($request);

        if ($responseProfile->status() == 200) {
            $profile = json_decode($responseProfile->getContent());
            // dd($profile);
            // $profile = $profile->data;
            // $profile = $profile[0];
            return view('/profil_saya/edit_profile', [
                'title' => 'Edit Profile',
                'profile' => $profile,
            ]);
        }

    }
}
