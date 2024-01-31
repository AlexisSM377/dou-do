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

        foreach($this->rescuedParams as $param => $operators){
            /**
             * Por vuelta:
             * param = 'name'
             * operators = '[ 0 => 'operador', 1 => 'operador', 2 => 'operator' ]
             */

            //! Obtenemos el operador y valor dado del primer param, ej: name[eq]=Rafa, obtendriamos: "eq" => "rafa"
            //! Guarda solo la clave-valor, del parametro que corresponde a esta vuelta
            $query = $request->query($param);

            //! Si por alguna razón... $query no contiene nada, terminara vuelta aqui y pasara a la siguiente
            if (empty($query)) continue;

            //? Si hay algo en: $this->columnsMapping, usara el $param actual para acceder al valor de la clave que coincida con el param...
            //* EJEMPLO:
            //! $this->columnsMapping: ['lastName' => 'last_name]
            //! (Parametro actual), $param: 'lastName'
            //! $this->columnsMapping[$param] ::::: Obtendriamos: "last_name"

            //? Si no hay nada en $this->columnsMapping[$param], guardamos en $column el $param actual
            $column = $this->columnsMapping[$param] ?? $param;

            foreach($operators as $operator){
                //! $operator traera el valor: eq, gt, lt, etc...

                //! Verifica si el operador de esta vuelta se encuentra como clave el el query actual, si existe entra de lo contrario continua con la siguiente vuelta
                if (isset($query[$operator])) {
                    // $column: El parametro en cuestion (la columna en base de datos)
                    // $this->operatorMapping: El operador en cuestión
                    // $query[$operator]: // El valor del parametro
                    // dd($column, $this->operatorsMapping[$operator], $query[$operator]);
                    $value = ($operator !== 'li') ? $query[$operator] : "%$query[$operator]%";
                    $q[] = [$column, $this->operatorsMapping[$operator], $value];
                }
            }
        }
        //! Para este punto: $q ya tiene un array con las columnas, los comparadores y los valores a buscar
        // dd($q);
        return $q;
    }

}