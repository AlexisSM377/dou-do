<?php

namespace App\Filters\Api;
use Illuminate\Http\Request;

class AppFilter {
    protected $rescuedParams = [];
    protected $columnsMapping = [];
    protected $operatorsMapping = [
        'eq' => '=',
        'lt' => '<',
        'lte' => '<=',
        'gt' => '>',
        'gte' => '>=',
        'li' => 'like',
    ];

    public function build(Request $request)
    {
        $q = [];
        foreach($this->rescuedParams as $param => $operators){
            $query = $request->query($param);

            if (empty($query)) continue;
            $column = $this->columnsMapping[$param] ?? $param;

            foreach($operators as $operator){
                if (isset($query[$operator])) {
                    $value = ($operator !== 'li') ? $query[$operator] : "%$query[$operator]%";
                    $q[] = [$column, $this->operatorsMapping[$operator], $value];
                }
            }
        }
        return $q;
    }
}