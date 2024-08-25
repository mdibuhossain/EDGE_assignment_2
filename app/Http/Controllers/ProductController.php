<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getProducts()
    {
        $products = Product::all();
        return response()->json($products);
    }

    public function getProductById($id)
    {
        $product = Product::find($id);
        return response()->json($product);
    }

    public function storeProduct(Request $request)
    {
        $product = Product::create($request->all());
        $product->save();
        return response()->json(['message' => 'Product created', 'status' => 'success', 'data' => $product], 200);
    }

    public function updateProduct(Request $request, $id)
    {
        $product = Product::find($id);
        $product->update($request->all());
        return response()->json($product);
    }

    public function destroyProduct($id)
    {
        $product = Product::find($id);
        $product->delete();
        return response()->json($product);
    }
}
