<?php

namespace App\Http\Controllers;

use App\Http\Resources\ClientesResources;
use App\Models\Clientes;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClientesController extends Controller
{
    use HttpResponses;

    public function index(Request $request) {
        return ClientesResources::collection(Clientes::all());
    }

    public function store(Request $request) {

        $validator = Validator::make($request->all(), [
            "nome_cliente" => "required",
            "data_nascimento" => "nullable",
            "ativo" => "required"
        ]);

        if ($validator->fails()) {
            return $this->error('erro ao adicionar', 422, $validator->errors());
        }

        $created = Clientes::create($validator->validate());

        if ($created) {
            return $this->response("Cliente adicionado com sucesso", 200, $created);
        }
        return $this->response("Não foi possível adicionar", 400);
    }

    public function show(String $id) {
        return new ClientesResources(Clientes::where('id', $id)->first());
    }

    public function destroy(Clientes $cliente) {
        $deleted = $cliente->delete();

        if ($deleted) {
            return $this->response("Cliente deletado", 200);
        }
        return $this->response("Erro ao deletar", 400);
    }
}
