<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FIleUploadController extends Controller
{
    //
    public function FileUpload(Request $request)
    {
        $uploadedFIles = $request->file->store('public/uploads');

        return response()->json([
            'status' => true,
            'message' => 'Successsss',
            'data' => $uploadedFIles,
        ], 200);

    }
}
