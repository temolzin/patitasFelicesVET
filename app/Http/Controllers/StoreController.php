<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\Product;
use App\Models\Service;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

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
            ->orWhere('payment_method', 'like', "%{$search}%")
            ->orWhereHas('services', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            });
        }

        $stores = $query->with(['client', 'products', 'services'])->get();

        foreach ($stores as $store) {
            $store->total = $store->products->sum(function ($product) {
                return $product->pivot->quantity * $product->cost;
            }) + $store->services->sum(function ($service) {
                return $service->pivot->quantity * $service->cost;
            });
        }
        
        $products = Product::all();
        $services = Service::all();
        $clients = Client::all();
        
        return view('stores.index', compact('clients','stores', 'products', 'services'));
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'payment_method' => 'required|in:efectivo,tarjeta',
            'products' => 'nullable|array',
            'products.*' => 'exists:products,id',
            'product_quantities' => 'nullable|array',
            'services' => 'nullable|array',
            'services.*' => 'exists:services,id',
            'service_quantities' => 'nullable|array',
        ]);

        $store = new Store();
        $store->client_id = $request->client_id;
        $store->created_by = auth()->id();
        $store->payment_method = $request->payment_method;
        $store->save();

        $productData = [];
        if (!empty($validated['products'])) {
            foreach ($validated['products'] as $key => $product_id) {
                $quantity = $validated['product_quantities'][$key] ?? 1;
                $productData[$product_id] = ['quantity' => $quantity];
            }
            $store->products()->sync($productData);
        }
        
        $serviceData = [];
        if (!empty($validated['services'])) 
        {
            foreach ($validated['services'] as $key => $service_id)
            {
                $quantity = $validated['service_quantities'][$key] ?? 1;
                $serviceData[$service_id] = ['quantity' => $quantity];
            }
            $store->services()->sync($serviceData);
        }

        return redirect()->route('stores.index')->with('success', 'Venta registrada correctamente');
    }

    public function show($id)
    {
        $store = Store::with(['client', 'products', 'services'])->findOrFail($id);
        
        $store->total = $store->products->sum(function ($product)
        {
            return $product->pivot->quantity * $product->cost;
        }) + $store->services->sum(function ($service)
        {
            return $service->pivot->quantity * $service->cost;
        });

        return view('stores.show', compact('store'));
    }

    public function update(Request $request, $id)
    {
        $store = Store::findOrFail($id);

        $clientId = $request->input('client_id');
        $products = $request->input('products', []);
        $productQuantities = $request->input('quantities', []);
        $services = $request->input('services', []);
        $serviceQuantities = $request->input('service_quantities', []);
        
        if (empty($products) && empty($services))
        {
            return redirect()->back()->withErrors('Debe seleccionar al menos un producto o servicio.');
        }
        
        $store->client_id = $clientId;
        $store->payment_method = $request->input('payment_method', 'efectivo');
        $store->save();

        $productData = [];
        foreach ($products as $key => $product_id)
        {
            $quantity = $productQuantities[$key] ?? 1;
            $product = Product::findOrFail($product_id);
            $productData[$product_id] = [
                'quantity' => $quantity,
            ];
        }
        
        $store->products()->sync($productData);

        $serviceData = [];
        foreach ($services as $key => $service_id)
        {
            $quantity = $serviceQuantities[$key] ?? 1;
            $service = Service::findOrFail($service_id);
            $serviceData[$service_id] = [
                'quantity' => $quantity,
            ];
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
            ->join('clients', 'stores.client_id', '=', 'clients.id')
            ->whereBetween('stores.created_at', [$startDate, $endDate])
            ->whereNotNull('store_tables.product_id')
            ->select('products.name as product_name', 'store_tables.quantity', 'products.cost','clients.name as client_name')
            ->get();
    
        $services = DB::table('stores')
            ->join('store_tables', 'stores.id', '=', 'store_tables.store_id')
            ->join('services', 'store_tables.service_id', '=', 'services.id')
            ->join('clients', 'stores.client_id', '=', 'clients.id')
            ->whereBetween('stores.created_at', [$startDate, $endDate])
            ->whereNotNull('store_tables.service_id')
            ->select('services.name as service_name', 'store_tables.quantity', 'services.cost','clients.name as client_name')
            ->get();
    
        $totalEarnings = $products->sum(fn($product) => $product->cost * $product->quantity) +
                         $services->sum(fn($service) => $service->cost * $service->quantity);
    
        $authUser = Auth::user();
    
        $pdf = PDF::loadView('reports.pdf', compact('products', 'services', 'totalEarnings', 'startDate', 'endDate', 'authUser'));
    
        return $pdf->download('reporte_ventas_' . $startDate . '_a_' . $endDate . '.pdf');
    }

    public function generateAnnualReport(Request $request)
    {
        $year = $request->input('year', now()->year);
        $months = [];
        $authUser = auth()->user();

        for ($i = 1; $i <= 12; $i++) {
            $monthStores = Store::whereYear('created_at', $year)
                                ->whereMonth('created_at', $i)
                                ->with(['products', 'services'])
                                ->get();
                                
                                
            $monthTotal = $monthStores->sum(function($store)
            {
                $productsTotal = $store->products->sum(function($product)
                {
                    return $product->pivot->quantity * $product->cost;
                });
                
                $servicesTotal = $store->services->sum(function($service)
                {
                    return $service->pivot->quantity * $service->cost;
                });
                
                return $productsTotal + $servicesTotal;
            });
            
            $servicesSold = [];
            foreach ($monthStores as $store)
            {
                foreach ($store->services as $service)
                {
                    if (!isset($servicesSold[$service->name]))
                    {
                        $servicesSold[$service->name] = ['quantity' => 0, 'total' => 0];
                    }
                    
                    $servicesSold[$service->name]['quantity'] += $service->pivot->quantity;
                    $servicesSold[$service->name]['total'] += $service->pivot->quantity * $service->cost;
                }
            }
            
            $productsSold = [];
            foreach ($monthStores as $store)
            {
                foreach ($store->products as $product)
                {
                    if (!isset($productsSold[$product->name]))
                    {
                        $productsSold[$product->name] = ['quantity' => 0, 'total' => 0];
                    }
                    $productsSold[$product->name]['quantity'] += $product->pivot->quantity;
                    $productsSold[$product->name]['total'] += $product->pivot->quantity * $product->cost;
                }
            }
            
            $months[] = [
                'month' => \Carbon\Carbon::create()->month($i)->format('F'),
                'total' => $monthTotal,
                'services' => $servicesSold,
                'products' => $productsSold
            ];
        }
        
        Log::info('Reporte Anual: ', ['months' => $months]);
        $pdf = PDF::loadView('reports.reportsAnnual', compact('year', 'months', 'authUser'));
        return $pdf->download('reporte_anual_ventas.pdf');
    }
}
