<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Product;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class InventoryController extends Controller
{
    public function index(Request $request)
    {
        $query = Inventory::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->whereHas('products', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            })->orWhere('status', 'like', "%{$search}%");
        }

        $inventories = $query->with(['products', 'creator'])->get();
        $products = Product::all();

        return view('inventories.index', compact('inventories', 'products'));
    }

    public function store(Request $request)
    {
        $products = $request->input('products');
        $quantities = $request->input('quantities');

        if (empty($products) || empty($quantities))
        {
            return redirect()->back()->withErrors('Debe seleccionar al menos un producto y su cantidad.'); // Cambié materiales a productos
        }

        $inventory = Inventory::create([
            'status' => $request->input('status'),
            'created_by' => auth()->user()->id,
        ]);

        foreach ($products as $key => $product_id)
        { 
            $inventory->products()->attach($product_id, ['quantity' => $quantities[$key]]);
        }

        return redirect()->route('inventories.index')->with('success', 'Inventario registrado correctamente.');
    }

    public function show($id)
    {
        $inventory = Inventory::with(['products', 'creator'])->findOrFail($id); 
        return view('inventories.show', compact('inventory'));
    }

    public function update(Request $request, $id)
    {
        $inventory = Inventory::findOrFail($id);

        $products = $request->input('products');
        $quantities = $request->input('quantities');

        if (empty($products) || empty($quantities))
        {
            return redirect()->back()->withErrors('Debe seleccionar al menos un producto y su cantidad.'); // Cambié materiales a productos
        }

        $inventory->status = $request->input('status');
        $inventory->save();

        $inventory->products()->detach();

        foreach ($products as $key => $product_id)
        {
            $inventory->products()->attach($product_id, ['quantity' => $quantities[$key]]); // Cambié materials a products
        }

        return redirect()->route('inventories.index')->with('success', 'Inventario actualizado correctamente.');
    }

    public function destroy($id)
    {
        $inventory = Inventory::findOrFail($id);
        $inventory->delete();

        return redirect()->route('inventories.index')->with('success', 'Inventario eliminado correctamente.');
    }

    public function inventoryReport(Request $request)
    {
        $status = $request->input('inventoryStatus');
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');
        $authUser = auth()->user();

        $inventories = Inventory::where('status', $status)
            ->whereBetween('created_at', [$startDate, $endDate])
            ->with(['products', 'creator'])
            ->get();

        $totalInventories = $inventories->count();

        $pdf = PDF::loadView('reports.inventoryReport', compact('inventories', 'startDate', 'endDate', 'authUser', 'totalInventories'))
            ->setPaper('A4', 'portrait');

        return $pdf->stream('reporte_inventario.pdf');
    }
}
