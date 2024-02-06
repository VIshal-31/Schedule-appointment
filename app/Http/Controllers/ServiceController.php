<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Service;
use App\Models\Schedule;
use App\Models\ServiceTimeSlot;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;


class ServiceController extends Controller
{
    public function index()
    {
        // Logic for displaying services
        $services = Service::all(); // Fetch existing services
        $categories = Category::all(); // Fetch categories
        return view('dashboard.services.index', compact('services','categories'));
    }


    public function store(Request $request)
    {
    try {

        $validatedData = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => [
                'required',
                Rule::unique('services')->where(function ($query) use ($request) {
                    return $query->where('category_id', $request->category_id);
                }),
            ],
            'timerequired' => 'required|numeric',
            // Other validation rules
        ]);

        // Create the service
        $service = Service::create([
            'category_id' => $validatedData['category_id'],
            'name' => $validatedData['name'],
            'time_required' => $validatedData['timerequired'],
            
            
            // Other fields as necessary
        ]);

        // Loop through schedules from ID 1 to 7
        for ($scheduleId = 1; $scheduleId <= 7; $scheduleId++) {
            
            $schedule = Schedule::find($scheduleId);
            
            $shopStartTime = Carbon::createFromFormat('H:i:s', $schedule->first_slot_start_time); // Convert to Carbon
            $shopEndTime = Carbon::createFromFormat('H:i:s', $schedule->first_slot_end_time); // Convert to Carbon   
            $days = $schedule->day ;
            $activity_statuss = $schedule->activity_status ;
            // data from form

            // Validate service start time and end time
            $serviceStartTime = $shopStartTime;
            $serviceEndTime = $serviceStartTime->copy()->addMinutes($validatedData['timerequired']);
    
            if (!$schedule || !$schedule->first_slot_start_time || !$schedule->first_slot_end_time) {
                // Schedule not found or missing start/end time
                return redirect()->back()->withErrors(['timerequired' => 'Unable to fetch schedule details. Schedule data may be missing.'])->withInput();
            }
    
            if ( $serviceEndTime < $shopEndTime) {
    
                // Create service time slots
                $interval = $validatedData['timerequired'];
                $currentSlotStartTime = $shopStartTime;
                $endtime = $shopStartTime->copy()->addMinutes($interval)->format('H:i');
    
                while ($endtime <= $shopEndTime) {
    
                    $currentSlotEndTime = $currentSlotStartTime->copy()->addMinutes($interval);
                    // Create a new service time slot
                    ServiceTimeSlot::create([
                        'service_id' => $service->id,
                        'service_start_time' => $currentSlotStartTime->format('H:i'), // Format as 'H:i'
                        'service_end_time' => $currentSlotEndTime->format('H:i'), // Format as 'H:i'
                        'day' => $days,
                        'activity_status' => $activity_statuss,
                    ]);
    
                    // Move to the next slot
                    $currentSlotStartTime = $currentSlotEndTime;
                    $endtime = $currentSlotEndTime->copy()->addMinutes($interval);
                }


                $secondshopStartTime = Carbon::createFromFormat('H:i:s', $schedule->second_slot_start_time); // Convert to Carbon
                $secondshopEndTime = Carbon::createFromFormat('H:i:s', $schedule->second_slot_end_time); // Convert to Carbon   
    
                $secondserviceEndTime = $serviceStartTime->copy()->addMinutes($validatedData['timerequired']);

                $interval = $validatedData['timerequired'];
                $secondcurrentSlotStartTime = $secondshopStartTime;
                $secondendtime = $secondshopStartTime->copy()->addMinutes($interval)->format('H:i');

                while ($secondendtime <= $secondshopEndTime) {
    
                    $secondcurrentSlotEndTime = $secondcurrentSlotStartTime->copy()->addMinutes($interval);
                    // Create a new service time slot
                    ServiceTimeSlot::create([
                        'service_id' => $service->id,
                        'service_start_time' => $secondcurrentSlotStartTime->format('H:i'), // Format as 'H:i'
                        'service_end_time' => $secondcurrentSlotEndTime->format('H:i'), // Format as 'H:i'
                        'day' => $days,
                        'activity_status' => $activity_statuss,
                    ]);
    
                    // Move to the next slot
                    $secondcurrentSlotStartTime = $secondcurrentSlotEndTime;
                    $secondendtime = $secondcurrentSlotEndTime->copy()->addMinutes($interval);
                }
            }
        }
                // Redirect back with success message if needed
                return redirect()->back()->with('success', 'Service added successfully');
    
             
        
    
        } catch (ValidationException $e) {
            // Redirect back with errors if validation fails
            return redirect()->back()->withErrors($e->validator->errors())->withInput();
        }
    }
    

    public function show(Service $Service)
    {
        // Show a specific service
        return view('services.show', ['Service' => $Service]);
    }

    public function edit(Service $service)
    {
        // Show the form to edit a specific service
        $categories = Category::all(); // Fetch categories
        return view('dashboard.services.edit', ['service' => $service, 'categories' => $categories]);

    }

 

   

    public function update(Request $request, $id)
{
    try {
        // Fetch the service you want to update
        $service = Service::findOrFail($id);

        // Validate form data
        $validatedData = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => [
                'required',
                Rule::unique('services')->where(function ($query) use ($request, $id) {
                    return $query->where('category_id', $request->category_id)->whereNotIn('id', [$id]);
                }),
            ],
            'timerequired' => 'required|numeric',
            // Other validation rules
        ]);

        // Update service details
        $service->update([
            'category_id' => $validatedData['category_id'],
            'name' => $validatedData['name'],
            'time_required' => $validatedData['timerequired'],
            // Update other fields as necessary
        ]);

        // Update service time slots
        $shop = Shop::find(1); // Assuming the shop you want has id = 1
        $shopStartTime = Carbon::createFromFormat('H:i:s', $shop->first_slot_start_time);
        $shopEndTime = Carbon::createFromFormat('H:i:s', $shop->first_slot_end_time);

        $interval = $validatedData['timerequired'];
        $currentSlotStartTime = $shopStartTime;
        $endtime = $shopStartTime->copy()->addMinutes($interval)->format('H:i');

        // Delete existing service time slots for the updated service
        ServiceTimeSlot::where('service_id', $service->id)->delete();

        // Recreate service time slots based on the updated time requirements
        while ($endtime <= $shopEndTime) {
            $currentSlotEndTime = $currentSlotStartTime->copy()->addMinutes($interval);
            // Create a new service time slot
            ServiceTimeSlot::create([
                'service_id' => $service->id,
                'service_start_time' => $currentSlotStartTime->format('H:i'), // Format as 'H:i'
                'service_end_time' => $currentSlotEndTime->format('H:i'), // Format as 'H:i'
            ]);

            // Move to the next slot
            $currentSlotStartTime = $currentSlotEndTime;
            $endtime = $currentSlotEndTime->copy()->addMinutes($interval);
        }

        return redirect()->route('dashboard.services')->with('success', 'Service updated successfully');

    } catch (ModelNotFoundException $e) {
        return redirect()->back()->withErrors(['timerequired' => 'Service not found.'])->withInput();
    } catch (ValidationException $e) {
        // Redirect back with errors if validation fails
        return redirect()->back()->withErrors($e->validator->errors())->withInput();
    }
}

    
    public function timeSlots()
    {
        return $this->hasMany(ServiceTimeSlot::class);
    }
    
    public function confirmDelete(Service $service)
    {
        // Show the confirmation page before deleting the service
        return view('dashboard.services.confirm-delete', ['service' => $service]);
    }

    public function destroy(Service $service)
    {
        // Delete a specific service
        $service->delete();
        return redirect()->route('dashboard.services')->with('success', 'Service deleted successfully');
    }

    public function getServicesByCategory($categoryId) {
        $services = Service::where('category_id', $categoryId)->get();
        return response()->json($services);
    }
}
