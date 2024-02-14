<?php

namespace App\Http\Controllers;
use App\Models\Enquire;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Mail;

use App\Mail\AdminFormSubmitMail;
use App\Mail\UserFormSubmitMail;
use App\Models\ServiceTimeSlot;
use App\Models\Service;
use Carbon\Carbon;




class PostController extends Controller
{
    // Other methods...
    public function create()
    {
            return view('posts.create1');
    }


    public function store(Request $request)
    {       
        $request->validate([
            'title' => 'required|unique:posts|max:255',
            'body' => 'required|min:3',
            'address' => 'nullable|string',
           
        ]);

        $post = Post::create([
            'title' => $request->input('title'),
            'body' => $request->input('body'),
            'address' => $request->input('address'),

            
        ]);

        return back()->with('success', 'Data Submitted !!!');
        
    } 
   



    public function Enquire(Request $request)
    {
        $formData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'contact' => 'required',
            'category' => 'required|string',
            'service' => 'required|string',
            'date' => 'required|date',
            'time' => 'required',
            'message' => 'required|string',
        ]);
    
        // Retrieve timeslot information based on the selected time
        $selectedTimeId = $request->input('time');
        $timeSlot = ServiceTimeSlot::find($selectedTimeId);
    
        $serviceId = $request->input('service');
        $servicename = Service::find($serviceId);
    
        if (!$timeSlot || !$servicename) {
            \Log::error('Invalid Time ID or Service ID');
            return back()->withErrors(['time' => 'Invalid time or service selected']);
        }
    
        // Check if the date is today and service_start_time is less than the current time
        $currentDateTime = Carbon::now();
        $selectedDateTime = Carbon::parse($formData['date'] . ' ' . $timeSlot->service_start_time);
    
        if ($selectedDateTime->isToday() && $selectedDateTime->lt($currentDateTime)) {
            return back()->withErrors(['time' => 'Invalid time selected. Service start time has passed for today.']);
        }
    
        $existingEnquiry = Enquire::where([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'contact' => $request->input('contact'),
            'category' => $request->input('category'),
            'service' => $request->input('service'),
            'date' => $request->input('date'),
            'time' => $request->input('time'),
            'message' => $request->input('message'),      
        ])->first();
    
        if (!$existingEnquiry) {
        
        // Create Enquire record with the updated formData
        $enquire = Enquire::create([
            'name' => $formData['name'],
            'email' => $formData['email'],
            'contact' => $formData['contact'],
            'category' => $formData['category'],
            'service' => $formData['service'],
            'date' => $formData['date'],
            'time' => $formData['time'],
            'message' => $formData['message'],
            'service_start_time' => $timeSlot->service_start_time,
            'service_end_time' => $timeSlot->service_end_time,
            'service_name' => $servicename->name,
        ]);
    
        // Get the user's email and name from the request
        $userEmail = $request->input('email');
        $userName = $request->input('name');
        $category = $request->input('category');
        $service_name = $enquire->service_name;
        $date = $request->input('date');
        $service_start_time = $timeSlot->service_start_time;
        $service_end_time = $timeSlot->service_end_time;
    
        // Set the admin email address (replace with the actual admin email)
        $adminEmail = 'vishal@webwideit.solutions';
        $id = $enquire->id;
    
        // Send the email to the user

        Mail::to($userEmail)->send(new UserFormSubmitMail(
            $id,
            $userEmail,
            $userName,
            $category,
            $service_name,
            $date,
            $service_start_time,
            $service_end_time
        )); 
    
        // Send a separate email to the admin
        Mail::to($adminEmail)->send(new AdminFormSubmitMail($adminEmail,
        $id,
        $userEmail,
        $userName,
        $category,
        $service_name,
        $date,
        $service_start_time,
        $service_end_time
    ));
    
        return back()->with('success', 'Data Submitted !!!');
    }
    else {
        return back()->with('success', 'Data Submitted !!!');
    }
    }


    public function updateEnquiry(Request $request, $id)
        {
            $formData = $request->validate([
                'name' => 'required|string',
                'email' => 'required|email',
                'contact' => 'required',
                'category' => 'required|string',
                'service' => 'required|string',
                'date' => 'required|date',
                'time' => 'required',
                'message' => 'required|string',
                'status' => 'required', 
            ]);
        
            // Find the existing record by ID
            $enquiry = Enquire::findOrFail($id);
        
            // Update the record with new data
            $enquiry->update($formData);
        
            // Get the user's email and name from the request
            $userEmail = $request->input('email');
            $userName = $request->input('name');
        
            // Set the admin email address (replace with the actual admin email)
            $adminEmail = 'vishal@webwideit.solutions';
        
            // Send the email to the user
            Mail::to($userEmail)->send(new UserFormSubmitMail($userEmail, $userName));
        
            // Send a separate email to the admin
            Mail::to($adminEmail)->send(new AdminFormSubmitMail($adminEmail, $userName));
        
            return back()->with('success', 'Data Submitted !!!');
        }

}
