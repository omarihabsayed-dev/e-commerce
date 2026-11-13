<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use Illuminate\Http\Request;

class SubSubCategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('name', 'asc')->get();
        $subcategories = SubCategory::with('category')->orderBy('name', 'asc')->get();
        $subsubcategories = SubSubCategory::with('subCategory.category')->orderBy('name', 'asc')->paginate(10);

        return view('backend.subsubcategory.index', compact('subsubcategories', 'categories', 'subcategories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'sub_category_id' => 'required|exists:sub_categories,id',
        ]);

        SubSubCategory::create($validated);

        return redirect()->route('admin.subsubcategories.index')->with('success', 'Sub-SubCategory created successfully.');
    }

    public function edit(SubSubCategory $subsubcategory)
    {
        $categories = Category::orderBy('name', 'asc')->get();
        $subcategories = SubCategory::with('category')->orderBy('name', 'asc')->get();

        return view('backend.subsubcategory.edit', compact('subsubcategory', 'categories', 'subcategories'));
    }

    public function update(Request $request, SubSubCategory $subsubcategory)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'sub_category_id' => 'required|exists:sub_categories,id',
        ]);
        $subsubcategory->update($validated);

        return redirect()->route('admin.subsubcategories.index')->with('success', 'Sub-SubCategory updated successfully.');
    }

    public function destroy(SubSubCategory $subsubcategory)
    {
        $subsubcategory->delete();

        return redirect()->route('admin.subsubcategories.index')->with('success', 'Sub-SubCategory deleted successfully.');
    }
}
