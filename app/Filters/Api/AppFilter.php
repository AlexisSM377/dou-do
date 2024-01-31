<?php

namespace App\Filers;
use Illuminate\Http\Request;

class AppFilter {
    protected $rescuedParams = [];
    protected $columMapping = [];
    protected $operator = [];

    public function build(Request $request)
    {
        $q = [];
        foreach($this->rescuedParams as $param => $operators){
            $query = $request->query($param);
            if (empty($query)) continue;

            $column = $this->columMapping[$param] ?? $param;

            foreach($operators as $operator){
                if (isset($query[$operator])) {
                    $q[] = [$column, $this->operator[$operator], $query[$operator]];
                }
            }
        }
        return $q;
    }

}