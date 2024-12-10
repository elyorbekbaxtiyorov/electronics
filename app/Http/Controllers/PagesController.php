<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class PagesController extends Controller
{
    // Method for the Home page
    public function index()
    {
        // Fetch categories with their products
        $categories = Category::with('products')->get();

        // Fetch all products regardless of category
        $products = Product::all();

        // Pass categories and products to the view
        return view('pages.home', compact('categories', 'products'));
    }

    // Method for the Create page
    public function create()
    {
        // Pass data like categories if necessary for creating a product
        $categories = Category::all();
        return view('pages.create', compact('categories'));
    }

    // Method for the Compare page
    public function compare(Request $request)
    {
        // Fetch products based on the selected IDs
        $productIds = $request->input('product_ids', []);
        $products = Product::whereIn('id', $productIds)->get();

        return view('pages.compare', compact('products'));
    }
}
