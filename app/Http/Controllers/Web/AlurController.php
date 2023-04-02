<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AlurController extends Controller
{
    //index
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

        $request = Request::create('/api/layanan', 'GET',
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

        // list layanan
        $request->headers->set('Authorization', 'Bearer ' . session()->get('tokenJwt'));
        $request->headers->set('Accept', 'application/json');
        $responseLayanan = app()->handle($request);
        // get "data" from response
        $responseLayanan = json_decode($responseLayanan->getContent());
        $responseLayanan = $responseLayanan->data;

        return view('konfigurasi.alur.alur', [
            'title' => 'Alur',
            'loket' => $responseLoket,
            'layanan' => $responseLayanan,

        ]);
    }
}
