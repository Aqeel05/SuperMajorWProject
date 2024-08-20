<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSession extends Model
{
    use HasFactory;

    protected $casts = [
        'datetimes' => 'array',
        'datetimes1' => 'array'
    ];

    protected $fillable = ['datetimes', 'datetimes1', 'user_id'];
}
