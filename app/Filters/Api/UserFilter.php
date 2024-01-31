<?php

namespace App\Filters\Api;
use Illuminate\Http\Request;
use App\Filters\Api\AppFilter;

class UserFilter extends AppFilter{

    //* Parametros por los cuales podemos filtrar
    protected $rescuedParams = [
        'name' => ['eq'],
        'email' => ['eq'],
        'birthdate' => ['eq', 'gt'],
    ];

    //* Parametros cuyo nombre debemos normalizar, ej: lastName = last_name
    protected $columnsMapping = [
        // 'name' => 'name',
    ];

    //* Operadores de comparación
    protected $operatorsMapping = [
        'eq' => '=',
        'lt' => '<',
        'lte' => '<=',
        'gt' => '>',
        'gte' => '>=',
    ];

}