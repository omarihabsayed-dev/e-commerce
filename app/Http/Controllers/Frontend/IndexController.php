<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Slider;

class IndexController extends Controller
{
    public function index()
    {
        $sliders = Slider::where('status', true)->get();
        $navCategories = Category::with(['subCategories.subSubCategories'])
            ->orderBy('name', 'asc')
            ->get();

        return view('frontend.index', compact('navCategories', 'sliders'));
    }
}
