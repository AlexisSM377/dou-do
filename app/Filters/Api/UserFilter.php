<?php

namespace App\Filters\Api;
use App\Filters\Api\AppFilter;

class UserFilter extends AppFilter{

    //* Parametros por los cuales podemos filtrar
    protected $rescuedParams = [
        'name' => ['li', 'eq'],
        'email' => ['eq'],
        'birthdate' => ['eq', 'gt'],
    ];

    //* Parametros cuyo nombre debemos normalizar, ej: lastName = last_name
    protected $columnsMapping = [
        // 'name' => 'name',
    ];

}