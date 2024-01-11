<?php

// app/Http/Controllers/HolidayController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Holiday;

class HolidayController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'event_name' => 'required|string',
            'event_date' => 'required|date',
        ]);

        $holiday = new Holiday([
            'event_name' => $request->input('event_name'),
            'event_date' => $request->input('event_date'),
        ]);

        $holiday->save();

        return redirect()->back()->with('success', 'Holiday added successfully');
    }
}
