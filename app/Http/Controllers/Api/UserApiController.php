<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserApiController extends Controller
{
    // login
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $user = User::where('username', $request->username)->first();

        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $token = $user->createToken('MyApp')->accessToken;
                // add remember token
                $user = User::find($request->username);
                $user->remember_token = $request->$token;
                $success = $user->save();
                if ($success) {
                    return response()->json(['token' => $token], 200);
                }
                return response()->json(['error' => 'Token Failed'], 401);
            } else {
                return response()->json(['error' => 'Unauthorised'], 401);
            }
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }
    //
    public function index(Request $request)
    {

        // check jwt token
        $checkuser = JWTAuth::user();
        if (!$checkuser) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        // check if username and password are authenticated
        $user = User::where('username', $request->requestorUsername)->first();
        if (!$user || $user->role != 'administrator') {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized',
                'data' => $request->requestorUsername,
            ], 401);
        }
        // get all users except the authenticated user
        $users = User::where('username', '!=', $request->requestorUsername)->get();
        // $users = User::all();

        // return response
        return response()->json([
            'status' => true,
            'message' => 'Success',
            'data' => $users,
        ], 200);
    }

    public function fastindex(Request $request)
    {

        // check jwt token
        $checkuser = JWTAuth::user();
        if (!$checkuser) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        // check if username and password are authenticated
        $user = DB::table('users')->where('username', $request->requestorUsername)->first();
        // $user = User::where('username', $request->requestorUsername)->first();
        if (!$user || $user->role != 'administrator') {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized',
                'data' => $request->requestorUsername,
            ], 401);
        }
        // get all users except the authenticated user
        $users = DB::table('users')->where('username', '!=', $request->requestorUsername)->get();
        // $users = User::where('username', '!=', $request->requestorUsername)->get();
        // $users = User::all();

        // return response
        return response()->json([
            'status' => true,
            'message' => 'Success',
            'data' => $users,
        ], 200);
    }

    public function show($id, Request $request)
    {
        // check jwt token
        $checkuser = JWTAuth::user();
        if (!$checkuser) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }
        // check if username and password are authenticated
        $user = User::where('username', $request->requestorUsername)->first();
        if (!$user || !Hash::check($request->requestorpassword, $user->password) || $user->role != 'administrator') {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized',
                'data' => null,
            ], 401);
        }

        // get user except the authenticated user
        // $user = User::where('username', '!=', $request->requestorUsername)->where('id', $id)->first();
        $user = User::find($id);

        // return response
        return response()->json([
            'status' => true,
            'message' => 'User found',
            'data' => $user,
        ], 200);
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        if ($user->role != 'administrator') {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized',
                'data' => null,
            ], 401);
        }

        $success = User::create([
            'full_name' => $request->full_name,
            'username' => $request->username,
            'role' => $request->role,
            'password' => Hash::make($request->password),
            'created_by' => $user->requestorUsername,
        ]);

        if ($success) {
            $userData = User::where('username', $request->username)->first();
            if ($request->hasFile('photo')) {
                $file = $request->file('photo');
                $file->move(public_path('assets/dist/img'), 'user_photo_' . $userData->id . '.' . $file->getClientOriginalExtension());
                $userData->image_url = 'assets/dist/img/user_photo_' . $userData->id . '.' . $file->getClientOriginalExtension();
            }
            $success = $userData->save();

            if ($success) {
                return response()->json([
                    'success' => true,
                    'message' => 'User created successfully',
                    'data' => $success,
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'User creation failed',
                    'data' => $success,
                ], 501);
            }
        }

        if ($success) {
            return response()->json([
                'success' => true,
                'message' => 'User created successfully',
                'data' => $success,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'User creation failed',
                'data' => $success,
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        // check jwt token
        $checkuser = JWTAuth::user();
        if (!$checkuser) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }
        //check if username and password are authenticated
        $user = User::where('username', $request->requestorUsername)->first();
        if (!$user || !Hash::check($request->requestorpassword, $user->password) || $user->role != 'administrator') {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized',
                'data' => null,
            ], 401);
        }

        // validator
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'username' => 'required|string|username|max:255',
            'password' => 'required|string|min:6|',
            'role' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $user = User::find($id);
        $user->name = $request->name;
        $user->username = $request->username;
        $user->role = $request->role;
        $user->password = Hash::make($request->password);
        $success = $user->save();

        if ($success) {
            return response()->json([
                'success' => true,
                'message' => 'User updated successfully',
                'data' => $user,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'User not found',
                'data' => $user,
            ], 500);
        }
    }

    public function destroy(Request $request, $id)
    {
        // check jwt token
        $checkuser = JWTAuth::user();
        if (!$checkuser) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }
        ////check if username and password are authenticated
        $user = User::where('username', $request->requestorUsername)->first();
        if (!$user || $user->role != 'administrator') {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized',
                'data' => null,
            ], 401);
        }

        $user = User::find($id);
        $success = $user->delete();

        if ($success) {
            return response()->json([
                'success' => true,
                'message' => 'User deleted successfully',
                'data' => $user,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'User deletion failed',
                'data' => $user,
            ], 500);
        }
    }

    public function checkIsAdmin($request)
    {
    }
}
