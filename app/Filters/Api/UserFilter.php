<?php

namespace App\Filters\Api;
use App\Filters\Api\AppFilter;

class UserFilter extends AppFilter{
    protected $rescuedParams = [
        'name' => ['li', 'eq'],
        'email' => ['eq'],
        'birthdate' => ['eq', 'gt'],
    ];
}