<?php

namespace App\Http\Controllers;
use App\Models\Enquire;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Mail;

use App\Mail\AdminFormSubmitMail;
use App\Mail\UserFormSubmitMail;



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
            'category' => 'required|string',
            'service' => 'required|string',
            'date' => 'required|date',
            'time' => 'required',
            'message' => 'required|string',
         ]);
        
         $Enquire = Enquire::create($formData);

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
