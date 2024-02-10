<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Summary extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'tasks_completed',
        'friends_made',
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
