<?php

namespace App\Filters\Api;
use Illuminate\Http\Request;

class AppFilter {
    protected $rescuedParams = [];
    protected $columnsMapping = [];
    protected $operatorsMapping = [];

    public function build(Request $request)
    {
        $q = [];
        dd($this->rescuedParams);
        /*
            rescuedParams

        
        */
        foreach($this->rescuedParams as $param => $operators){
            $query = $request->query($param);
            if (empty($query)) continue;

            $column = $this->columnsMapping[$param] ?? $param;

            foreach($operators as $operator){
                if (isset($query[$operator])) {
                    $q[] = [$column, $this->operatorsMapping[$operator], $query[$operator]];
                }
            }
        }
        dd("-");
        return $q;
    }

}