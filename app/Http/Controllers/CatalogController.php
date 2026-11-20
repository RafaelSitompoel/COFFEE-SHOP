<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Setting;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index(Request $request)
    {
        $settings = Setting::getShopSettings();
        $categories = Category::where('is_active', true)->withCount(['products' => function ($q) {
            $q->where('status', 'active');
        }])->get();

        $query = Product::with('category')->where('status', '!=', 'inactive');

        // Filter by category
        if ($request->filled('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        // Search by keyword
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('sku', 'like', "%{$search}%");
            });
        }

        // Sorting
        $sort = $request->get('sort', 'latest');
        switch ($sort) {
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('price', 'desc');
                break;
            case 'name_asc':
                $query->orderBy('name', 'asc');
                break;
            case 'latest':
            default:
                $query->latest();
                break;
        }

        $products = $query->paginate(9)->withQueryString();
        $currentCategory = $request->filled('category') 
            ? Category::where('slug', $request->category)->first() 
            : null;

        return view('frontend.catalog.index', compact('products', 'categories', 'currentCategory', 'settings'));
    }

    public function show($slug)
    {
        $settings = Setting::getShopSettings();
        $product = Product::with('category')
            ->where('slug', $slug)
            ->where('status', '!=', 'inactive')
            ->firstOrFail();

        $relatedProducts = Product::with('category')
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('status', 'active')
            ->take(4)
            ->get();

        return view('frontend.catalog.show', compact('product', 'relatedProducts', 'settings'));
    }
}
