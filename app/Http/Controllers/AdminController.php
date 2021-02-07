<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kampus;

class AdminController extends Controller
{
    public function getAll()
    {
        $data = Kampus::all();

        return view('index', ['data' => $data]);
    }

    public function addKampus(Request $request)
    {
        if ($request->allFiles()) {
            $file = $request->file('gambar');

            $gambar = uniqid('img-') . '.' . $file->extension();

            $file->storeAs('kampus/', $gambar, 'img');

            $data = [
                'nama_kampus' => $request->post('nama_kampus'),
                'deskripsi' => $request->post('deskripsi'),
                'latitude' => $request->post('latitude'),
                'longitude' => $request->post('longitude'),
                'gambar' => $gambar
            ];

            $kampus = Kampus::create($data);

            if ($kampus) {
                return redirect()->back();
            }

            return redirect()->back();
        }
    }

    public function delete($id)
    {
        $data = Kampus::find($id);
        
        if($data) {
            $data->delete();
            return redirect()->back();
        }

        return redirect()->back();
    }
}