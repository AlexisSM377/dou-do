<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Model class to Summary
 */
class Summary extends Model
{
    use HasFactory;

    // Fillable
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'tasks_completed',
        'friends_made',
    ];

    /**
     * Relation function Summary-User
     *
     * @return EloquentRelation
     */
    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
