<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Ramsey\Uuid\Uuid;


/**
 * Model class to User
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasUuids;


    // Fillable
    protected $fillable = [
        'name',
        'last_name',
        'email',
        'password',
        'birthdate',
        'verified',
    ];

    // The attributes that should be hidden
    protected $hidden = [
        'password',
        'remember_token',
        'id',
        'verified',
        'created_at',
        'updated_at'
    ];

    // The attributes that should be cast
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function newUniqueId(): string
    {
        return (string) Uuid::uuid4();
    }

    public function uniqueIds(): array
    {
        return ['external_identifier'];
    }

    /**
     * Relational function User-Notification
     *
     * @return EloquentRelation
     */
    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    /**
     * Relational function User-Profession
     *
     * @return EloquentRelation
     */
    public function profesion()
    {
        return $this->belongsTo(Profession::class);
    }

    /**
     * Relational function User-Summary
     *
     * @return EloquentRelation
     */
    public function summaries()
    {
        return $this->hasMany(Summary::class);
    }

    /**
     * Relational function User-Task
     *
     * @return EloquentRelation
     */
    public function tasks()
    {
        return $this->belongsToMany(Task::class);
    }

    /**
     * Relational function User-Workspace
     *
     * @return EloquentRelation
     */
    public function workspaces()
    {
        return $this->belongsToMany(Workspace::class);
    }

    /**
     * Relational function User-MyFriends
     *
     * @return EloquentRelation
     */
    public function myFriends()
    {
        return $this->belongsToMany(User::class, 'friends', 'user_id', 'friend_id');
    }

    /**
     * Relational function to get people consider me a friend.
     *
     * @return EloquentRelation
     */
    public function friendToMe()
    {
        return $this->belongsToMany(User::class, 'friends', 'friend_id', 'user_id');
    }

    /**
     * Relational function to obtain the friend requests that I have sent
     *
     * @return EloquentRelation
     */
    public function myFriendRequests()
    {
        return $this->belongsToMany(User::class, 'friend_requests', 'origin_user_id', 'target_user_id');
    }

    /**
     * Relational function to get the friend requests that have been sent to me
     *
     * @return EloquentRelation
     */
    public function friendRequestsToMe()
    {
        return $this->belongsToMany(User::class, 'friend_requests', 'target_user_id', 'origin_user_id');
    }

    public function userTokens()
    {
        return $this->hasMany(UserToken::class);
    }
}
