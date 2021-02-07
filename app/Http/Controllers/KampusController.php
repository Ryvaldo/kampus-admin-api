<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kampus;

class KampusController extends Controller
{
    public function getAll()
    {
        $data = Kampus::all();

        if($data) {
            foreach ($data as $kampus) {
                $kampus->gambar = 'http://192.168.100.228:8012/api-kampus/public/img/kampus/' . $kampus->gambar;
            }
            
            return response()->json([
                'data' => $data
            ]);
        }

        return response()->json([
            'message' => 'gagal'
        ]);

    }

    public function addKampus(Request $request)
    {
        $data = [
            'nama_kampus' => $request->json('nama_kampus'),
            'deskripsi' => $request->json('deskripsi'),
            'gambar' => $request->json('gambar'),
            'latitude'=> $request->json('latitude'),
            'longitude'=> $request->json('longitude'),
        ];

        $kampus = Kampus::create($data);

        if ($kampus)
        {
            return response()->json([
                'message' => 'Tambah Kampus Berhasil !'
            ]);
        }
        return response()->json([
            'message' => 'Tambah Kampus Gagal'
        ]);
    }
    

    public function getUrlWithIP()
    {
        $ip = "192.168.100.228";
        return str_replace('localhost', $ip, asset('img/kampus'));
    }
}
