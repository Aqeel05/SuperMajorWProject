<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SessionRecord extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $casts = [
        'datetimes' => 'array', // Cast the datetimes column as an array
    ];

    protected $fillable = ['datetimes', 'user_id'];
}
