<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recibo de Donacion</title>
    <style>
        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: white;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .container {
            width: 80%;
            padding: 20px;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            box-sizing: border-box;
            margin: 50px auto;
            text-align: center;
            flex: 1;
        }

        .header {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px 0;
        }

        .header img {
            max-width: 200px;
            margin-bottom: 20px;
        }

        .header .details {
            text-align: center;
        }

        .header p {
            margin: 0;
            font-size: 14px;
            line-height: 1.6;
        }

        .title {
            background-color: #ececec;
            padding: 10px;
            font-weight: bold;
            margin-bottom: 20px;
            width: 100%;
            box-sizing: border-box;
        }

        .section {
            padding: 10px 0;
            width: 100%;
            display: flex;
            justify-content: space-around;
        }

        .section div {
            padding: 10px;
            border: 1px solid #808080;
            margin-bottom: 10px;
            text-align: left;
            width: calc(50% - 22px);
            box-sizing: border-box;
        }

        .section span {
            font-weight: bold;
        }

        .thank-you {
            padding: 20px 0;
            font-size: 16px;
            font-weight: bold;
        }

        .credit {
            background-color: #ececec;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            position: absolute;
            bottom: 0;
            left: 0;
        }

        .credit::before,
        .credit::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 1px;
            background-color: #808080;
            left: 0;
        }

        .credit::before {
            top: 0;
        }

        .credit::after {
            bottom: 0;
        }

        .credit img {
            max-width: 30px;
            vertical-align: middle;
            margin-right: 5px;
        }

        .credit span {
            vertical-align: middle;
            font-size: 12px;
        }

        .credit a {
            text-decoration: none;
            color: #333;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            @if ($shelter->getMedia('shelterGallery')->isNotEmpty())
            @php
            $logo = $shelter->getFirstMedia('shelterGallery');
            @endphp
            <img src="{{ $logo->getUrl() }}" alt="Logo not found">
            @else
            <img src='img/shelterdefault.png' alt="Logo por defecto">
            @endif
            <div class="details">
                <p>{{ $shelter->name }}<br>
                    Teléfono: {{ $shelter->phone }}<br>
                    Dirección: {{ $shelter->address }}, Col. {{ $shelter->colony }}, C.P. {{ $shelter->postal_code }}, Estado de {{ $shelter->state }} - {{$shelter->city }}
                </p>
            </div>
        </div>
        <div class="title">Recibo de donación</div>
        <div class="section">
            <div>
            <span>Nombre del Donador:</span> {{ $shelterMember->name }} {{ $shelterMember->last_name }}<br>
            <span>Teléfono:</span> {{$shelterMember->phone }}<br>
            <span>Dirección:</span> {{ $shelterMember->address }}, Col. {{ $shelterMember->colony }}, C.P. {{ $shelterMember->postal_code }}, Estado de {{ $shelterMember->state }} - {{ $shelterMember->city }}

            </div>
            <div>
                <span>ID de la Donación:</span> {{ $donation->id }}<br>
                <span>Fecha de la Donación:</span> {{ $donation->donation_date }}<br>
                <span>Tipo de Donación:</span> {{ $donation->type }}<br>
                <span>Monto o Cantidad de la donación:</span> {{ $donation->amount }}<br>
                <span>Observaciones:</span> {{ $donation->observation }}<br>
            </div>
        </div>
        <div class="thank-you">¡Gracias por tu generosa donación y por ayudar a mejorar la vida de nuestras mascotas!</div>
    </div>
    <div class="credit">
        <img src="img/logoRootBlack.png" alt="Logo">
        <span><a href="https://rootheim.com/">Root Heim Company</a></span>
    </div>
</body>

</html>
