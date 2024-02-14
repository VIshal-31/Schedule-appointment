<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enquire;


class CalendarController extends Controller
{
    public function index()
    {
        
        return view('dashboard.calendar.index');
    }

    public function getevent()
    {
        $requests = Enquire::select('Enquire.*')
        ->get() // Execute the query and retrieve the results
        ->toArray();
        return response()->json($requests);
        // dd($requests);
        
    }
}
