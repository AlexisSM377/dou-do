<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Model class FOR Profession table
 */
class Profession extends Model
{
    use HasFactory;

    //* Fillable
    protected $fillable = ['profession'];

    /**
     * Gives relation between Profession and user N:1
     *
     * @return EloquentRelation
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
