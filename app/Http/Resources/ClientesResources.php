<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientesResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nome_cliente' => $this->nome_cliente,
            'data_nascimento' => Carbon::parse($this->data_nascimento)->format('d/m/Y'),
            'ativo' => $this->ativo
        ];
    }
}
