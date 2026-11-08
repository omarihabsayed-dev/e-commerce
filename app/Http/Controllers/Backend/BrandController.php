<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::latest()->paginate(10);

        return view('backend.brand.index', compact('brands'));
    }

    public function store(Request $request)
    {
        $validated = request()->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if (request()->hasFile('image')) {
            $path = request()->file('image')->store('images', 'public');
            $fullPath = Storage::disk('public')->path($path);
            Image::decode($fullPath)
                ->cover(300, 300)
                ->save($fullPath);
            $validated['image'] = $path;
        }

        Brand::create($validated);

        return redirect()->route('admin.brands.index')->with('success', 'Brand created successfully.');
    }

    public function edit(Brand $brand)
    {
        return view('backend.brand.edit', compact('brand'));
    }

    public function update(Request $request, Brand $brand)
    {
        $validated = request()->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if (request()->hasFile('image')) {
            if ($brand->image && Storage::disk('public')->exists($brand->image)) {
                Storage::disk('public')->delete($brand->image);
            }
            $path = request()->file('image')->store('images', 'public');
            $fullPath = Storage::disk('public')->path($path);
            Image::decode($fullPath)
                ->cover(300, 300)
                ->save($fullPath);
            $validated['image'] = $path;
        }

        $brand->update($validated);

        return redirect()->route('admin.brands.index')->with('success', 'Brand updated successfully.');
    }

    public function destroy(Brand $brand)
    {
        if ($brand->image && Storage::disk('public')->exists($brand->image)) {
            Storage::disk('public')->delete($brand->image);
        }

        $brand->delete();

        return redirect()->route('admin.brands.index')->with('success', 'Brand deleted successfully.');
    }
}
