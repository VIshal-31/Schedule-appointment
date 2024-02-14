<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Service;
use App\Models\Shop;
use App\Models\ServiceTimeSlot;
use App\Models\Enquire;
use App\Models\Holiday;
use App\Models\Schedule;



class DomainController extends Controller
{
    public function index()
    {
        // Logic for displaying services
        $services = Service::all(); // Fetch existing services
        $categories = Category::all(); // Fetch categories
        $holidays = Holiday::all(); // Fetch categories
        $schedule = Schedule::where('activity_status', 'active')->pluck('day');
        $holidayDates = $holidays->pluck('event_date')->toArray();
        $shop = Shop::find(1);
        // Example code in your controller
        $workingDays = json_encode(explode(',', $shop->working_days));
        return view('index', compact('services','categories','shop','workingDays','holidays','holidayDates','schedule'));
        return response()->json($shop);
    }


    public function getServices($category_id)
    {
        $services = Service::where('category_id', $category_id)->get();
        return response()->json($services);
    }

    public function getTimeSlots($serviceId, $day)
    {
        // Replace this with your actual logic to fetch time slots
        $timeSlots = ServiceTimeSlot::where('service_id', $serviceId)
        ->where('day', $day)
        ->where('activity_status', 'active')
        ->select('service_start_time', 'service_end_time','id')
        ->get()
        ->toArray();
        return response()->json($timeSlots);
    }


    public function getPreBookedSlots($date)
    {
    $preBookedSlots = Enquire::where('date', $date)
        ->pluck('time') 
        ->toArray();

    return response()->json($preBookedSlots);
    }

    
    // public function getHolidays()
    // {
    //     // Replace YourEventModel with the actual model you are using for events
    //     $holidays = Holiday::where('event_date', '>=', now()->format('Y-m-d'))
    //         ->pluck('event_date')
    //         ->toArray();

    //     return response()->json($holidays);
    // }


}

