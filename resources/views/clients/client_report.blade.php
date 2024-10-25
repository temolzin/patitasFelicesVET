<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Profile</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #ffffff;
            color: #37474f;
            margin: 8;
            padding: 8;
        }

        .header {
            background-color: #00796b;
            color: #ffffff;
            text-align: center;
            padding: 20px;
            font-size: 2.5em;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .image-container {
            text-align: center;
        }

        .image-container img {
            height: 140px;
            width: 140px;
            border-radius: 50%;
            border: 4px solid #00796b;
        }

        .section h3 {
            margin-bottom: 10px;
            font-size: 1.8em;
            border-bottom: 3px solid #00796b;
            padding-bottom: 5px;
            color: #00796b;
        }

        .section p {
            margin: 9px 0;
            font-size: 1.1em;
            text-align: justify;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">{{ $client->name }} {{ $client->last_name }}</div>
        <div class="main-content">
            <div class="details-container">
                <div class="section">
                    <h3>Datos del Cliente</h3>
                    <p><strong>Nombre:</strong> {{ $client->name }}</p>
                    <p><strong>Apellido:</strong> {{ $client->last_name }}</p>
                    <p><strong>Teléfono:</strong> {{ $client->phone }}</p>
                    <p><strong>Email:</strong> {{ $client->email }}</p>
                    <p><strong>Número de Mascotas:</strong> {{ $client->number_pets }}</p>
                </div>
                <div class="section">
                    <h3>Dirección</h3>
                    <p><strong>Estado:</strong> {{ $client->state }}</p>
                    <p><strong>Ciudad:</strong> {{ $client->city }}</p>
                    <p><strong>Colonia:</strong> {{ $client->colony }}</p>
                    <p><strong>Dirección:</strong> {{ $client->address }}</p>
                    <p><strong>Código Postal:</strong> {{ $client->postal_code }}</p>
                </div>
                <div class="section">
                    <h3>Mascotas Asignadas</h3>
                    @if($client->pets && $client->pets->isNotEmpty())
                        <ul>
                            @foreach($client->pets as $pet)
                                <li>{{ $pet->name }}</li> 
                            @endforeach
                        </ul>
                    @else
                        <p>No hay mascotas asignadas a este cliente.</p>
                    @endif
                </div>                
            </div>
        </div>
    </div>
</body>

</html>
