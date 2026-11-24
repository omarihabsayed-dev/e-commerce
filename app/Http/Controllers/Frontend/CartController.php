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

        $rowId = $product->id.'-'.$request->color.'-'.$request->size;

        Cart::add([
            'id' => $rowId,
            'name' => $request->product_name,
            'quantity' => (int) $request->quantity,
            'price' => $price,
            'attributes' => [
                'product_id' => $product->id,
                'image' => $product->thumbnail,
                'size' => $request->size,
                'color' => $request->color,
                'slug' => $product->slug ?? null,
            ],
        ]);

        session()->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Item added to cart.',
            'totalQuantity' => Cart::getTotalQuantity(),
            'subTotal' => Cart::getSubTotal(),
        ]);
    }

    public function miniCart()
    {
        $items = Cart::getContent()->map(function ($item) {
            return [
                'rowId' => $item->id,
                'product_id' => $item->attributes->product_id ?? $item->id,
                'name' => $item->name,
                'quantity' => $item->quantity,
                'price' => (float) $item->price,
                'lineTotal' => (float) $item->getPriceSum(),
                'image' => $item->attributes->image ?? null,
                'color' => $item->attributes->color ?? null,
                'size' => $item->attributes->size ?? null,
                'slug' => $item->attributes->slug ?? null,
            ];
        });

        return response()->json([
            'status' => 'success',
            'items' => $items->values(),
            'totalQuantity' => Cart::getTotalQuantity(),
            'subTotal' => (float) Cart::getSubTotal(),
            'total' => (float) Cart::getTotal(),
        ]);
    }

    public function destroy($rowId)
    {
        Cart::remove($rowId);

        return response()->json([
            'status' => 'success',
            'message' => 'Item removed from cart.',
            'totalQuantity' => Cart::getTotalQuantity(),
            'subTotal' => (float) Cart::getSubTotal(),
            'total' => (float) Cart::getTotal(),
        ]);
    }
}
