<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EditProfileApi extends Controller
{
    //
    // show current user
    public function show()
    {
        $user = auth()->user();
        return response()->json($user);
    }

    // update current user
    public function update(Request $request)
    {
        $user = auth()->user();
        $userData = User::find($user->id);
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $file->move(public_path('assets/dist/img'), 'user_photo_' . $user->id . '.' . $file->getClientOriginalExtension());
            $userData->image_url = 'assets/dist/img/user_photo_' . $user->id . '.' . $file->getClientOriginalExtension();
        }
        $userData->full_name = $request->full_name;
        $userData->username = $request->username;

        $userData->save();
        $user->username = $request->username;

        if ($user) {
            return response()->json([
                'status' => true,
                'message' => 'Success',
                'data' => $user,
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Failed',
                'data' => null,
            ], 400);
        }

    }

    public function updateById(Request $request, $id)
    {
        $user = auth()->user();
        if ($user->role != 'administrator') {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized',
                'data' => null,
            ], 401);
        }
        $userData = User::find($id);
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $file->move(public_path('assets/dist/img'), 'user_photo_' . $userData->id . '.' . $file->getClientOriginalExtension());
            $userData->image_url = 'assets/dist/img/user_photo_' . $userData->id . '.' . $file->getClientOriginalExtension();
        }
        $userData->full_name = $request->full_name;
        $userData->username = $request->username;
        $userData->role = $request->role;
        $success = $userData->save();
        if ($success) {
            return response()->json([
                'status' => true,
                'message' => 'Success',
                'data' => $userData,
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Failed',
                'data' => null,
            ], 400);
        }

    }

    // create funtion to edit password based on id, if requiestor is administrator
    public function updatePasswordById(Request $request, $id)
    {
        $user = auth()->user();
        if ($user->role != 'administrator') {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized',
                'data' => null,
            ], 401);
        }

        $userData = User::find($id);
        $userData->password = Hash::make($request->password);
        $success = $userData->save();
        if ($success) {
            return response()->json([
                'status' => true,
                'message' => 'Success',
                'data' => $userData,
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Failed',
                'data' => null,
            ], 400);
        }
    }

    // update password
    public function updatePassword(Request $request)
    {
        $user = auth()->user();
        if (!$user || !Hash::check($request->current_password, $user->password)) {
            return response()->json([
                'status' => false,
                'message' => 'Password Lama Tidak Sesuai',
                'data' => null,
            ], 401);
        } else {
            $userData = User::find($user->id);
            $userData->password = Hash::make($request->new_password);
            $success = $userData->save();
            if ($success) {
                return response()->json([
                    'status' => true,
                    'message' => 'Success',
                    'data' => $user,
                ], 200);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Failed',
                    'data' => $user,
                ], 400);
            }
        }
    }

}
