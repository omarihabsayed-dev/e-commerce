<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use App\Models\SubCategory;
use App\Models\SubSubCategory;

class IndexController extends Controller
{
    public function index()
    {
        $allProducts = Product::where('status', true)->get();
        $brands = Brand::latest()->get();
        $sliders = Slider::where('status', true)->get();

        $featuredProducts = Product::where('featured', true)->where('status', true)->get();

        $hotDeals = Product::where('hot_deals', true)
            ->where('status', true)
            ->where('discount_price', '>', 0)
            ->get();

        $specialOffers = Product::where('special_offer', true)
            ->where('status', true)
            ->where('discount_price', '>', 0)
            ->get();

        $specialDeals = Product::where('special_deal', true)
            ->where('status', true)
            ->where('discount_price', '>', 0)
            ->get();

        $categoryProducts = Product::where('status', true)
            ->orderBy('name', 'asc')
            ->get()
            ->groupBy('category_id');

        $brandProducts = Product::where('status', true)
            ->orderBy('name', 'asc')
            ->get()
            ->groupBy('brand_id');

        $navCategories = Category::with(['subCategories.subSubCategories'])
            ->orderBy('name', 'asc')
            ->get();

        return view('frontend.index', compact(
            'navCategories',
            'sliders',
            'allProducts',
            'categoryProducts',
            'featuredProducts',
            'hotDeals',
            'specialOffers',
            'specialDeals',
            'brands',
            'brandProducts'
        ));
    }

    public function productDetails($slug)
    {
        $product = Product::where('slug', $slug)
            ->where('status', true)
            ->with(['images', 'brand', 'category'])
            ->firstOrFail();
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('status', 'true')
            ->take(4)
            ->get();

        return view('frontend.product.product_details', compact('product', 'relatedProducts'));

    }

    public function taggedProducts($tag)
    {
        $products = Product::where('status', true)
            ->where('tags', 'LIKE', '%'.$tag.'%')
            ->simplePaginate(9);
        $navCategories = Category::with(['subCategories.subSubCategories'])
            ->orderBy('name', 'asc')
            ->get();

        return view('frontend.tag.index', compact('products', 'navCategories', 'tag'));
    }

    public function categoryProducts($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $products = Product::where('category_id', $category->id)
            ->where('status', 'true')
            ->simplePaginate(9);
        $navCategories = Category::with(['subCategories.subSubCategories'])
            ->orderBy('name', 'asc')
            ->get();

        return view('frontend.product.category_view', compact('category', 'products', 'navCategories'));
    }

    public function subCategoryProducts($slug)
    {
        $subcategory = SubCategory::where('slug', $slug)->firstOrFail();
        $products = Product::where('sub_category_id', $subcategory->id)
            ->where('status', 'true')
            ->simplePaginate(9);
        $navCategories = Category::with(['subCategories.subSubCategories'])
            ->orderBy('name', 'asc')
            ->get();

        return view('frontend.product.sub_category_view', compact('subcategory', 'products', 'navCategories'));
    }

    public function subSubCategoryProducts($slug)
    {
        $subsubcategory = SubSubCategory::where('slug', $slug)->firstOrFail();
        $products = Product::where('sub_sub_category_id', $subsubcategory->id)
            ->where('status', true)
            ->simplePaginate(9);
        $navCategories = Category::with(['subCategories.subSubCategories'])
            ->orderBy('name', 'asc')
            ->get();

        return view('frontend.product.sub_sub_category_view', compact('subsubcategory', 'products', 'navCategories'));

    }
}
