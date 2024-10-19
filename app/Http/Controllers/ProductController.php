<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\User;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('status', 'like', "%{$search}%");
            });
        }

        if ($request->has('category_id') && $request->input('category_id') != '') {
            $query->where('category_id', $request->input('category_id'));
        }

        $categories = Category::all();
        $users = User::all();
        $products = $query->paginate(10);
        return view('products.index', compact('products', 'categories'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'status' => 'required|string|max:100',
            'amount' => 'required|integer|min:1',
            'photo' => 'nullable|image|max:2048',
        ]);

        $product = Product::create([
            'category_id' => $validatedData['category_id'],
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'status' => $validatedData['status'],
            'amount' => $validatedData['amount'],
            'created_by' => auth()->user()->id,
        ]);

        if ($request->hasFile('photo')) {
            $product->addMediaFromRequest('photo')->toMediaCollection('productGallery');
        }

        return redirect()->route('products.index')->with('success', 'Producto registrado correctamente.');
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        if ($product) {
            $product->category_id = $request->input('category_id');
            $product->name = $request->input('name');
            $product->description = $request->input('description');
            $product->status = $request->input('status');
            $product->amount = $request->input('amount');

            $product->save();

            return redirect()->route('products.index')->with('success', 'Producto actualizado correctamente.'); // Cambié Material a Producto
        }

        return redirect()->back()->with('error', 'Producto no encontrado.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Producto eliminado correctamente.'); // Cambié Material a Producto
    }

    public function updatePhoto(Request $request, $id)
    {
        $request->validate([
            'photo' => 'nullable|image|max:2048', 
        ]);

        $product = Product::find($id);
        if ($product) {
            if ($request->hasFile('photo')) {
                $product->clearMediaCollection('productGallery');
                $product->addMediaFromRequest('photo')->toMediaCollection('productGallery');
            }
            return redirect()->route('products.index')->with('success', 'Foto del producto actualizada correctamente.');
        }

        return redirect()->back()->with('error', 'Producto no encontrado.');
    }
}
