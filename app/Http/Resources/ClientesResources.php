<?php

namespace App\Http\Resources;

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
            'nome do cliente' => $this->nome_cliente,
            'data de nascimento' => $this->data_nascimento,
            'ativo' => $this->ativo
        ];
    }
}
