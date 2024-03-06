<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Model class for Priority table
 */
class Priority extends Model
{
    use HasFactory;

    //* Fillable
    protected $fillable = ['priority'];

    /**
     * Gives relation between Priority and tasks N:1
     *
     * @return EloquentRelation
     */
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
