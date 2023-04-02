<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoketController extends Controller
{
    public function index()
    {
        $request = Request::create('/api/loket', 'GET',
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

        // list loket
        $request->headers->set('Authorization', 'Bearer ' . session()->get('tokenJwt'));
        $request->headers->set('Accept', 'application/json');
        $responseLoket = app()->handle($request);
        // get "data" from response
        $responseLoket = json_decode($responseLoket->getContent());
        $responseLoket = $responseLoket->data;

        return view('konfigurasi.loket.loket', [
            'title' => 'Loket',
            'loket' => $responseLoket,
        ]);

    }
}
