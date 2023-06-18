<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Loket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LoketApi extends Controller
{
    public function index(Request $request)
    {

        $user = User::where('username', $request->requestorUsername)->first();
        if (!$user || $user->role != 'administrator') {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized',
                'data' => null,
            ], 401);
        }
        // get all users
        $loket = Loket::orderBy('nomor', 'asc')->get();

        return response()->json([
            'status' => true,
            'message' => 'Successsss',
            'data' => $loket,
        ], 200);
    }

    public function create(Request $request)
    {
        $user = User::where('username', $request->requestorUsername)->first();
        if (!$user || $user->role != 'administrator') {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized',
                'data' => null,
            ], 401);
        }

        // validator
        $validator = Validator::make($request->all(), [

            'nomor' => 'required',
            'nama' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        try {
            $success = Loket::create([
                'nomor' => $request->nomor,
                'nama' => $request->nama,
                'status' => $request->status,
                'created_by' => $request->requestorUsername,
            ]);
            if ($success) {
                return response()->json([
                    'success' => true,
                    'message' => 'User created successfully',
                    'data' => $success,
                ]);
            }
        } catch (\Illuminate\Database\QueryException $ex) {
            return response()->json([
                'success' => false,
                'message' => $ex->getMessage(),
                // 'data' => $success,
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {

        //check if username and password are authenticated
        $user = User::where('username', $request->requestorUsername)->first();
        if (!$user || $user->role != 'administrator') {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized',
                'data' => null,
            ], 401);
        }

        // validator
        $validator = Validator::make($request->all(), [
            'nomor' => 'required',
            'nama' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        try {
            $loket = Loket::find($id);
            $loket->nomor = $request->nomor;
            $loket->nama = $request->nama;
            $loket->status = $request->status;
            $loket->updated_by = $request->requestorUsername;
            $success = $loket->save();
            if ($success) {
                return response()->json([
                    'success' => true,
                    'message' => 'Update successfully',
                    'data' => $success,
                ]);
            }
        } catch (\Illuminate\Database\QueryException $ex) {
            return response()->json([
                'success' => false,
                'message' => $ex->getMessage(),
                // 'data' => $success,
            ], 500);
        }
    }

    // delete
    public function destroy(Request $request, $id)
    {
        //check if username and password are authenticated
        $user = User::where('username', $request->requestorUsername)->first();
        if (!$user || $user->role != 'administrator') {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized',
                'data' => null,
            ], 401);
        }

        $loket = Loket::find($id);
        $success = $loket->delete();
        if ($success) {
            return response()->json([
                'success' => true,
                'message' => 'Delete successfully',
                'data' => $success,
            ]);
        }
    }
}
