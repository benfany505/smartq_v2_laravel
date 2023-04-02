<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LayananController extends Controller
{
    //
    public function index()
    {
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

        return view('konfigurasi.layanan.layanan', [
            'title' => 'Layanan',
            'layanan' => $responseLayanan,
        ]);

    }

}
