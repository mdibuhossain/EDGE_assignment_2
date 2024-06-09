<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function getCarts()
    {
        $carts = Cart::with('product')->where("user_id", session()->get("uid"))->get();
        return response()->json($carts);
    }
    public function addProductToCart($id)
    {
        $newCart = new Cart;
        $newCart->user_id = session()->get('uid');
        $newCart->product_id = $id;
        $newCart->save();
        return response()->json(['message' => 'Product added to cart successfully']);
    }

    public function removeProductFromCart($id)
    {
        $findCart = Cart::where('user_id', session()->get('uid'))->where('product_id', $id)->delete();
        if ($findCart) {
            return response()->json(['message' => 'Product removed from cart successfully']);
        } else {
            return response()->json(['message' => 'Product not found in cart'], 404);
        }
    }
}
