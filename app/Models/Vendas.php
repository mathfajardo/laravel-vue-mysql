<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendas extends Model
{
    use HasFactory;

    protected $fillable = [
        'produto_id', 
        'cliente_id', 
        'quantidade',
        'valor_total'
    ];

    public function produto(){
        return $this->belongsTo(Produtos::class, 'produto_id');
    }

    public function cliente(){
        return $this->belongsTo(Clientes::class, 'cliente_id');
    }
}

