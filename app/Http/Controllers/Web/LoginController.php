<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class LoginController extends Controller
{

    public function index()
    {
        return view('pages.auth.login');
    }

    public function authenticate(Request $request)
    {

        $credential = $request->validate([
            'username' => 'required|min:1',
            'password' => 'required|min:1',
        ]);

        if (Auth::attempt($credential)) {
            // Authentication passed...

            // login to api and get token
            $user = Auth::user();
            $token = JWTAuth::fromUser($user);
            // save token to session data
            $request->session()->regenerate();
            $request->session()->put('tokenJwt', $token);
            $request->session()->put('username', $user->username);

            $dataUser = User::where('username', $user->username)->first();
            $dataUser->remember_token = $token;
            $dataUser->last_login_at = date('Y-m-d H:i:s');
            // time stamp

            $dataUser->save();

            // dd($dataUser);

            return redirect()->intended('dashboard');
        }

        return redirect()->back()->withErrors(['username' => 'Invalid credentials']);

    }

    // refresh
    public function refresh(Request $request)
    {
        $token = $request->session()->get('tokenJwt');
        $request = Request::create('/api/refresh', 'POST',
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
        $response = app()->handle($request);

        if ($response->status() == 200) {
            $token = json_decode(json_encode($response->getData()), true);
            $token = $token['data'];

            $request->session()->regenerate();
            $request->session()->put('tokenJwt', $token);

            return redirect()->back();
        } else {
            // redirect
            return redirect('/dashboard');
        }

    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
