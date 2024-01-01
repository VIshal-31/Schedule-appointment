<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        // Logic for displaying services
        return view('dashboard.services.index');
    }

    public function create()
    {
        // Show the form to create a new service
        return view('services.create');
    }

    public function store(Request $request)
    {
        // Store a newly created service
        Service::create($request->all());
        return redirect()->route('services.index');
    }

    public function show(Service $Service)
    {
        // Show a specific service
        return view('services.show', ['Service' => $Service]);
    }

    public function edit(Service $Service)
    {
        // Show the form to edit a specific service
        return view('services.edit', ['Service' => $Service]);
    }

    public function update(Request $request, Service $Service)
    {
        // Update a specific service
        $Service->update($request->all());
        return redirect()->route('services.index');
    }

    public function destroy(Service $Service)
    {
        // Delete a specific service
        $Service->delete();
        return redirect()->route('services.index');
    }
}
