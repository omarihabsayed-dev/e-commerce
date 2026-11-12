<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\SubSubCategory;

class ProductController extends Controller
{
    public function create()
    {
        $brands = Brand::orderBy('name', 'asc')->get();
        $categories = Category::orderBy('name', 'asc')->get();
        $subcategories = SubCategory::with('category')->orderBy('name', 'asc')->get();
        $subsubcategories = SubSubCategory::with('subCategory.category')->orderBy('name', 'asc')->get();

        return view('backend.product.create', compact('brands', 'categories', 'subcategories', 'subsubcategories'));
    }
}
