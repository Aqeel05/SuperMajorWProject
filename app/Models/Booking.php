<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    // The attributes that are mass assignable.
    protected $fillable = ['booking_date', 'patient_id', 'staff_id'];
}
