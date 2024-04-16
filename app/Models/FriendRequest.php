<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Model class for FriendRequest table
 */
class FriendRequest extends Model
{
    use HasFactory;

    //* Fillable
    protected $fillable = ['origin_user_id', 'target_user_id', 'status'];
}
