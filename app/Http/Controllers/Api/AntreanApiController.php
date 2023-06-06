<?php

namespace App\Http\Controllers\Api;

use App\Models\Alur;
use App\Models\User;
use App\Models\Antrean;
use App\Models\Layanan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AntreanApiController extends Controller
{
    //index
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

        //  get all antreans
        $antrean = Antrean::all();
       
        return response()->json([
            'status' => true,
            'message' => 'Success',
            'data' => $antrean,
        ], 200);
    }

    // store antrean
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
            'kode_layanan' => 'required',            
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // check if kode_layanan is exist in table layanan
        $layanan = Layanan::where('kode', $request->kode_layanan)->first();
        if (!$layanan) {
            return response()->json([
                'status' => false,
                'message' => 'Kode Layanan not found',
                'data' => null,
            ], 404);
        }

        // get remaining sisa_antrean with kode_layanan and status_panggilan = false
        $sisa_antrean = Antrean::where('kode_layanan', $request->kode_layanan)->where('status_panggilan', false)->count(); 
        $toal_antrean = Antrean::where('kode_layanan', $request->kode_layanan)->count();
        $nomor_antrean = $toal_antrean + 1;
        

        try {
            $antrean = Antrean::create([
                'kode_layanan' => $request->kode_layanan,
                'nomor_antrean' => $nomor_antrean, // 'nomor_antrean' => $request->nomor_antrean,
                'sisa_antrean' => $sisa_antrean,
                'created_by' => $request->requestorUsername,                
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Success',
                'data' => $antrean,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed',
                'data' => $e->getMessage(),
            ], 500);
        }
    }

    // update antrean
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

        // validator
        $validator = Validator::make($request->all(), [
            'kode_layanan' => 'required',
            'kode_loket' => 'required',
            'status_panggilan' => 'required',
            'jumlah_recall' => 'required',
            'sisa_antrean' => 'required',
            'created_by' => 'required',
            'updated_by' => 'required',
            'deleted_by' => 'required',
            
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        try {
            $antrean = Antrean::find($id);
            $antrean->update([
                'kode_layanan' => $request->kode_layanan,
                'kode_loket' => $request->kode_loket,
                'status_panggilan' => $request->status_panggilan,
                'jumlah_recall' => $request->jumlah_recall,
                'sisa_antrean' => $request->sisa_antrean,
                'created_by' => $request->created_by,
                'updated_by' => $request->requestorUsername,
                'deleted_by' => $request->deleted_by,
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Success',
                'data' => $antrean,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed',
                'data' => $e->getMessage(),
            ], 500);
        }
    }

    // panggil antrean
    public function panggil(Request $request)
    {
        $user = User::where('username', $request->requestorUsername)->first();
        if (!$user || $user->role != 'administrator') {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized',
                'data' => null,
            ], 401);
        }

        // {
        //     "requestorUsername" : "etn",
        //     "nama" : "1",
        //     "list_loket" : "1",
        //     "list_layanan" : "A",
        //     "list_transfer" : "3"
        // }

        // check if above data is suitable with alur
        $alur = Alur::where('nama', $request->nama)->where('list_layanan', $request->list_layanan)->first();
        if (!$alur) {
            return response()->json([
                'status' => false,
                'message' => 'Alur not found',
                'data' => null,
            ], 404);
        }

        // check if list_transfer is available in tabel alur field list_transfer (array string)
        $list_transferAlur = explode(',', $alur->list_transfer);
        $list_transferRequest = explode(',', $request->list_transfer);
        $check = array_intersect($list_transferRequest, $list_transferAlur);
        if (count($check) != count($list_transferRequest)) {
            return response()->json([
                'status' => false,
                'message' => 'List Transfer not found',
                'data' => null,
            ], 404);
        }

        $list_layananAlur = explode(',', $alur->list_layanan);
        $list_layananRequest = explode(',', $request->list_layanan);
        $check = array_intersect($list_layananRequest, $list_layananAlur);
        if (count($check) != count($list_layananRequest)) {
            return response()->json([
                'status' => false,
                'message' => 'List Layanan not found',
                'data' => null,
            ], 404);
        }


        // get antrean with kode_layanan and status_panggilan = false

       

        // check if list_transfer is not empty
        if ($request->list_transfer != '') {
        //   update latest antrean where status_panggilan = true
            $antreanLatest = Antrean::where('kode_layanan', $request->list_layanan)
                            ->where('kode_loket', $request->list_loket)
                            // jumlah_recall > 0
                            ->where('jumlah_recall', '>', 0)
                            ->first();
            if ($antreanLatest) {
                $antreanLatest->update([
                    'status_panggilan' => false,
                    'kode_loket'=> $request->list_transfer,
                    'jumlah_recall'=>0,
                    'updated_by' => $request->requestorUsername,
                ]);
            }
            
        }
        $namaAlur = $request->nama;

        if($namaAlur == "1"){
            $antrean = Antrean::where('kode_layanan', $request->list_layanan)
                            ->where('kode_loket', "0")
                            ->first();
        }else{
            $antrean = Antrean::where('kode_layanan', $request->list_layanan)
                            ->where('kode_loket', $request->list_loket)
                            ->first();
        }

       
        if (!$antrean) {
            return response()->json([
                'status' => false,
                'message' => 'Antrean not found',
                'data' => null,
            ], 404);
        }

        // update antrean
        try {
            $antrean->update([
                'kode_loket' => $request->list_loket,
                'status_panggilan' => true,
                'jumlah_recall' => $antrean->jumlah_recall + 1,
                'updated_by' => $request->requestorUsername,
            ]);

           

            if($namaAlur== "1"){
                $sisa_antrean = Antrean::where('kode_layanan', $request->list_layanan)->where('kode_loket', "0")->count();
               
                $antrean->update([
                    'sisa_antrean' => $sisa_antrean,
                    'updated_by' => $request->requestorUsername,
                ]);              

            }else{
                $sisa_antrean = Antrean::where('kode_layanan', $request->list_layanan)->where('kode_loket', $request->list_loket)->count();
                
                $antrean->update([
                    'sisa_antrean' => $sisa_antrean,
                    'updated_by' => $request->requestorUsername,
                ]);  

            }

            return response()->json([
                'status' => true,
                'message' => 'Success',
                'data' => $antrean,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed',
                'data' => $e->getMessage(),
            ], 500);
        }



       


      
    }

    // delete antrean
    public function delete(Request $request, $id)
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
            $antrean = Antrean::find($id);
            $antrean->delete();

            return response()->json([
                'status' => true,
                'message' => 'Success',
                'data' => $antrean,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed',
                'data' => $e->getMessage(),
            ], 500);
        }
    }
    
}
