<?php

namespace App\Http\Controllers;

use App\Models\Vehicles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VehiclesController extends Controller
{
    public function criarVeiculo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'veiculo' => 'required|string|max:32',
            'marca' => 'required|string|max:32',
            'ano' => 'required',
            'cor' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        try {
            $veiculo = new Vehicles();

            $veiculo->veiculo = $request->veiculo;
            $veiculo->marca = $request->marca;
            $veiculo->ano = $request->ano;
            $veiculo->cor = $request->cor;
            $veiculo->descricao = $request->descricao;
            $veiculo->vendido = false;

            $veiculo->save();

            return response()->json(["success" => true, "message" => 'Veiculo cadastrado com sucesso'], 201);

        } catch (\Exception $e) {
            return response()->json(["success" => false,"message" => $e->getMessage()], 400);
        }
    }

    public function listarTodosVeiculos()
    {
        try {

            $data = Vehicles::get();

            return response()->json(["success" => true, "message" => $data], 200);

        } catch (\Exception $e) {
            return response()->json([ "success" => false, "message" => $e->getMessage()], 400);
        }
    }

    public function buscarPorVeiculo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'q' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        try {

            if (!empty($request->q)) {

                $data = Vehicles::where('veiculo', $request->q)->get();

                if ($data) {
                    return response()->json(["success" => true, "message" => $data], 200);
                } else {
                    throw new \Exception('Não foram encontrado dados para a busca realizada');
                }
            } else {
                throw new \Exception('É obrigatório retornar um valor na busca');
            }

        } catch (\Exception $e) {
            return response()->json(["success" => false, "message" => $e->getMessage()], 400);
        }
    }

    public function listarVeiculoPorId($id)
    {
        try {
            if ($id != null && is_numeric($id)) {

                $data = Vehicles::find($id);

                if ($data) {
                    return response()->json(["success" => true, "message" => $data], 200);
                } else {
                    throw new \Exception('Id não encontrado');
                }
            } else {
                throw new \Exception('O Campo ID é obrigatório');
            }

        } catch (\Exception $e) {
            return response()->json(["success" => false,"message" => $e->getMessage()], 400);
        }
    }

    public function editarVeiculoPorId($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'veiculo' => 'required|string|max:32',
            'marca' => 'required|string|max:32',
            'ano' => 'required|integer',
            'cor' => 'required|string|max:32',
            'descricao' => 'string|max:255',
            'vendido' => 'required|boolean',

        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        try {
            if ($id != null && is_numeric($id)) {

                $data = Vehicles::find($id);

                if ($data) {

                    $data->veiculo = $request->veiculo;
                    $data->marca = $request->marca;
                    $data->ano = $request->ano;
                    $data->cor = $request->cor;
                    $data->descricao = $request->descricao;
                    $data->vendido = $request->vendido;

                    $data->save();

                    return response()->json(["success" => true, "message" => 'Veiculo alterado com sucesso'], 200);
                } else {
                    throw new \Exception('Id não encontrado');
                }
            } else {
                throw new \Exception('O Campo ID é obrigatório');
            }

        } catch (\Exception $e) {
            return response()->json(["success" => false, "message" => $e->getMessage()], 400);
        }
    }

    public function deletarVeiculoPorId($id)
    {
        try {
            if ($id != null && is_numeric($id)) {

                $data = Vehicles::find($id);

                if ($data) {

                    Vehicles::destroy($id);

                    return response()->json([
                        "success" => true,
                        "message" => 'Usuario apagado com sucesso'], 200);
                } else {
                    throw new \Exception('Id não encontrado');
                }
            } else {
                throw new \Exception('O Campo ID é obrigatório');
            }

        } catch (\Exception $e) {
            return response()->json(["success" => false, "message" => $e->getMessage()], 400);
        }
    }
}
