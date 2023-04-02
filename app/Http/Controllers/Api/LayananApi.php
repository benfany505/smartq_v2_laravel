<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Layanan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LayananApi extends Controller
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
        $layanan = Layanan::all();

        return response()->json([
            'status' => true,
            'message' => 'Success',
            'data' => $layanan,
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

            'kode' => 'required',
            'nama' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        try {
            $success = Layanan::create([
                'kode' => $request->kode,
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
        } catch (\Illuminate\Database\QueryException$ex) {
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
            'kode' => 'required',
            'nama' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        try {
            $layanan = Layanan::find($id);
            $layanan->kode = $request->kode;
            $layanan->nama = $request->nama;
            $layanan->status = $request->status;
            $layanan->updated_by = $request->requestorUsername;
            $success = $layanan->save();
            if ($success) {
                return response()->json([
                    'success' => true,
                    'message' => 'Update successfully',
                    'data' => $success,
                ]);
            }
        } catch (\Illuminate\Database\QueryException$ex) {
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

        $layanan = Layanan::find($id);
        $success = $layanan->delete();
        if ($success) {
            return response()->json([
                'success' => true,
                'message' => 'Delete successfully',
                'data' => $success,
            ]);
        }
    }
}
