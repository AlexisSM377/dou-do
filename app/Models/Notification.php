<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Model class to Notification
 */
class Notification extends Model
{
    use HasFactory;

    // Fillable
    protected $fillable = [
        'user_id',
        'title',
        'description',
    ];

    /**
     * Relation function Notification-User
     *
     * @return EloquentRelation
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
