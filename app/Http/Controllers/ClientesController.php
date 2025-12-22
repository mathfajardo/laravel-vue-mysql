<?php

namespace App\Http\Controllers;

use App\Http\Resources\ClientesResources;
use App\Models\Clientes;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpKernel\EventListener\ValidateRequestListener;

class ClientesController extends Controller
{
    use HttpResponses;

    public function index(Request $request) {
        // return ClientesResources::collection(Clientes::all());
        return(new Clientes())->filter($request);
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

    public function update(Request $request, string $id) {


        $validator = Validator::make($request->all(), [
            'nome_cliente' => 'required',
            'data_nascimento' => 'required',
            'ativo' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->error("Erro na validação", 422, $validator->errors());
        }

        $validated = $validator->validate();

        $update = Clientes::find($id)->update([
            'nome_cliente' => $validated['nome_cliente'],
            'data_nascimento' => $validated['data_nascimento'],
            'ativo' => $validated['ativo']
        ]);

        if ($update) {
            return $this->response("Cliente atualizado com sucesso!", 200, $request->all());
        }

        return $this->error("Cliente não atualizado", 400);
    }

    public function destroy(Clientes $cliente) {
        $deleted = $cliente->delete();

        if ($deleted) {
            return $this->response("Cliente deletado", 200);
        }
        return $this->response("Erro ao deletar", 400);
    }

    public function clientesTotal() 
    {
        // retornadno o total de clientes cadastados
        $clientes = DB::table('clientes')->count();

        
        // retornando a requisicao
        return $this->response('Total de clientes', 200, ['total' => $clientes]);


    }
}
