<?php

namespace App\Models;

use App\Filters\VendasFilter;
use App\Http\Resources\VendasResources;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Vendas extends Model
{
    use HasFactory;

    protected $fillable = [
        'produto_id', 
        'cliente_id', 
        'quantidade',
        'valor_total'
    ];

    public function filter(Request $request) {
        $queryFilter = (new VendasFilter)->filter($request);

        if (empty($queryFilter)) {
            return VendasResources::collection(Vendas::all());
        }

        $data = Vendas::query();

        if (!empty($queryFilter['whereIn'])) {
            foreach ($queryFilter['whereIn'] as $value) {
                $data->whereIn($value[0], $value[1]);
            }
        }

        $resource = $data->where($queryFilter['where'])->get();

        return VendasResources::collection($resource);
    }

    public function produto(){
        return $this->belongsTo(Produtos::class, 'produto_id');
    }

    public function cliente(){
        return $this->belongsTo(Clientes::class, 'cliente_id');
    }
}

