<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class ServiceController extends Controller
{
    public function index()
    {
        // Logic for displaying services
        $services = Service::all(); // Fetch existing services
        $categories = Category::all(); // Fetch categories
        return view('dashboard.services.index', compact('services','categories'));
    }


    public function store(Request $request){
    try {
        $validatedData = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => [
                'required',
                Rule::unique('services')->where(function ($query) use ($request) {
                    return $query->where('category_id', $request->category_id);
                }),
            ],
            // Other validation rules
        ]);

        $service = Service::create([
            'category_id' => $validatedData['category_id'],
            'name' => $validatedData['name'],
            // Other fields as necessary
        ]);

        // Redirect back with success message if needed
        return redirect()->back()->with('success', 'Service added successfully');
    } catch (ValidationException $e) {
        // Redirect back with errors if validation fails
        return redirect()->back()->withErrors($e->validator->errors())->withInput();
    }
}

    public function show(Service $Service)
    {
        // Show a specific service
        return view('services.show', ['Service' => $Service]);
    }

    public function edit(Service $service)
    {
        // Show the form to edit a specific service
        $categories = Category::all(); // Fetch categories
        return view('dashboard.services.edit', ['service' => $service, 'categories' => $categories]);

    }

    public function update(Request $request, Service $service)
    {
        // Validate and update the service
        try {
            $validatedData = $request->validate([
                'category_id' => 'required|exists:categories,id',
                'name' => [
                    'required',
                    Rule::unique('services')->where(function ($query) use ($request, $service) {
                        return $query->where('category_id', $request->category_id)->where('id', '!=', $service->id);
                    }),
                ],
                // Other validation rules
            ]);

            $service->update([
                'category_id' => $validatedData['category_id'],
                'name' => $validatedData['name'],
                // Other fields as necessary
            ]);
           
            // Redirect back with success message if needed
            return redirect()->route('dashboard.services')->with('success', 'Service updated successfully');
        } catch (ValidationException $e) {
            // Redirect back with errors if validation fails
            return redirect()->back()->withErrors($e->validator->errors())->withInput();
        }
    }

    public function confirmDelete(Service $service)
    {
        // Show the confirmation page before deleting the service
        return view('dashboard.services.confirm-delete', ['service' => $service]);
    }

    public function destroy(Service $service)
    {
        // Delete a specific service
        $service->delete();
        return redirect()->route('dashboard.services')->with('success', 'Service deleted successfully');
    }
}
