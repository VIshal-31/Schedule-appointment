<?php

namespace App\Http\Controllers;

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
    
    try{
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
        
    } catch (\Exception $e) {
        dd($e->getMessage()); // Output any database-related error messages
    }
}
    
}
