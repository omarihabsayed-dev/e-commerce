<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function store(Request $request, string $id)
    {
        $product = Product::findOrFail($id);
        $price = ($product->discount_price && $product->discount_price > 0)
        ? $product->discount_price
        : $product->price;
        Cart::add([
            'id' => (string) $id,
            'name' => $request->product_name,
            'quantity' => (int) $request->quantity,
            'price' => $price,
            'attributes' => [
                'image' => $product->thumbnail,
                'size' => $request->size,
                'color' => $request->color,
                'slug' => $product->slug ?? null,
            ],
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Item added to cart.',
            'totalQuantity' => Cart::getTotalQuantity(),
            'subTotal' => Cart::getSubTotal(),
        ]);
    }
}
