<!DOCTYPE html>  
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte Anual de Ventas</title>
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

        .logo-container {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo-container img {
            max-width: 250px;
            height: auto;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            border: 3px solid #fff;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            font-size: 28px;
            margin: 0;
            padding-bottom: 10px;
        }

        .header p {
            font-size: 16px;
            margin: 5px 0;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .table th, .table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
            font-size: 14px;
        }
        .table th {
            background-color: #202020;
            color: #fff;
            font-weight: bold;
            font-size: 14px;
        }
        .table td {
            font-size: 14px;
        }

        .total-mes {
            background-color: #D4A08C;
        }

        .footer {
            position: absolute;
            bottom: 10px;
            width: 100%;
            text-align: center;
            padding: 10px 0;
        }

        .footer a {
            font-size: 12pt;
            font-family: 'Montserrat', sans-serif;
            color: black;
            text-decoration: none;
            margin: 0 10px;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        .total-anual, .total-mes-right {
            font-weight: bold;
            font-size: 16px;
            margin-top: 20px;
            text-align: right;
        }

        .month-separator {
            border-top: 2px solid #000;
            margin-top: 30px;
            padding-top: 10px;
        }
    </style>
</head>
<body>
    <div class="content">
        <div class="logo-container">
            @if ($authUser->vet->hasMedia('vetGallery'))
                <img src="{{ $authUser->vet->getFirstMediaUrl('vetGallery') }}" alt="Logo de Patitas Felices">
            @else
                <img src='img/logo.png' alt="Logo de Patitas Felices">
            @endif
        </div>

        <div class="header">
            <h1>Reporte Anual de Ventas</h1>
            <p>Año: {{ $year }}</p>
            <p>Generado por: {{ $authUser->name }}</p>
        </div>

        <h3>Mes:</h3>
        @php
            $totalAnual = 0;
        @endphp
        @foreach ($months as $month)
            <h4>{{ $month['month'] }}</h4>
            <table class="table">
                <thead>
                    <tr>
                        <th>Servicio</th>
                        <th>Cantidad</th>
                        <th>Total por Servicio</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($month['services'] as $serviceName => $service)
                        <tr>
                            <td>{{ $serviceName }}</td>
                            <td>{{ $service['quantity'] }}</td>
                            <td>${{ number_format($service['total'], 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <table class="table">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad </th>
                        <th>Total por Producto</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($month['products'] as $productName => $product)
                        <tr>
                            <td>{{ $productName }}</td>
                            <td>{{ $product['quantity'] }}</td>
                            <td>${{ number_format($product['total'], 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="total-mes-right">
                <p>Total del Mes: <strong>${{ number_format($month['total'], 2) }}</strong></p>
            </div>

            @php
                $totalAnual += $month['total'];
            @endphp

            <div class="month-separator"></div>

        @endforeach

        <div class="total-anual">
            <p>Total Anual: <strong>${{ number_format($totalAnual, 2) }}</strong></p>
        </div>
    </div>

    <div class="footer">
        <a class="text_infoE" href="https://patitasfelicesvet.rootheim.com//"><strong>PatitasFelices</strong></a>
        <a class="text_infoE" href="https://rootheim.com/">powered by<strong> Root Heim Company </strong></a><img src="img/logoRootBlack.png" width="15px" height="15px">
    </div>
</body>
</html>
