<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string',
            'password' => 'required |string|min:5|max:16'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        try {

            $credentials = $request->only('email', 'password');

            if (!auth()->attempt($credentials)){
                throw new \Exception('Usuario/Senha invalidos', 401);
            }

            $token = auth()->user()->createToken('acess_token')->plainTextToken;
            $user = auth()->user();


            return response()->json(["data" => ["Bearer Token" => $token , "user" => $user->nome], "success" => true],202);

        } catch (\Exception $e) {
            return response()->json(["success" => false, "message" => $e->getMessage()], 401);
        }
    }

    public function logged(Request $request)
    {
        $logged = auth()->user();
        return response()->json(["data" => $logged , "success" => true,],);

    }

    public function logout(Request $request)
    {
        try {
            auth()->user()->tokens()->delete();

            return response()->json(["message" => "Usuario deslogado", "success" => true]);

        } catch (\Exception $e) {
            return response()->json(["message" => $e->getMessage(), "success" => false], 400);
        }


    }
}
