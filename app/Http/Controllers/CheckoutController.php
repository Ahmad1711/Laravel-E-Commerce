<?php


namespace App\Http\Controllers;

use Stripe\Stripe;         /* ctrl + shift + p -> Index workspace */
use Stripe\Charge;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{

    public function index()
    {
        if (Cart::content()->count() == 0) {
            session()->flash('info', 'Cart is Empty');
            return redirect()->route('cart');
        } else {
            return view('checkout');
        }
    }

    public function pay()
    {
        Stripe::setApiKey("sk_test_51IsXe4BRcFoECpzqiBrXK8AVc1XPQ1k240MWIHYXgDNedYGelWcPKcE6Dss2gp3OPR7706r3797vq9S0npmFgo2M00XCWexNR4");
        $token = request()->stripeToken;
        Charge::create([
            'amount' => Cart::total() * 100,
            'currency' => 'usd',
            'description' => 'Online Books',
            'source' => request()->stripeToken
        ]);
        session()->flash('success', 'Purchase Successfully');
        Cart::destroy();
        Mail::to(request()->stripeEmail)->send(new \App\Mail\PurchaseSuccessful);
        return redirect()->route('index');
    }
}
