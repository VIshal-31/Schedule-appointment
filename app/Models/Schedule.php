<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    protected $table = 'schedule';

    protected $fillable = [
        'day',
        'first_slot_start_time',
        'first_slot_end_time',
        'second_slot_start_time',
        'second_slot_end_time',
        'activity_status',
        // Add any other fields that you want to be mass assignable
    ];

}
