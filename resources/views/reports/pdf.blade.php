<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Ventas</title>
    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
        body {
            background-image: url('img/backgroundReport.jpg');
            font-family: Arial, sans-serif;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            min-height: 70vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .content {
            width: 80%;
            margin: 30px auto;
            padding: 20px;
            background: rgba(255, 255, 255, 0.9);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        .table-container {
            width: 100%;
            margin: 0 auto;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .table th, .table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        .table th {
            background-color: #00796b;
            color: white;
            font-weight: bold;
        }
        .table td {
            font-size: 12px;
        }
        .table td p {
            margin: 0;
            padding: 5px 0;
            font-size: 12px;
            text-align: left;
        }
        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .header {
            text-align: left;
        }
        .header h1 {
            font-size: 28px;
            margin: 0;
        }
        .logo {
            width: 150px;
            height: auto;
            margin-bottom: 30px;
            margin-top: 30px;
            float: right;
            margin-left: 10%;
            margin-right: 40px;
        }
        .logo img {
            width: 100%;
            height: auto;
            max-width: 150px;
            border-radius: 8px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
        }
        .info_Eabajo {
            text-align: center;
            margin-top: 20px;
            padding: 10px;
            position: absolute;
            bottom: 5px;
            left: 20px;
            right: 20px;
        }
        .text_infoE {
            text-align: center;
            font-size: 12pt;
            font-family: 'Montserrat', sans-serif;
            color: black;
            text-decoration: none;
            display: inline-block;
        }
    </style>
</head>
<body>
    <div class="content">
        <div class="header-container">
            <div class="logo">
                @if ($authUser->vet->hasMedia('vetGallery'))
                    <img src="{{ $authUser->vet->getFirstMediaUrl('vetGallery') }}" alt="Logo {{ $authUser->vet->name }}" class="img-fluid" style="max-width: 150px;">
                @else
                    <img src='img/logo.png' alt="Logo por defecto" class="img-fluid" style="max-width: 150px;">
                @endif
            </div>
            <div class="header">
                <h1>Reporte de Ventas</h1>
                <p><strong>Fecha Inicial:</strong> {{ $startDate ?? 'No especificada' }}</p>
                <p><strong>Fecha Final:</strong> {{ $endDate ?? 'No especificada' }}</p>
                <p><strong>Veterinaria:</strong> {{ $authUser->vet->name ?? 'No especificada' }}</p>
            </div>
        </div>

        <h4>Productos Vendidos</h4>
        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th>Cliente</th>
                        <th>Nombre</th>
                        <th>Cantidad</th>
                        <th>Precio Unitario</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td>{{ $product->client_name }}</td>
                            <td>{{ $product->product_name }}</td>
                            <td>{{ $product->quantity }}</td>
                            <td>${{ number_format($product->cost, 2) }}</td>
                            <td>${{ number_format($product->cost * $product->quantity, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <h4>Servicios Vendidos</h4>
        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th>Cliente</th>
                        <th>Nombre</th>
                        <th>Cantidad</th>
                        <th>Precio Unitario</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($services as $service)
                        <tr>
                            <td>{{ $service->client_name }}</td>
                            <td>{{ $service->service_name }}</td>
                            <td>{{ $service->quantity }}</td>
                            <td>${{ number_format($service->cost, 2) }}</td>
                            <td>${{ number_format($service->cost * $service->quantity, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="total">
            <strong>Total de Ganancias: ${{ number_format($totalEarnings, 2) }}</strong>
        </div>
    </div>
    <div class="info_Eabajo">
        <a class="text_infoE" href="https://patitasfelicesvet.rootheim.com/"><strong>PatitasFelices</strong></a>
        <a class="text_infoE" href="https://rootheim.com/">powered by<strong> Root Heim Company </strong></a><img src="img/logoRootBlack.png" width="15px" height="15px">
    </div>
</body>
</html>
