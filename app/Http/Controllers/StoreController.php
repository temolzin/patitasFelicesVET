<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\Product;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;


class StoreController extends Controller
{
    public function index(Request $request)
    {
        $query = Store::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            
            $query->whereHas('products', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            })
            ->orWhere('status', 'like', "%{$search}%")
            ->orWhere('payment_method', 'like', "%{$search}%")
            ->orWhereHas('services', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            });
        }

        $stores = $query->with(['products', 'creator', 'services'])->paginate(10);
        $products = Product::all();
        $services = Service::all();

        return view('stores.index', compact('stores', 'products', 'services'));
    }

        public function store(Request $request)
    {
        $products = $request->input('products');
        $services = $request->input('services');
        $productQuantities = $request->input('product_quantities');
        $serviceQuantities = $request->input('service_quantities');

        if (empty($products) || empty($services)) {
            return redirect()->back()->withErrors('Debe seleccionar al menos un producto y un servicio.');
        }

        $store = Store::create([
            'status' => $request->input('status'),
            'payment_method' => $request->input('payment_method', 'efectivo'),
            'created_by' => auth()->user()->id,
        ]);

        $productData = [];
        foreach ($products as $key => $product_id) {
            $quantity = isset($productQuantities[$key]) ? $productQuantities[$key] : 1;
            $productData[$product_id] = ['quantity' => $quantity];
        }
        $store->products()->sync($productData);

        $serviceData = [];
        foreach ($services as $key => $service_id) {
            $quantity = isset($serviceQuantities[$key]) ? $serviceQuantities[$key] : 1;
            $serviceData[$service_id] = ['quantity' => $quantity];
        }
        $store->services()->sync($serviceData);

        return redirect()->route('stores.index')->with('success', 'Venta registrada correctamente.');
    }

    public function show($id)
    {
        $store = Store::with(['products', 'services', 'creator'])->findOrFail($id);
    
        return view('stores.show', compact('store'));
    }

    public function update(Request $request, $id)
    {
        $store = Store::findOrFail($id);

        $products = $request->input('products', []); 
        $quantities = $request->input('quantities', []); 
        $services = $request->input('services', []); 
        $serviceQuantities = $request->input('service_quantities', []); 

        if (empty($products) && empty($services)) {
            return redirect()->back()->withErrors('Debe seleccionar al menos un producto o servicio.');
        }

        $store->status = $request->input('editStoreStatus', $store->status);
        $store->payment_method = $request->input('editStoreMetodPay', $store->payment_method);
        $store->save();

        $productData = [];
        foreach ($products as $key => $product_id) {
            $quantity = isset($quantities[$key]) ? $quantities[$key] : 1;
            $productData[$product_id] = ['quantity' => $quantity];
        }
        $store->products()->sync($productData);

        $serviceData = [];
        foreach ($services as $key => $service_id) {
            $quantity = isset($serviceQuantities[$key]) ? $serviceQuantities[$key] : 1;
            $serviceData[$service_id] = ['quantity' => $quantity];
        }
        $store->services()->sync($serviceData);

        return redirect()->route('stores.index')->with('success', 'Venta actualizada correctamente.');
    }

    public function destroy($id)
    {
        $store = Store::findOrFail($id); 
        $store->delete();  
        return redirect()->route('stores.index')->with('success', 'Venta eliminada correctamente.');
    }

        public function generateReport(Request $request)
    {
        $validated = $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $startDate = $validated['start_date'];
        $endDate = $validated['end_date'];

        $products = DB::table('stores')  
            ->join('store_tables', 'stores.id', '=', 'store_tables.store_id')
            ->join('products', 'store_tables.product_id', '=', 'products.id')
            ->whereBetween('stores.created_at', [$startDate, $endDate])
            ->whereNotNull('store_tables.product_id')
            ->select('products.name as product_name', 'store_tables.quantity', 'products.cost')
            ->get();

        $services = DB::table('stores')  
            ->join('store_tables', 'stores.id', '=', 'store_tables.store_id')
            ->join('services', 'store_tables.service_id', '=', 'services.id')
            ->whereBetween('stores.created_at', [$startDate, $endDate])
            ->whereNotNull('store_tables.service_id')
            ->select('services.name as service_name', 'store_tables.quantity', 'services.cost')
            ->get();

        $totalEarnings = $products->sum(fn($product) => $product->cost * $product->quantity) +
                        $services->sum(fn($service) => $service->cost * $service->quantity);

        $pdf = PDF::loadView('reports.pdf', compact('products', 'services', 'totalEarnings', 'startDate', 'endDate'));
        return $pdf->download('reporte_ventas_' . $startDate . '_a_' . $endDate . '.pdf');
    }
}
