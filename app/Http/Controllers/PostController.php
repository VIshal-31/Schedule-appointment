<?php

namespace App\Http\Controllers;
use App\Models\FormSubmission;
use Illuminate\Http\Request;
use App\Models\Post;

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
            // 'name' => 'required|string',
            // 'email' => 'required|email',
            // 'category' => 'required|string',
            // 'service' => 'required|string',
            // 'date' => 'required|date',
            // 'time' => 'required',
            // 'message' => 'required|string',
         ]);
        
         $formSubmission = FormSubmission::create($formData);
        
         // Optionally, return a response or redirect
         return back()->with('success', 'Data Submitted !!!');
        }



}
