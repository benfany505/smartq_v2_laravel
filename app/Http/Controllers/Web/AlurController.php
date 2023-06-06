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

        // alur
        $request = Request::create('/api/alur', 'GET',
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

        // list alur
        $request->headers->set('Authorization', 'Bearer ' . session()->get('tokenJwt'));
        $request->headers->set('Accept', 'application/json');
        $responseAlur = app()->handle($request);
        // get "data" from response
        $responseAlur = json_decode($responseAlur->getContent());
        $responseAlur = $responseAlur->data;

        // change $responseAlur list_loket to each $responseLoket nomor
        // foreach ($responseAlur as $key => $value) {
        //     $listLoket = explode(',', $value->list_loket);
        //     $listLoket = array_map('intval', $listLoket);
        //     $listLoket = array_map(function ($item) use ($responseLoket) {
        //         foreach ($responseLoket as $key => $value) {
        //             if ($item == $value->id) {
        //                 return $value->nomor;
        //             }
        //         }
        //     }, $listLoket);
        //     $responseAlur[$key]->list_loket = implode(',', $listLoket);
        // }

        // // change $responseAlur list_loket to each $responseLayanan kode
        // foreach ($responseAlur as $key => $value) {
        //     $listLayanan = explode(',', $value->list_layanan);
        //     $listLayanan = array_map('intval', $listLayanan);
        //     $listLayanan = array_map(function ($item) use ($responseLayanan) {
        //         foreach ($responseLayanan as $key => $value) {
        //             if ($item == $value->id) {
        //                 return $value->kode;
        //             }
        //         }
        //     }, $listLayanan);
        //     $responseAlur[$key]->list_layanan = implode(',', $listLayanan);
        // }

        // // change $responseAlur list_transfer to each $responseLoket nomor
        // foreach ($responseAlur as $key => $value) {
        //     $listTransfer = explode(',', $value->list_transfer);
        //     $listTransfer = array_map('intval', $listTransfer);
        //     $listTransfer = array_map(function ($item) use ($responseLoket) {
        //         foreach ($responseLoket as $key => $value) {
        //             if ($item == $value->id) {
        //                 return $value->nomor;
        //             }
        //         }
        //     }, $listTransfer);
        //     $responseAlur[$key]->list_transfer = implode(',', $listTransfer);
        // }

        
       

        return view('konfigurasi.alur.alur', [
            'title' => 'Alur',
            'loket' => $responseLoket,
            'layanan' => $responseLayanan,
            'alur' => $responseAlur,

        ]);
    }
}
