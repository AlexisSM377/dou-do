<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Model class to Workspace
 */
class Workspace extends Model
{
    use HasFactory;

    // Fillable
    protected $fillable = [
        'name',
        'description',
        'color',
        'advance',
    ];

    /**
     * Relation function Workspace-User
     *
     * @return EloquentRelation
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
