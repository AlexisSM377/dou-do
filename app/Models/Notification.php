<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Model class for Notification table
 */
class Notification extends Model
{
    use HasFactory;

    //* Fillable
    protected $fillable = [
        'user_id',
        'title',
        'description',
    ];

    /**
     * Gives relation between notification and user N:N
     *
     * @return EloquentRelation
     */
    public function user()
    {
        //TODO: Corregir, debe ser N:1
        return $this->belongsTo(User::class);
    }
}
