<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate(8);
        return view('products.index', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'image' => 'required',
            'price' => 'required',
            'desc' => 'required'
        ]);
        //upload image file to uploads/products
        $image = $request->image;
        $image_new = time() . $image->getClientOriginalName();
        $image->move('uploads/products', $image_new);

        //store post data in database
        $product = new Product;
        $product->name = $request->name;
        $product->image = 'uploads/products/' . $image_new;
        $product->price = $request->price;
        $product->desc = $request->desc;
        $product->save();
        session()->flash('success', 'Product Was Created Successfully');
        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        return view('products.edit', ['product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'price' => 'required',
            'desc' => 'required'
        ]);
        $product = Product::find($id);
        if ($request->hasFile('image')) {
            $image = $request->image;
            $image_new = time() . $image->getClientOriginalName();
            $image->move('uploads/products', $image_new);
            $product->image = 'uploads/products/' . $image_new;
        }
        $product->name = $request->name;
        $product->price = $request->price;
        $product->desc = $request->desc;
        $product->save();
        session()->flash('success', 'Product Was Updated Successfully');
        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        session()->flash('success', 'Product Was Deleted Successfully');
        return redirect()->route('products.index');
    }
}
