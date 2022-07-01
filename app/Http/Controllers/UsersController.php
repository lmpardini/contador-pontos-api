<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function criarUsuario(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'user_name' => 'required|string',
            'password' => 'required |string|min:6|max:16'
        ]);

        try {

            $usuario = new User();

            $usuario->nome = $request->name;
            $usuario->user_name = $request->user_name;
            $usuario->password = Hash::make($request->password);
            $usuario->save();

            return response()->json(["success" => true, "message" => 'Usuario criado com sucesso'], 201);

        } catch (\Exception $e) {
            return response()->json(["success" => false, "message" => $e->getMessage()], 400);
        }
    }

    public function listarTodosUsuarios()
    {
        try {

            $data = User::all();

            return response()->json(["success" => true, "message" => $data], 200);

        } catch (\Exception $e) {
            return response()->json(["success" => false, "message" => $e->getMessage()], 400);
        }

    }

    public function listarUsuarioPorId($id)
    {
        try {
            if ($id != null && is_numeric($id)) {

                $data = User::find($id);

                if ($data) {
                    return response()->json(["success" => true, "message" => $data], 200);
                } else {
                    throw new \Exception('Id não encontrado');
                }
            } else {
                throw new \Exception('O Campo ID é obrigatório');
            }

        } catch (\Exception $e) {
            return response()->json(["success" => false,  "message" => $e->getMessage()], 400);
        }
    }

    public function deletarUsuarioPorId($id)
    {
        try {
            if ($id != null && is_numeric($id)) {

                $data = User::find($id);

                if ($data) {

                    User::destroy($id);

                    return response()->json([ "success" => true, "message" => 'Usuario apagado com sucesso'], 200);
                } else {
                    throw new \Exception('Id não encontrado');
                }
            } else {
                throw new \Exception('O Campo ID é obrigatório');
            }

        } catch (\Exception $e) {
            return response()->json([ "success" => false, "message" => $e->getMessage()], 400);
        }
    }

}
