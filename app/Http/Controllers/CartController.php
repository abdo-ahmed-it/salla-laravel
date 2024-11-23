<?php

namespace App\Http\Controllers;

use App\Http\Resources\CartResource;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends BaseController
{
    public function index()
    {
        $data = Cart::query()->where('user_id', auth()->user()->id)->where('quantity', '>', 0)->get();
        return $this->sendSuccess(CartResource::collection($data));
    }

    public function store(Request $request, $product_id)
    {

        $product = Product::query()->findOrFail($product_id);
        if ($product->quantity < ($request['quantity'] ?? 1)) {
            return $this->sendError('Not enough quantity');
        }


        $cartItem = Cart::query()->updateOrCreate(
            [
                'user_id' => auth()->user()->id,
                'product_id' => $product->id,
            ],
            [
                'quantity' => $request['quantity'] ?? 1,
            ]
        );
        return $this->sendSuccess(CartResource::make($cartItem), 'Product added to cart');
    }


}
