<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login   (Request $request)
    {
        $user = User::where('email', $request->json('email'))->first();
        $password = $request->json('password');

        if($user) {
            if(Hash::check($password, $user->password)) {
                return response()->json([
                    'data' => $user,
                    'message' => 'Login Berhasil'
                ]);
            }

            return response()->json([
                'message' => 'Passowrd Salah'
            ]);
        }

        return response()->json([
            'message' => 'Email tidak ditemukan'
        ]);
    }

    public function register(Request $request)
    {
        $data = [
            'name' => $request->json('name'),
            'email' => $request->json('email'),
            'password' => Hash::make($request->json('password'))
        ];

        $user = User::create($data);

        if ($user)
        {
            return response()->json([
                'message' => 'Register User Berhasil !'
            ]);
        } else {
            return response()->json([
                'message' => 'Register Gagal'
            ], 400);
        }

    }

    public function dataUser()
    {
        return User::all();
    }
}
