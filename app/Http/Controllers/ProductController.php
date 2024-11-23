<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $products = Product::query()->paginate(10);
        return response()->json(ProductResource::collection($products)->resource);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'image_url' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors());
        }
        $product = Product::query()->create($request->all());
        return $this->sendSuccess(ProductResource::make($product));

    }


    /**
     * Display the specified resource.
     */
    public function show($id): JsonResponse
    {
        $product = Product::query()->findOrFail($id);
        return $this->sendSuccess(ProductResource::make($product));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $product = Product::query()->findOrFail($id);
        $product->update($request->all());
        return $this->sendSuccess(ProductResource::make($product));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::query()->findOrFail($id);
        $product->delete();
        return $this->sendSuccess(ProductResource::make($product));
    }
}
