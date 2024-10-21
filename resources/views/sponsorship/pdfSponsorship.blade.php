<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recibo de Apadrinamiento</title>
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
            @if ($vet->getMedia('logos')->isNotEmpty())
            @php
            $logo = $vet->getFirstMedia('logos');
            @endphp
            <img src="{{ $logo->getUrl() }}" alt="Logo not found">
            @else
            <img src='img/avatardefault.png' alt="Logo por defecto">
            @endif
            <div class="details">
                <p>{{ $vet->name }}<br>
                    Teléfono: {{ $vet->phone }}<br>
                    Dirección: {{ $vet->address }}, Col. {{ $vet->colony }}, C.P. {{ $vet->postal_code }}, Estado de {{ $vet->state }} - {{$vet->city }}
                </p>
            </div>
        </div>
        <div class="title">Recibo de pago</div>
        <div class="section">
            <div>
                <span>Nombre del Apadrinador:</span> {{ $sponsorship->vetMember->name }} {{ $sponsorship->vetMember->last_name }}<br>
                <span>Teléfono:</span> {{$vetMember->phone}}<br>
                <span>Dirección:</span> {{ $sponsorship->vetMember->address }}, Col. {{ $sponsorship->vetMember->colony }}, C.P. {{ $sponsorship->vetMember->postal_code }}, Estado de {{ $sponsorship->vetMember->state }} - {{ $sponsorship->vetMember->city }}
            </div>
            <div>
                <span>ID del Pago:</span> {{ $sponsorship->id }}<br>
                <span>Nombre de la Mascota:</span> {{ $sponsorship->animal->name }}<br>
                <span>Fecha de Inicio:</span> {{ $sponsorship->start_date }}<br>
                <span>Fecha de Finalización:</span> {{ $sponsorship->finish_date }}<br>
                <span>Fecha de Pago:</span> {{ $sponsorship->payment_date }}<br>
                <span>Monto del Apadrinamiento:</span> {{ $sponsorship->amount }}
            </div>
        </div>
        <div class="thank-you">¡Gracias por apadrinar una mascota y contribuir a su bienestar!</div>
    </div>
    <div class="credit">
        <img src="img/logoRootBlack.png" alt="Logo">
        <span><a href="https://rootheim.com/">Root Heim Company</a></span>
    </div>
</body>

</html>
