<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\HistoryAntrean;

class LaporanApiController extends Controller
{
    //show all data 
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
        $history = HistoryAntrean::all();
        // tambahkan data "waktu_pelayanan" dari perhitungan selisih waktu selesai - mulai di tabel history_antrean 
        foreach ($history as $key => $value) {
            // hitung lama waktu pelayanan jika selesai tidak kosong
            if ($value->selesai != null) {
                $lama_pelayanan = strtotime($value->selesai) - strtotime($value->mulai);
                // menit
                $lama_pelayanan = $lama_pelayanan / 60;
                $history[$key]['waktu_pelayanan'] = $lama_pelayanan;
            } else {
                $history[$key]['waktu_pelayanan'] = null;
            }
        }

        // hitung jumlah antrean berdasarkan kode_loket dan kode_layanan , tambahkan rata-rata waktu pelayanan, waktu minimal dan waktu maksimal jika selesai tidak kosong
        $laporan = [];
        foreach ($history as $key => $value) {
            // jika kode_loket dan kode_layanan belum ada di array $laporan
            if (!array_key_exists($value->kode_loket . '-' . $value->kode_layanan, $laporan)) {
                $laporan[$value->kode_loket . '-' . $value->kode_layanan]['jumlah_antrean'] = 1;
                $laporan[$value->kode_loket . '-' . $value->kode_layanan]['pelayanan_avg'] = round($value->waktu_pelayanan, 2);
                $laporan[$value->kode_loket . '-' . $value->kode_layanan]['pelayanan_min'] = round($value->waktu_pelayanan, 2);
                $laporan[$value->kode_loket . '-' . $value->kode_layanan]['pelayanan_max'] = round($value->waktu_pelayanan, 2);
                // kode_loket
                $laporan[$value->kode_loket . '-' . $value->kode_layanan]['kode_loket'] = $value->kode_loket;
                // kode_layanan
                $laporan[$value->kode_loket . '-' . $value->kode_layanan]['kode_layanan'] = $value->kode_layanan;
            } else {
                $laporan[$value->kode_loket . '-' . $value->kode_layanan]['jumlah_antrean'] += 1;
                $laporan[$value->kode_loket . '-' . $value->kode_layanan]['pelayanan_avg'] += round($value->waktu_pelayanan, 2);
                if ($laporan[$value->kode_loket . '-' . $value->kode_layanan]['pelayanan_min'] > $value->waktu_pelayanan) {
                    $laporan[$value->kode_loket . '-' . $value->kode_layanan]['pelayanan_min'] = round($value->waktu_pelayanan, 2);
                }
                if ($laporan[$value->kode_loket . '-' . $value->kode_layanan]['pelayanan_max'] < $value->waktu_pelayanan) {
                    $laporan[$value->kode_loket . '-' . $value->kode_layanan]['pelayanan_max'] = round($value->waktu_pelayanan, 2);
                }
            }
        }
        // hitung rata-rata waktu pelayanan
        foreach ($laporan as $key => $value) {
            $laporan[$key]['id'] = $history[0]->id;
            $laporan[$key]['pelayanan_avg'] = round($laporan[$key]['pelayanan_avg'] / $laporan[$key]['jumlah_antrean'], 2);


            
            //    add tanggal format d-m-Y from $history->mulai
            $laporan[$key]['tanggal'] = date('d-m-Y', strtotime($history[0]->mulai));
        }

        // $laporan = $history->groupBy('kode_loket')->map(function ($item, $key) {
        //     $jumlah_antrean = count($item);
        //     $pelayanan_avg = $item->avg('waktu_pelayanan');
        //     $pelayanan_avg = round($pelayanan_avg, 2);
        //     $pelayanan_min = $item->min('waktu_pelayanan');
        //     $pelayanan_min = round($pelayanan_min, 2);
        //     $pelayanan_max = $item->max('waktu_pelayanan');
        //     $pelayanan_max = round($pelayanan_max, 2);
        //     return [
        //         'kode_loket' => $key,
        //         'jumlah_antrean' => $jumlah_antrean,
        //         'pelayanan' => $pelayanan_avg,
        //         'pelayanan_min' => $pelayanan_min,
        //         'pelayanan_max' => $pelayanan_max,
        //     ];
        // });












        return response()->json([
            'status' => true,
            'message' => 'Success',
            'data' => $laporan,
        ], 200);
    }
}
