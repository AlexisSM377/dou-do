<?php

namespace App\Filters\Api;
use App\Filters\Api\AppFilter;

/**
 * Specific Filter class to the User Model
 */
class UserFilter extends AppFilter{
    //* Rescued Params to this specific Model
    protected $rescuedParams = [
        'name' => ['li', 'eq'],
        'email' => ['eq'],
        'birthdate' => ['eq', 'gt'],
    ];
}