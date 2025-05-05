<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
 {
 $products = Product::latest()->paginate(10);
 return view('products.index', compact('products'));
 }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    $request->validate([
    'name' => 'required',
    'code' => 'required|unique:products',
    'price' => 'required',
    'stock' => 'required',
    ]);
    Product::create([
    'name' => $request->name,
    'code' => $request->code,
    'price' => $request->price,
    'stock' => $request->stock,
    ]);
    return redirect()->route('product.index')
    ->with('success','Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(product $product)
    {
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
 {
 $request->validate([
 'name' => 'required',
 'price' => 'required',
 'stock' => 'required',
 ]);
 $product->update([
 'name' => $request->name,
 'price' => $request->price,
 'stock' => $request->stock,
 ]);
 return redirect()->route('product.index')
 ->with('success','Product updated successfully');
 }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
 {
 $product->delete();
 return redirect()->route('product.index')
 ->with('success','Product deleted successfully');
 }
}
