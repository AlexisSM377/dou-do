<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'priority_id',
        'title',
        'description',
        'status',
        'due_date',
    ];

    public function priority()
    {
        return $this->belongsTo(Priority::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
