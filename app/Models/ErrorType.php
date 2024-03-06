<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Model class for ErrorType table
 */
class ErrorType extends Model
{
    use HasFactory;

    //* Fillable
    protected $fillable = ['type'];
}
