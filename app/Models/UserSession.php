<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// This represents pressure sessions.
class UserSession extends Model
{
    use HasFactory;

    protected $primaryKey = 'session_id';

    protected $casts = [
        'datetimes' => 'array',
    ];

    protected $fillable = ['datetimes', 'user_id'];
}
