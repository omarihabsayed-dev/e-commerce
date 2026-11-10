<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function index()
    {
        $subcategories = SubCategory::with('category')->orderBy('name', 'asc')->get();
        $categories = Category::orderBy('name', 'asc')->get();

        return view('backend.subcategory.index', compact('subcategories', 'categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
        ]);

        SubCategory::create($validated);

        return redirect()->route('admin.subcategories.index')->with('success', 'SubCategory created successfully.');
    }

    public function edit(SubCategory $subcategory)
    {
        $categories = Category::orderBy('name', 'asc')->get();

        return view('backend.subcategory.edit', compact('subcategory', 'categories'));
    }

    public function update(Request $request, SubCategory $subcategory)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
        ]);

        $subcategory->update($validated);

        return redirect()->route('admin.subcategories.index')->with('success', 'SubCategory updated successfully.');
    }

    public function destroy(SubCategory $subcategory)
    {
        $subcategory->delete();

        return redirect()->route('admin.subcategories.index')->with('success', 'SubCategory deleted successfully.');
    }
}
