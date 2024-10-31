<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Animal;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $animals = Animal::all();
        return view('products.index', compact('products','animals'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function buy(Request $request, Product $product)
{
    $request->validate([
        'animal_id' => 'required|exists:animals,id', 
        'quantity' => 'required|integer|min:1',
    ]);
    $product->stock -= $request->quantity;
    $product->save(); 

    return redirect()->route('products.index')->with('success', 'Compra realizada exitosamente.');
}


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category' => 'nullable|string',
            'notes' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        Product::create($request->all());

        return redirect()->route('products.index')->with('success', 'Producto creado exitosamente.');
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category' => 'nullable|string',
            'notes' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $product->update($request->all());

        return redirect()->route('products.index')->with('success', 'Producto actualizado exitosamente.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Producto eliminado exitosamente.');
    }
}
