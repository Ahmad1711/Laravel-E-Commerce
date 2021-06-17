<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class FrontendController extends Controller
{

    public function index()
    {
        $products = Product::paginate(3);
        return view('index', ['products' => $products]);
    }

    public function single($id)
    {
        $product = Product::find($id);
        return view('show', ['product' => $product]);
    }
    
}
