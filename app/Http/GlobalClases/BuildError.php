<?php

namespace App\Http\GlobalClases;

use App\Models\ErrorLog;
use Illuminate\Support\Str;

/**
 * Class to BuildError actions
 */
class BuildError
{
    /**
     * Gets the error message and the error Type, and saves it en databases
     *
     * @param object $th
     * @param integer $typeError
     * @return void
     */
    public static function saveError($th, $typeError)
    {
        ErrorLog::create([
            'message' => Str::limit($th->getMessage(), 250),
            'error_type_id' => $typeError,
            'class' => $th->getTrace()[0]['class'],
            'function' => $th->getTrace()[0]['function'],
        ]);
    }
}
