<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Alur;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AlurApiController extends Controller
{
    //
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

        //  get all alurs
        $alur = Alur::all();
       
        return response()->json([
            'status' => true,
            'message' => 'Success',
            'data' => $alur,
        ], 200);
    }

    // store alur
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
        // {"nama":"1","list_loket":"1","list_layanan":"19","list_transfer":"5,6,7,8,9,10","requestorUsername":"etn"}
        // validator
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'list_loket' => 'required',
            'list_layanan' => 'required',
            'list_transfer' => 'required',
            
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        try {
            $success = Alur::create([
                'nama' => $request->nama,
                'list_loket' => $request->list_loket,
                'list_layanan' => $request->list_layanan,
                'list_transfer' => $request->list_transfer,
                'keterangan' => $request->keterangan,
                'status' => 1,
                'created_by' => $request->requestorUsername,
            
            ]);

            if ($success) {
                return response()->json([
                    'success' => true,
                    'message' => 'Alur created successfully',
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

    // update alur
    public function update(Request $request, $id)
    {
        $user = User::where('username', $request->requestorUsername)->first();
        if (!$user || $user->role != 'administrator') {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized',
                'data' => null,
            ], 401);
        }
        // {"nama":"1","list_loket":"1","list_layanan":"19","list_transfer":"5,6,7,8,9,10","requestorUsername":"etn"}
        // validator
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'list_loket' => 'required',
            'list_layanan' => 'required',
            'list_transfer' => 'required',
            
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        try {
            $success = Alur::where('id', $id)->update([
                'nama' => $request->nama,
                'list_loket' => $request->list_loket,
                'list_layanan' => $request->list_layanan,
                'list_transfer' => $request->list_transfer,
                'keterangan' => $request->keterangan,
                'status' => 1,
                'updated_by' => $request->requestorUsername,
            
            ]);

            if ($success) {
                return response()->json([
                    'success' => true,
                    'message' => 'Alur updated successfully',
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

    // destroy alur
    public function destroy(Request $request, $id)
    {
        $user = User::where('username', $request->requestorUsername)->first();
        if (!$user || $user->role != 'administrator') {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized',
                'data' => null,
            ], 401);
        }

        try {
            $success = Alur::where('id', $id)->delete();

            if ($success) {
                return response()->json([
                    'success' => true,
                    'message' => 'Alur deleted successfully',
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
    
}
