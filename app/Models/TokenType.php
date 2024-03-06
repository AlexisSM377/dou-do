<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Model class for TokenType table
 */
class TokenType extends Model
{
    use HasFactory;

    //* Fillable
    protected $fillable = ['type'];
}
