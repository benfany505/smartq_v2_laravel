<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UmumController extends Controller
{
    //
    public function index()
    {
        $request = Request::create('/api/umum', 'GET',
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
        $responseUmum = app()->handle($request);
        $responseUmum = json_decode($responseUmum->getContent());
        $responseUmum = $responseUmum->data;
        // get index 0
        $responseUmum = $responseUmum[0];
        // dump with content
        // dd($responseUmum);

        return view('konfigurasi.umum.umum', [
            'title' => 'Umum',
            'umum' => $responseUmum,
        ]);

    }
}
