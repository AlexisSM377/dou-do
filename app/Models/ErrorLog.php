<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Model class for ErrorLog table
 */
class ErrorLog extends Model
{
    use HasFactory;

    //* Fillable
    protected $fillable = [
        'message',
        'error_type_id',
        'class',
        'function'
    ];
}
