<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\SubSubCategory;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['brand', 'category'])->latest()->paginate(10);

        return view('backend.product.index', compact('products'));
    }

    public function create()
    {
        $brands = Brand::orderBy('name', 'asc')->get();
        $categories = Category::orderBy('name', 'asc')->get();
        $subcategories = SubCategory::with('category')->orderBy('name', 'asc')->get();
        $subsubcategories = SubSubCategory::with('subCategory.category')->orderBy('name', 'asc')->get();

        return view('backend.product.create', compact('brands', 'categories', 'subcategories', 'subsubcategories'));
    }

    public function store(StoreProductRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('products/thumbnail', 'public');
            $data['thumbnail'] = $path; // Overwrite the temp path with the real path
        }

        $data['hot_deals'] = $request->boolean('hot_deals');
        $data['featured'] = $request->boolean('featured');
        $data['special_offer'] = $request->boolean('special_offer');
        $data['special_deal'] = $request->boolean('special_deal');
        $data['status'] = $request->boolean('status');

        unset($data['multi_images']);

        $product = Product::create($data);

        if ($request->hasFile('multi_images')) {
            foreach ($request->file('multi_images') as $file) {
                $path = $file->store('products/gallery', 'public');
                $product->images()->create([
                    'image_path' => $path,
                ]);
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
    }
}
