<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display the homepage with categories and products.
     */
 public function index()
{
    // Eager load categories and their products
    $categories = Category::with('products')->get();

    // Fetch all products, regardless of category
    $products = Product::all();

    // Pass both categories and products to the view
    return view('pages.home', compact('categories', 'products'));
}



    /**
     * Compare selected products.
     */
    public function compare(Request $request)
    {
        // Validate that product_ids is an array and not empty
        $request->validate([
            'product_ids' => 'required|array|min:2', // Ensure at least 2 products are selected
            'product_ids.*' => 'exists:products,id', // Ensure each product_id exists in the database
        ]);

        // Fetch selected products by IDs
        $products = Product::whereIn('id', $request->product_ids)->get();

        // Pass products to the comparison view
        return view('pages.compare', compact('products'));
    }

    /**
     * Show the form for creating a new product.
     */
    public function create()
    {
        // Fetch all categories for the dropdown selection
        $categories = Category::all();

        // Pass categories to the product creation view
        return view('pages.create', compact('categories'));
    }

    /**
     * Store a newly created product in the database.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'name' => 'required|string|max:255', // Product name is required and must be a string
            'price' => 'required|numeric|min:0', // Product price is required and must be a numeric value greater than or equal to 0
            'description' => 'required|string', // Product description is required
            'category_id' => 'required|exists:categories,id', // Category must exist in the database
        ]);

        // Create the new product using validated data
        Product::create($validated);

        // Redirect to the home page with a success message
        return redirect()->route('home')->with('success', 'Product created successfully!');
    }
}
