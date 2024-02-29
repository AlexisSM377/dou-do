<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Model class to Profession
 */
class Profession extends Model
{
    use HasFactory;

    // Fillable
    protected $fillable = ['profession'];

    /**
     * Relation function Profession-User
     *
     * @return EloquentRelation
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
