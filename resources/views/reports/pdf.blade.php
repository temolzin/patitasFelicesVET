<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Ventas</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 30px;
            color: #333;
        }
        h2 {
            text-align: center;
            color: #00796b;
        }
        table {
            width: 100%;
            margin: 20px 0;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #00796b;
            color: white;
        }
        .total {
            text-align: right;
            font-size: 1.2em;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h2>Reporte de Ventas desde {{ $startDate }} hasta {{ $endDate }}</h2>

    <h4>Productos Vendidos</h4>
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->product_name }}</td>  
                    <td>{{ $product->quantity }}</td>
                    <td>${{ number_format($product->cost, 2) }}</td>
                    <td>${{ number_format($product->cost * $product->quantity, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h4>Servicios Vendidos</h4>
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($services as $service)
                <tr>
                    <td>{{ $service->service_name }}</td> 
                    <td>{{ $service->quantity }}</td>
                    <td>${{ number_format($service->cost, 2) }}</td>
                    <td>${{ number_format($service->cost * $service->quantity, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total">
        <strong>Total de Ganancias: ${{ number_format($totalEarnings, 2) }}</strong>
    </div>
</body>
</html>
