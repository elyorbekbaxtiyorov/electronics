<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of all categories.
     */
    public function index()
    {
        // Fetch all categories
        $categories = Category::all();

        // Return the view with the categories
        return view('pages.home', compact('categories'));
    }

    /**
     * Show the form for creating a new category.
     */
    public function create()
    {
        return view('pages.create');
    }

    /**
     * Store a newly created category in the database.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'description' => 'nullable|string',
        ]);

        // Create a new category
        Category::create($validated);

        // Redirect to the categories page with a success message
        return redirect()->route('categories.index')->with('success', 'Category created successfully!');
    }

    /**
     * Display the specified category.
     */
    public function show($id)
    {
        // Find the category by ID or throw a 404 error
        $category = Category::findOrFail($id);

        // Return the category details view
        return view('pages.show', compact('category'));
    }

    /**
     * Show the form for editing the specified category.
     */
    public function edit($id)
    {
        // Find the category by ID
        $category = Category::findOrFail($id);

        // Return the edit view
        return view('pages.edit', compact('category'));
    }

    /**
     * Update the specified category in the database.
     */
    public function update(Request $request, $id)
    {
        // Find the category by ID
        $category = Category::findOrFail($id);

        // Validate the updated data
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $id,
            'description' => 'nullable|string',
        ]);

        // Update the category
        $category->update($validated);

        // Redirect back with a success message
        return redirect()->route('categories.index')->with('success', 'Category updated successfully!');
    }

    /**
     * Remove the specified category from the database.
     */
    public function destroy($id)
    {
        // Find and delete the category
        $category = Category::findOrFail($id);
        $category->delete();

        // Redirect back with a success message
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully!');
    }
}
