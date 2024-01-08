<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Service;



class DomainController extends Controller
{
    public function index()
    {
        // Logic for displaying services
        $services = Service::all(); // Fetch existing services
        $categories = Category::all(); // Fetch categories
        return view('index', compact('services','categories'));
    }


public function getServices($category_id)
{
    $services = Service::where('category_id', $category_id)->get();
    return response()->json($services);
}

}

