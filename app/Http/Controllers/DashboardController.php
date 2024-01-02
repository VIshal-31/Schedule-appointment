<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index');
    }

    public function requests()
    {
        return view('dashboard.request');
    }
    
    // Other methods for different dashboard functionalities
}

