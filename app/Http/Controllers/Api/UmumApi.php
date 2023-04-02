<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Umum;
use App\Models\User;
use Illuminate\Http\Request;

class UmumApi extends Controller
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
        // get all users
        $umum = Umum::all();

        return response()->json([
            'status' => true,
            'message' => 'Successsss',
            'data' => $umum,
        ], 200);
    }

    // function store read FOrmData body

    // update using multipart/form-data
    public function update(Request $request, $id)
    {
        $umum = Umum::find($id);
        // check if file('logo') exist
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $file->move(public_path('assets/dist/img'), 'logoPerusahaan.' . $file->getClientOriginalExtension());
            $umum->logoUrl = 'assets/dist/img/logoPerusahaan.' . $file->getClientOriginalExtension();
        }
        $umum->perusahaan = $request->perusahaan;
        $umum->alamat1 = $request->alamat1;
        $umum->alamat2 = $request->alamat2;
        $umum->telp = $request->telp;
        $umum->mute = $request->mute;
        $umum->text = $request->text;
        $umum->mode_printer = $request->mode_printer;

        $umum->save();
        // check if success update
        if ($umum) {
            return response()->json([
                'status' => true,
                'message' => 'Success',
                'data' => $umum,
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Failed',
                'data' => null,
            ], 400);
        }

    }

}
