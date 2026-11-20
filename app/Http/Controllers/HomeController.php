<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Setting;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $settings = Setting::getShopSettings();

        $featuredProducts = Product::with('category')
            ->where('status', 'active')
            ->where('is_featured', true)
            ->latest()
            ->take(6)
            ->get();

        $categories = Category::where('is_active', true)
            ->withCount(['products' => function ($query) {
                $query->where('status', 'active');
            }])
            ->get();

        $latestProducts = Product::with('category')
            ->where('status', 'active')
            ->latest()
            ->take(8)
            ->get();

        return view('frontend.home', compact('settings', 'featuredProducts', 'categories', 'latestProducts'));
    }
}
