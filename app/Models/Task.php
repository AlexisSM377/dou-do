<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Model class for Task tbale
 */
class Task extends Model
{
    use HasFactory;

    //* Fillable
    protected $fillable = [
        'responsable_id',
        'title',
        'description',
        'priority_id',
        'workspace_id',
        'status',
        'due_date',
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    /**
     * Gives relation between Task and priority N:1
     *
     * @return EloquentRelation
     */
    public function priority()
    {
        return $this->belongsTo(Priority::class);
    }

    /**
     * Gives relation between Task and User N:N
     *
     * @return EloquentRelation
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function workspace()
    {
        return $this->belongsTo(Workspace::class);
    }
}
