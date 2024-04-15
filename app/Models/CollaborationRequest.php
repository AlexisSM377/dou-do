<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CollaborationRequest extends Model
{
    use HasFactory;

    protected $table = 'collaboration_requests';
    protected $fillable = [
        'user_id',
        'collaborator_id',
        'workspace_id',
        'status'
    ];

}
