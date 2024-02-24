<?php

namespace App\Http\GlobalClases;

use App\Models\ErrorLog;
use Illuminate\Support\Str;

class BuildError
{
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
