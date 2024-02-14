<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Holiday;
use App\Models\ServiceTimeSlot;
use App\Models\Service;
use App\Models\Schedule;
use Carbon\Carbon;


class ShopController extends Controller
{
    public function index()
    {
        // Fetch the shop with ID 1, assuming the ID is 1
        $shop = Shop::find(1);
        // Extract the working days from the comma-separated string
        $workingDays = explode(',', $shop->working_days);
        // Retrieve all holidays
        $holidays = Holiday::all();
        $schedule = schedule::all();

        return view('dashboard.shop.index', [
            'shop' => $shop,
            'workingDays' => $workingDays,
            'holidays' => $holidays,
            'schedule' => $schedule,

        ]);
    }

    public function update(Request $request, $id)
    {

        $validatedData = $request->validate([

            'firstslotstarttime' => 'required',
            'firstslotendtime' => 'required',
            'secondslotstarttime' => 'required',
            'secondslotendtime' => 'required',
            'activity_status' => 'required',
            'day' => 'required',

        ]);

        $day = $validatedData['day'];

            // Additional check for the time slots
    if (strtotime($validatedData['firstslotstarttime']) >= strtotime($validatedData['firstslotendtime']) ||
        strtotime($validatedData['secondslotstarttime']) >= strtotime($validatedData['secondslotendtime']) ||
        strtotime($validatedData['secondslotstarttime']) < strtotime($validatedData['firstslotendtime'])
    ) {
        return redirect()->back()->with('error', 'Invalid time slots. Please check the time values.');
    }

    
        $schedule = Schedule::find($id); // Find the shop by its ID (change '1' to the required ID)
    
        if ($schedule) {
            // Delete all existing service time slots for the shop
            ServiceTimeSlot::where('day', $day)->delete();
    
            // Update shop opening time
            $schedule->first_slot_start_time = $validatedData['firstslotstarttime'];
            $schedule->first_slot_end_time = $validatedData['firstslotendtime'];
            $schedule->second_slot_start_time = $validatedData['secondslotstarttime'];
            $schedule->second_slot_end_time = $validatedData['secondslotendtime'];
            $schedule->activity_status = $validatedData['activity_status'];
            $schedule->day = $validatedData['day'];
            $schedule->save();
    
            // Recreate service time slots based on the new shop opening time for all services
            $services = Service::pluck('id')->toArray();
            $this->createServiceTimeSlots1($schedule, $services);
    
            return redirect()->route('dashboard.shop')->with('success', 'Schedule updated successfully');

        } else {
            return redirect()->back()->with('error', 'Shop not found!');
        }
    }

    public function saveShop(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'name' => 'required|string|max:255', // You can add more validation rules if needed
        ]);

        // Save the shop name to the database
        $shop = new Shop();
        $shop->name = $validatedData['name'];
        // Add additional fields like opening_time, closing_time, working_days, etc., as needed
        $shop->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Name changed successfully!');
    }


    public function updateShopName(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $shop = Shop::find(1); // Find the shop by its ID (change '1' to the required ID)

        if ($shop) {
            $shop->name = $validatedData['name'];
            $shop->save();

            return redirect()->back()->with('success', 'Name updated successfully!');
        } else {
            return redirect()->back()->with('error', 'Shop not found!'); // Handle the case where the shop with the given ID isn't found
        }
    }

    public function updateShopStartTime(Request $request)
    {
        $validatedData = $request->validate([
            'start_time' => 'required|date_format:H:i',
        ]);
    
        $shop = Shop::find(1); // Find the shop by its ID (change '1' to the required ID)
    
        if ($shop) {
            // Delete all existing service time slots for the shop
            ServiceTimeSlot::truncate();
    
            // Update shop opening time
            $shop->opening_time = $validatedData['start_time'];
            $shop->save();
    
            // Recreate service time slots based on the new shop opening time for all services
            $services = Service::pluck('id')->toArray();
            $this->createServiceTimeSlots($shop, $services);
    
            return redirect()->back()->with('success', 'Start time updated successfully!');
        } else {
            return redirect()->back()->with('error', 'Shop not found!');
        }
    }
    

    private function createServiceTimeSlots1($schedule, $serviceIds)
    {
    // Add the logic to create time slots for each service
    foreach ($serviceIds as $serviceId) {
        $service = Service::find($serviceId);

        if ($service) {
            $interval = $service->time_required;
                
            // Explicitly set seconds to 0
            $firstopeningTime = Carbon::parse($schedule->first_slot_start_time)->setSeconds(0);
            $firstclosingTime = Carbon::parse($schedule->first_slot_end_time)->setSeconds(0);
            $secondopeningTime = Carbon::parse($schedule->second_slot_start_time)->setSeconds(0);
            $secondclosingTime = Carbon::parse($schedule->second_slot_end_time)->setSeconds(0);
            
            $days = $schedule->day;
            $activitystatuss = $schedule->activity_status;
            

            $currentSlotStartTime = $firstopeningTime->copy();

            while ($currentSlotStartTime < $firstclosingTime) {
                $currentSlotEndTime = $currentSlotStartTime->copy()->addMinutes($interval);

                // Ensure the end time is within the closing time
                $currentSlotEndTime = $currentSlotEndTime->isAfter($firstclosingTime) ? $firstclosingTime : $currentSlotEndTime;

                // Create a new service time slot only if the end time is before closing time
                if ($currentSlotEndTime < $firstclosingTime) {
                    ServiceTimeSlot::create([
                        'service_id' => $serviceId,
                        'service_start_time' => $currentSlotStartTime->format('H:i'),
                        'service_end_time' => $currentSlotEndTime->format('H:i'),
                        'day' => $days,
                        'activity_status' => $activitystatuss,  
                    ]);
                }

                // Move to the next slot
                $currentSlotStartTime = $currentSlotStartTime->addMinutes($interval);
            }

            $currentSlotStartTime = $secondopeningTime->copy();

            while ($currentSlotStartTime < $secondclosingTime) {
                $currentSlotEndTime = $currentSlotStartTime->copy()->addMinutes($interval);

                // Ensure the end time is within the closing time
                $currentSlotEndTime = $currentSlotEndTime->isAfter($secondclosingTime) ? $secondclosingTime : $currentSlotEndTime;

                // Create a new service time slot only if the end time is before closing time
                if ($currentSlotEndTime < $secondclosingTime) {
                    ServiceTimeSlot::create([
                        'service_id' => $serviceId,
                        'service_start_time' => $currentSlotStartTime->format('H:i'),
                        'service_end_time' => $currentSlotEndTime->format('H:i'),
                        'day' => $days,
                        'activity_status' => $activitystatuss,
                    ]);
                }

                // Move to the next slot
                $currentSlotStartTime = $currentSlotStartTime->addMinutes($interval);
            }
        }
    }
}

    public function updateShopCloseTime(Request $request)
    {
        $validatedData = $request->validate([
            'closing_time' => 'required|date_format:H:i',
        ]);
    
        $shop = Shop::find(1); // Find the shop by its ID (change '1' to the required ID)
    
        if ($shop) {
            // Delete all existing service time slots for the shop
            ServiceTimeSlot::truncate();
    
            // Update shop closing time
            $shop->closing_time = $validatedData['closing_time'];
            $shop->save();
    
            // Recreate service time slots based on the new shop closing time for all services
            $services = Service::pluck('id')->toArray();
            $this->createServiceTimeSlots($shop, $services);
    
            return redirect()->back()->with('success', 'Closing time updated successfully!');
        } else {
            return redirect()->back()->with('error', 'Shop not found!');
        }
    }
    
    private function createServiceTimeSlots($shop, $serviceIds)
    {
    // Add the logic to create time slots for each service
    foreach ($serviceIds as $serviceId) {
        $service = Service::find($serviceId);

        if ($service) {
            $interval = $service->time_required;

            // Explicitly set seconds to 0
            $openingTime = Carbon::parse($shop->opening_time)->setSeconds(0);
            $closingTime = Carbon::parse($shop->closing_time)->setSeconds(0);

            $currentSlotStartTime = $openingTime->copy();

            while ($currentSlotStartTime < $closingTime) {
                $currentSlotEndTime = $currentSlotStartTime->copy()->addMinutes($interval);

                // Ensure the end time is within the closing time
                $currentSlotEndTime = $currentSlotEndTime->isAfter($closingTime) ? $closingTime : $currentSlotEndTime;

                // Create a new service time slot only if the end time is before closing time
                if ($currentSlotEndTime < $closingTime) {
                    ServiceTimeSlot::create([
                        'service_id' => $serviceId,
                        'service_start_time' => $currentSlotStartTime->format('H:i'),
                        'service_end_time' => $currentSlotEndTime->format('H:i'),
                        'day' => $day,
                    ]);
                }

                // Move to the next slot
                $currentSlotStartTime = $currentSlotStartTime->addMinutes($interval);
            }
        }
    }
}

    

    public function updateDays(Request $request)
{
    try {
        // Get the checked checkboxes
        $selectedDays = $request->input('days', []);

        // Convert the array to a comma-separated string (if you're storing as string in the database)
        $daysAsString = implode(',', $selectedDays);

        // Find the shop record, assuming you have the shop ID stored in a variable
        $shop = Shop::find(1);

        if ($shop) {
            // Update the 'day' column with the selected days
            $shop->working_days = $daysAsString;
            $shop->save();

            return redirect()->back()->with('success', 'Working days updated successfully!');
        } else {
            return redirect()->back()->with('error', 'Shop not found!');
        }
    } catch (\Exception $e) {
        // Log the error or handle it as needed
        return redirect()->back()->with('error', 'An error occurred while updating working days.');
    }


        // Redirect back or do whatever is necessary after saving
    }


    public function showFilteredHolidays(Request $request)
    {
        $selectedMonth = $request->input('month');
        $selectedYear = $request->input('year');
    
        // Fetch holidays based on the selected month and year
        $filteredHolidays = Holiday::whereMonth('event_date', $selectedMonth)
                                    ->whereYear('event_date', $selectedYear)
                                    ->get();
    
        return response()->json(['holidays' => $filteredHolidays]);
    }




}
