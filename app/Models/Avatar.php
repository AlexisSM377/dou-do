<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Model class for avatar table
 */
class Avatar extends Model
{
    use HasFactory;

    //** Fillable
    protected $fillable = [
        'url'
    ];

    /**
     * Gives relation between Avatars and users N:1
     *
     * @return EloquentRelation
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
