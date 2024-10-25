<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet Profile</title>
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
            height: 140;
            width: 140;
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
        .section-without-vaccines h3,
        .section-without-services h3 {
            margin-bottom: 10px;
            font-size: 1.8em;
            border-bottom: 3px solid #00796b;
            padding-bottom: 5px;
            color: #00796b;
        }
        .section-without-vaccines p,
        .section-without-services p {
            margin: 9px 0;
            font-size: 1.1em;
            text-align: justify;
        }
        .section-with-vaccines h3,
        .section-with-services h3 {
            margin-bottom: 10px;
            font-size: 1.8em;
            border-bottom: 3px solid #00796b;
            padding-bottom: 5px;
            color: #00796b;
        }
        .section-with-vaccines p,
        .section-with-services p {
            margin: 10px 0;
            font-size: 1.1em;
            text-align: justify;
        }
        .page-break {
            page-break-before: always; /* Asegura que esta sección comience en una nueva página */
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">{{ $animal->name }}</div>
        <div class="main-content">
            <div class="image-container">
                @if ($animal->hasMedia('animalGallery'))
                    <img src="{{ $animal->getFirstMediaUrl('animalGallery') }}" alt="Photo of {{ $animal->name }}">
                @else
                    <img src='img/animaldefault.png' alt="Default Photo">
                @endif
            </div>
            <div class="details-container">
                <div class="section">
                    <h3>Datos de la Mascota</h3>
                    <p><strong>Raza:</strong> {{ $animal->breed }}</p>
                    <p><strong>Sexo:</strong> {{ $animal->sex }}</p>
                    <p><strong>Edad:</strong> {{ $animal->age }}</p>
                    <p><strong>Peso:</strong> {{ $animal->weight }} Kilos</p>
                    <p><strong>Color:</strong> {{ $animal->color }}</p>
                    <p><strong>Esterilizado:</strong> {{ $animal->is_sterilized == 1 ? 'Sí' : 'No' }}</p>
                </div>
                <div class="section">
                    <h3>Informacion</h3>
                    <p><strong>Fecha de ingreso:</strong> {{ $animal->entry_date }}</p>
                    <p><strong>Origen:</strong> {{ $animal->origin }}</p>
                    <p><strong>Comportamiento:</strong> {{ $animal->behavior }}</p>
                </div>
                <div class="section">
                    <h3>Historia</h3>
                    <p>{{ $animal->history }}</p>
                </div>
                <div class="page-break"></div>
                @if ($animal->vaccinatedAnimals->isEmpty())
                    <div class="section-without-vaccines">
                        <h3>Vacunas</h3>
                        <p>No hay vacunas registradas.</p>
                    </div>
                @else
                    <div class="section-with-vaccines">
                        <h3>Vacunas</h3>
                            @foreach ($animal->vaccinatedAnimals as $vaccinatedAnimal)
                                <p><strong>Fecha de aplicación: </strong> {{ $vaccinatedAnimal->application_date }}</p>
                                <p><strong>Vacuna aplicada: </strong> {{ $vaccinatedAnimal->vaccines->name }}</p>
                            @endforeach
                    </div>
                @endif

                @if ($animal->assignedServices->isEmpty())
                    <div class="section-without-services">
                        <h3>Servicios</h3>
                        <p>No hay servicios registrados.</p>
                    </div>
                @else
                    <div class="section-with-services">
                        <h3>Servicios</h3>
                        @foreach ($animal->assignedServices as $assignService)
                            <p><strong>Nombre del servicio:</strong> {{ $assignService->service->name }}</p>
                            <p><strong>Fecha del servicio:</strong> {{ $assignService->service_date }}</p>
                            <p><strong>Costo:</strong> {{ $assignService->service->cost }}</p>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</body>
</html>
