<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Ramsey\Uuid\Uuid;


/**
 * Model class for User table
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasUuids;

    //* Fillable
    protected $fillable = [
        'name',
        'last_name',
        'expo_push_token',
        'email',
        'password',
        'birthdate',
        'verified',
    ];

    //* The attributes that should be hidden
    protected $hidden = [
        'password',
        'remember_token',
        'id',
        'verified',
        'created_at',
        'updated_at'
    ];

    //* The attributes that should be cast
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Function to generate the uuid
     *
     * @return string
     */
    public function newUniqueId(): string
    {
        return (string) Uuid::uuid4();
    }

    /**
     * Function to set the uuid in external_identifier field
     *
     * @return array
     */
    public function uniqueIds(): array
    {
        return ['external_identifier'];
    }

    /**
     * Gives relation between user and notification -
     *
     * @return EloquentRelation
     */
    public function notifications()
    {
        //TODO: Corregir, debe ser N:1
        return $this->hasMany(Notification::class);
    }

    /**
     * Gives relation between user and profession N:1
     *
     * @return EloquentRelation
     */
    public function profesion()
    {
        return $this->belongsTo(Profession::class);
    }

    /**
     * Gives relation between user and summaries -
     *
     * @return EloquentRelation
     */
    public function summaries()
    {
        //TODO: Corregir, debe ser N:1
        return $this->hasMany(Summary::class);
    }

    /**
     * Gives relation between user and tasks N:N
     *
     * @return EloquentRelation
     */
    public function tasks()
    {
        return $this->belongsToMany(Task::class);
    }

    /**
     * Gives relation between user and workspaces N:N
     *
     * @return EloquentRelation
     */
    public function workspaces()
    {
        return $this->belongsToMany(Workspace::class);
    }

    /**
     * Gives relation between user and ser (direct friends) N:N
     *
     * @return EloquentRelation
     */
    public function myFriends()
    {
        return $this->belongsToMany(User::class, 'friends', 'user_id', 'friend_id');
    }

    /**
     * Gives relation between User and FriendRequest N:1
     *
     * @return EloquentRelation
     */
    public function myFriendRequests()
    {
        return $this->belongsToMany(FriendRequest::class, 'friend_requests', 'origin_user_id', 'target_user_id');
    }

    /**
     * Gives relation between User and UserToken N:1
     *
     * @return EloquentRelation
     */
    public function userTokens()
    {
        return $this->hasMany(UserToken::class);
    }

    /**
     * Gives relation between User and Avatar N:1
     *
     * @return EloquentRelation
     */
    public function avatars()
    {
        return $this->belongsToMany(Avatar::class, 'user_avatars');
    }
}
