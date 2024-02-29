<?php

namespace App\Filters\Api;
use Illuminate\Http\Request;

/**
 * Filter class to build the query that get a general list
 */
class AppFilter {
    //* Specific params to the model
    protected $rescuedParams = [];
    //* Columns that need to be mapping for its sintaxis
    protected $columnsMapping = [];
    //* Avalible filter operators to all of models
    protected $operatorsMapping = [
        'eq' => '=',
        'lt' => '<',
        'lte' => '<=',
        'gt' => '>',
        'gte' => '>=',
        'li' => 'like',
    ];

    /**
     * Function to build the parameters of query
     *
     * @param Request $request
     * @return array
     */
    public function build(Request $request)
    {
        $q = [];
        //* Tour the rescuedParams obtaining the param and its operators
        foreach($this->rescuedParams as $param => $operators){
            //* Saves the operator-value sent on the params based on the current param in the foreach: 
            $query = $request->query($param);

            //* If there's no value on the $query breaks this lap of the foreach
            if (empty($query)) continue;
            /**
             ** If there's a key into the columnMapping that matches with the current param, save the value of that key into $column the value
             ** If there is no a matches, save into $column the currentParam
             */
            $column = $this->columnsMapping[$param] ?? $param;

            //* Tour the operators
            foreach($operators as $operator){
                //* If there are matches between the current operator and an operator into $query, enter
                if (isset($query[$operator])) {
                    /**
                     ** If the currentOperator is 'li' save the value with wildcards
                     ** If the currentOperator isn't 'li' save the value no wildcards
                     */
                    $value = ($operator !== 'li') ? $query[$operator] : "%$query[$operator]%";
                    //* Save in $q the: 'column', 'operator', 'value', in that order
                    $q[] = [$column, $this->operatorsMapping[$operator], $value];
                }
            }
        }
        //* Returns the $q array with all of params query
        return $q;
    }
}