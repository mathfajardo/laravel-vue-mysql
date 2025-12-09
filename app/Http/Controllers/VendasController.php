<?php

namespace App\Http\Controllers;

use App\Http\Resources\VendasResources;
use App\Models\Vendas;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class VendasController extends Controller
{
    use HttpResponses;
    
    public function index(Request $request) {
        // return VendasResources::collection(Vendas::all());
        return (new Vendas())->filter($request);
    }

    public function store(Request $request) {

        $validator = Validator::make($request->all(), [
            "produto_id" => "nullable",
            "cliente_id" => "nullable",
            "quantidade" => "required",
            "valor_total" => "required"
        ]);

        if ($validator->fails()) {
            return $this->error('erro ao adicionar', 422, $validator->errors());
        }

        $created = Vendas::create($validator->validate());

        if ($created) {
            return $this->response('Venda registrada', 200, $created);
        }
        return $this->response('Venda não foi registrada', 400);
        
        
    }

    public function destroy(Vendas $venda) {
        $deleted = $venda->delete();

        if ($deleted) {
            return $this->response("Venda deletada com sucesso", 200);
        }

        return $this->response("Não foi possível deletar", 400);
    }

    public function vendasTotal() {
        // retornadno o total de vendas realizadas
        $vendas = DB::table('vendas')->count();

        // retornando a requisicao
        return $this->response('Total de vendas', 200, ['total' => $vendas]);
    }

    public function vendasValorTotal() {
        // retornando o valor total de vendas realizadas
        $valor_total = DB::table('vendas')
                        ->select(DB::raw('SUM(valor_total) as valor_total'))->first();
                        

        // transformando em um array associativo
        $array = (array) $valor_total;

        // retornando a requisição
        return $this->response('Valor total de vendas', 200, $array);
    }

    public function vendasValorTotalMes() {
        // armazenando mes e ano em variaveis
        $mes = now()->month;
        $ano = now()->year;

        // retornado o valor todal do dia
        $valor_total_dia = DB::table('vendas')
                            ->select(DB::raw('SUM(valor_total) as valor_total'))
                            ->whereMonth('created_at', $mes)
                            ->whereYear('created_at', $ano)->first();
        
        // tranformando me array associativo
        $array = (array) $valor_total_dia;

        //retornadno requisaoca
        return $this->response('Valor total de vendas por mes', 200, $array);
    }

    public function vendasValorTotalDia() {
        // armazenando mes e ano em variaveis
        $mes = now()->month;
        $ano = now()->year;
        $dia = now()->day;

        // retornado o valor todal do dia
        $valor_total_mes = DB::table('vendas')
                            ->select(DB::raw('SUM(valor_total) as valor_total'))
                            ->whereMonth('created_at', $mes)
                            ->whereYear('created_at', $ano)
                            ->whereDay('created_at', $dia)->first();
        
        // tranformando me array associativo
        $array = (array) $valor_total_mes;

        //retornadno requisaoca
        return $this->response('Valor total de vendas por mes', 200, $array);
    }
}
