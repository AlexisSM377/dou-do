<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Model class for Summary table
 */
class Summary extends Model
{
    use HasFactory;

    //* Fillable
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'tasks_completed',
        'friends_made',
    ];

    /**
     * Gives relation between Summary and User -
     *
     * @return EloquentRelation
     */
    public function users()
    {
        // TODO: Corregir, se debe aclarar cual es la relacion y funcionalidad. 
        return $this->belongsTo(User::class);
    }
}
