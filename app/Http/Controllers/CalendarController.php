<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enquire;


class CalendarController extends Controller
{
    public function index()
    {
        
        return view('dashboard.calendar.index');
    }

    public function getevent()
    {
        $requests = Enquire::select('Enquire.*',  'service_time_slots.service_start_time as service_start_time', 'service_time_slots.service_end_time as service_end_time','services.name as service_name')
        ->leftJoin('service_time_slots', 'Enquire.time', '=', 'service_time_slots.id')
        ->leftJoin('services', 'Enquire.service', '=', 'services.id')
        ->get() // Execute the query and retrieve the results
        ->toArray();
        return response()->json($requests);
        // dd($requests);
        
    }
}
