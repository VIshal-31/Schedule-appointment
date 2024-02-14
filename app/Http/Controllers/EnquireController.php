<?php

namespace App\Http\Controllers;
use App\Models\Enquire;
use App\Models\ServiceTimeSlot;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Holiday;
use App\Models\Shop;
use App\Models\Schedule;



class EnquireController extends Controller
{
    
    public function index()
    {
        $requests = Enquire::select('Enquire.*' )
            ->orderBy('created_at', 'desc') 
            ->paginate(10); // Change the 10 to the number of items you want per page
        return view('dashboard.Enquire.index', compact('requests'));    
    }

    public function update(Request $request, $id)
    {
        $enquiry = Enquire::findOrFail($id);
        // Update the fields based on the form submission
        $enquiry->update($request->all());
        return redirect()->route('dashboard.enquire')->with('success', 'Enquiry updated successfully');
    }

    public function edit(Request $request, $id)
    {
        $requests = Enquire::select('Enquire.*', 'services.name as service_name', 'service_time_slots.service_start_time as service_start_time', 'service_time_slots.service_end_time as service_end_time')
        ->leftJoin('services', 'Enquire.service', '=', 'services.id')
        ->leftJoin('service_time_slots', 'Enquire.time', '=', 'service_time_slots.id');
        $enquiry = Enquire::findOrFail($id);
        $services = Service::all(); // Fetch existing services
        $categories = Category::all(); // Fetch categories
        $holidays = Holiday::all(); // Fetch categories
        $holidayDates = $holidays->pluck('event_date')->toArray();
        $shop = Shop::find(1);
        $schedule = Schedule::where('activity_status', 'active')->pluck('day');
        // Example code in your controller
        $workingDays = json_encode(explode(',', $shop->working_days));

        return view('dashboard.Enquire.edit', compact('enquiry','services','categories','shop','workingDays','holidays','holidayDates','schedule','requests'));
      
    }

  
    public function delete($id)
    {
        $enquiry = Enquire::findOrFail($id);
        $enquiry->delete();
        return redirect()->route('dashboard.enquire')->with('success', 'Enquiry deleted successfully');
    }
    
}




