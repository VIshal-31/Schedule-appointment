<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Service;
use App\Models\Shop;




class DomainController extends Controller
{
    public function index()
    {
        // Logic for displaying services
        $services = Service::all(); // Fetch existing services
        $categories = Category::all(); // Fetch categories
        $shop = Shop::find(1);
        return view('index', compact('services','categories','shop'));
        return response()->json($shop);
    }


    public function getServices($category_id)
    {
        $services = Service::where('category_id', $category_id)->get();
        return response()->json($services);
    }




}

