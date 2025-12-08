<?php

namespace App\Filters;

class VendasFilter extends Filter {
    protected array $allowedOperatorsFields = [
        'id' => ['gt', 'eq', 'lt', 'gte', 'lte', 'ne'],
        'produto_id' => ['gt', 'eq', 'lt', 'gte', 'lte', 'ne'],
        'cliente_id' => ['gt', 'eq', 'lt', 'gte', 'lte', 'ne'],
        'quantidade' => ['gt', 'eq', 'lt', 'gte', 'lte', 'ne'],
        'valor_total' => ['gt', 'eq', 'lt', 'gte', 'lte', 'ne'],
    ];
}