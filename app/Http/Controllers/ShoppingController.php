<?php

namespace App\Http\Controllers;

use App\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class ShoppingController extends Controller
{
    public function cart()
    {
        // Cart::destroy();
        return view('cart');
    }

    public function add_to_cart(Request $request)
    {

        $product = Product::find($request->prid);
        $cartItem = Cart::add([
            'id' => $product->id,
            'name' => $product->name,
            'qty' => $request->qty,
            'price' => $product->price
        ]);
        Cart::associate($cartItem->rowId, 'App\Product');
        session()->flash('success', 'New Product added to the Cart');
        return redirect()->route('cart');
    }

    public function delete_from_cart($id)
    {
        Cart::remove($id);
        session()->flash('success', 'Product deleted from the Cart');
        return redirect()->back();
    }

    public function inc($id, $qty)
    {
        Cart::update($id, $qty + 1);
        return redirect()->back();
    }

    public function dec($id, $qty)
    {
        Cart::update($id, $qty - 1);
        return redirect()->back();
    }

    public function quickly_add($id)
    {
        $product = Product::find($id);
        $cartItem = Cart::add([
            'id' => $product->id,
            'name' => $product->name,
            'qty' => 1,
            'price' => $product->price
        ]);
        Cart::associate($cartItem->rowId, 'App\Product');
        session()->flash('success', 'New Product added to the Cart');
        return redirect()->route('cart');
    }
    
}
