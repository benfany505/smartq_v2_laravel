<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\TemporaryImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function store(Request $request)
    {
        $temporaryFolder = Session::get('folder');
        $namefile = Session::get('filename');

        $temporary = TemporaryImage::where('folder', $temporaryFolder)->where('image', $namefile)->first();

        if ($temporary) { //if exist

            Image::create([
                'folder' => $temporaryFolder,
                'image' => $namefile,
            ]);

            //hapus file and folder temporary
            $path = storage_path() . '/app/files/tmp/' . $temporary->folder . '/' . $temporary->image;
            if (File::exists($path)) {

                Storage::move('files/tmp/' . $temporary->folder . '/' . $temporary->image, 'files/' . $temporary->folder . '/' . $temporary->image);

                File::delete($path);
                rmdir(storage_path('app/files/tmp/' . $temporary->folder));

                //delete record in temporary table
                $temporary->delete();

                return response()->json(['status' => true, 'message' => 'Data Success']);
            }

            return response()->json(['status' => true, 'message' => 'Data Gagal']);

        }

        return response()->json(['status' => false, 'message' => 'Data Gagal']);
    }

}
