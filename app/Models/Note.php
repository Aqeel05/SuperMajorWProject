<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    // The attributes that are mass assignable.
    protected $fillable = ['title', 'note', 'user_id'];
}
