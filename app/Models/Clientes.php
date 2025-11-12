<?php

namespace App\Models;

use App\Filters\ClientesFilter;
use App\Http\Resources\ClientesResources;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Clientes extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome_cliente', 
        'data_nascimento', 
        'ativo'
    ];

    public function filter(Request $request) {
        $queryFilter = (new ClientesFilter)->filter($request);

        if (empty($queryFilter)) {
            return ClientesResources::collection(Clientes::all());
        }

        $data = Clientes::query();

        if (!empty($queryFilter['whereIn'])) {
            foreach ($queryFilter['whereIn'] as $value) {
                $data->whereIn($value[0], $value[1]);
            }
        }

        $resource = $data->where($queryFilter['where'])->get();

        return ClientesResources::collection($resource);
    }

    public function vendas()
    {
        return $this->hasMany(Vendas::class, 'cliente_id');
    }
}
