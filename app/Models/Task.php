<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Model class to Task
 */
class Task extends Model
{
    use HasFactory;

    // Fillable
    protected $fillable = [
        'user_id',
        'priority_id',
        'title',
        'description',
        'status',
        'due_date',
    ];

    /**
     * Relation function Task-Priority
     *
     * @return EloquentRelation
     */
    public function priority()
    {
        return $this->belongsTo(Priority::class);
    }

    /**
     * Relation function Task-User
     *
     * @return EloquentRelation
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
