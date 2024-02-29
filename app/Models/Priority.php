<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Model class to Priority
 */
class Priority extends Model
{
    use HasFactory;

    // Fillable
    protected $fillable = ['priority'];

    /**
     * Relation function Priority-Task
     *
     * @return EloquentRelation
     */
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
