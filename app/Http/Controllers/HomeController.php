<?php

namespace App\Http\Controllers;
use App\Models\Smartphone;
use App\Models\Category;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Data untuk homepage
        $totalSmartphones = Smartphone::active()->count();
        $totalCategories = Category::active()->count();
        
        return view('home.index', compact('totalSmartphones', 'totalCategories'));
    }

    public function about()
    {
        return view('home.about');
    }
}
