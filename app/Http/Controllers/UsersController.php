<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use function PHPUnit\Framework\isNull;

class UsersController extends Controller
{

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
                throw new \Exception('O Campo ID é obrigatório');
            }

            $data = User::find($id);

            if (isNull($data)) {
                throw new \Exception('Id não encontrado');
            }

            return response()->json(["success" => true, "message" => $data]);

        } catch (\Exception $e) {
            return response()->json(["success" => false, "message" => $e->getMessage()], 400);
        }
    }

    public function criarUsuario(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'user_name' => 'required|string',
            'password' => 'required |string|min:6|max:16'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        try {
            $usuario = new User();

            $usuario->nome = $request->name;
            $usuario->user_name = $request->user_name;
            $usuario->password = bcrypt($request->password);
            $usuario->save();

            return response()->json(["success" => true, "message" => 'Usuario criado com sucesso'], 201);

        } catch (\Exception $e) {
            return response()->json(["success" => false, "message" => $e->getMessage()], 400);
        }
    }

    public function deletarUsuarioPorId($id)
    {
        try {
            if ($id != null && is_numeric($id)) {
                throw new \Exception('O Campo ID é obrigatório');
            }

            $data = User::find($id);

            if (!$data) {
                throw new \Exception('Id não encontrado');
            }

            User::destroy($id);

            return response()->json(["success" => true, "message" => 'Usuario apagado com sucesso'], 200);

        } catch (\Exception $e) {
            return response()->json(["success" => false, "message" => $e->getMessage()], 400);
        }
    }
}
