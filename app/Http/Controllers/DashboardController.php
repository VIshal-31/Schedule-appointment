<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index');
    }

    public function newrequest()
    {
        return view('dashboard.newrequest');
    }

    public function category()
    {
        return view('dashboard.category');
    }

    public function service()
    {
        return view('dashboard.service');
    }

    
    // Other methods for different dashboard functionalities
}

