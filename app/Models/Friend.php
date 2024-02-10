<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Model class to Friend
 */
class Friend extends Model
{
    use HasFactory;

    // Fillable
    protected $fillable = ['user_id', 'friend_id'];
}
