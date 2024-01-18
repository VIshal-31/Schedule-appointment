<?php

// app/Models/ServiceTimeSlot.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class ServiceTimeSlot extends Model
{
    protected $fillable = [
        'service_id',
        'service_start_time',
        'service_end_time',
        'timestamp',
        'service_slot_status',
        'quantity',
    ];

    // Define the relationship with Service
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
