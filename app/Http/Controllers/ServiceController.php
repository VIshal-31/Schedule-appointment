<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Service;
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
    
            // Fetch shop start time and end time from the shops table
            $shop = Shop::find(1); // Assuming the shop you want has id = 1
    
            if (!$shop || !$shop->opening_time || !$shop->closing_time) {
                // Shop not found or missing start/end time
                return redirect()->back()->withErrors(['timerequired' => 'Unable to fetch shop details. Shop data may be missing.'])->withInput();
            }
    
            $shopStartTime = Carbon::createFromFormat('H:i:s', $shop->opening_time); // Convert to Carbon
            $shopEndTime = Carbon::createFromFormat('H:i:s', $shop->closing_time); // Convert to Carbon
    
            // Validate service start time and end time
            $serviceStartTime = $shopStartTime;
            $serviceEndTime = $serviceStartTime->copy()->addMinutes($validatedData['timerequired']);
    
            if ($serviceStartTime < $shopStartTime || $serviceEndTime > $shopEndTime) {
                // Service time is not within the shop's operating hours
                return redirect()->back()->withErrors(['timerequired' => 'Service time should be within shop hours.'])->withInput();
            }
    
            // Create the service
            $service = Service::create([
                'category_id' => $validatedData['category_id'],
                'name' => $validatedData['name'],
                'time_required' => $validatedData['timerequired'],
                // Other fields as necessary
            ]);
    
            // Create service time slots
            $interval = $serviceStartTime->diffInMinutes($serviceEndTime);
            $currentSlotStartTime = $serviceStartTime;
    
            while ($currentSlotStartTime < $shopEndTime || $serviceEndTime < $shopEndTime) {
                $currentSlotEndTime = $currentSlotStartTime->copy()->addMinutes($interval);
    
                // Ensure the slot end time is within shop hours
                if ($currentSlotEndTime > $shopEndTime) {
                    $currentSlotEndTime = $shopEndTime;
                }
    
                // Create a new service time slot
                ServiceTimeSlot::create([
                    'service_id' => $service->id,
                    'service_start_time' => $currentSlotStartTime,
                    'service_end_time' => $currentSlotEndTime,
                    // Other fields as necessary
                ]);
    
                // Move to the next slot
                $currentSlotStartTime = $currentSlotEndTime;
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

    public function update(Request $request, Service $service)
    {
        // Validate and update the service
        try {
            $validatedData = $request->validate([
                'category_id' => 'required|exists:categories,id',
                'name' => [
                    'required',
                    Rule::unique('services')->where(function ($query) use ($request, $service) {
                        return $query->where('category_id', $request->category_id)->where('id', '!=', $service->id);
                    }),
                ],
                // Other validation rules
                'timerequired' => 'required|numeric',
            ]);

            $service->update([
                'category_id' => $validatedData['category_id'],
                'name' => $validatedData['name'],
                'time_required' => $validatedData['timerequired'],

                // Other fields as necessary
            ]);
           
            // Redirect back with success message if needed
            return redirect()->route('dashboard.services')->with('success', 'Service updated successfully');
        } catch (ValidationException $e) {
            // Redirect back with errors if validation fails
            return redirect()->back()->withErrors($e->validator->errors())->withInput();
        }
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


