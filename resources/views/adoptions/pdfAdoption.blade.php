<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contrato de Adopción</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            width: 90%;
            margin: auto;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header img {
            width: 90px;
            height: 90px;
            border-radius: 50%;
        }

        .header h3 {
            margin: 10px 0;
            border-bottom: 2px solid #000;
            display: inline-block;
            padding-bottom: 10px;
        }

        .signature {
            text-align: center;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            border: 1px cadetblue;

        }

        img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
        }

        h4 {
            margin: 15px 0;
            text-align: right;
        }

        p {
            margin: 10px 0;
            text-align: justify;
        }

        .observations {
            background-color: #c5e3e7;
            padding: 10px;
            margin-top: 20px;
            text-align: justify;
        }

        .image {
            text-align: right;
            vertical-align: middle;
        }

        .footer h6 {
            position: absolute;
            bottom: 0;
            width: 90%;
            padding: 10px;
            background-color: #c5e3e7;
            text-align: center;
        }

        .footer img {
            width: 30px;
            height: 20px;
            vertical-align: middle;
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
                <img src='img/avatardefault.png'>
            @endif

            <h3>CONTRATO DE ADOPCIÓN RESPONSABLE DE MASCOTA</h3>
        </div>

        <div class="main-content">
            <div class="details-container">
                <h4>Fecha: {{ $adoption->adoption_date }}</h4>

                <h3>Datos del adoptado:</h3>
                <table>
                    <tr>
                        <td>Nombre: {{ $adoption->animal->name }}</td>
                        <td>Especie: {{ $adoption->animal->specie->name }}</td>
                        <td rowspan="4" class="image">
                            @if ($adoption->animal->hasMedia('animalGallery'))
                                <img src="{{ $adoption->animal->getFirstMediaUrl('animalGallery') }}"
                                    alt="Foto de {{ $adoption->animal->name }}">
                            @else
                                <img src='img/animaldefault.png' alt="Foto predeterminada">
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Sexo: {{ $adoption->animal->sex }}</td>
                        <td>Edad: {{ $adoption->animal->age }}</td>
                    </tr>
                    <tr>
                        <td>Raza: {{ $adoption->animal->breed }}</td>
                        <td>Color: {{ $adoption->animal->color }}</td>
                    </tr>
                    <tr>
                        <td colspan="2">Esterilizado: {{ $adoption->animal->is_sterilized == 1 ? 'Sí' : 'No' }}</td>
                    </tr>
                </table>

                <h3>Datos del adoptante:</h3>
                <table>
                    <tr>
                        <td>Nombre: {{ $adoption->shelterMember->name }} {{ $adoption->shelterMember->last_name }}
                        </td>
                        <td>Teléfono: {{ $adoption->shelterMember->phone }}</td>
                        <td rowspan="4" class="image">
                            @if ($adoption->shelterMember->hasMedia('photos'))
                                <img src="{{ $adoption->shelterMember->getFirstMediaUrl('photos') }}"
                                    alt="Foto de {{ $adoption->shelterMember->name }}">
                            @else
                                <img src='img/avatardefault.png' alt="Foto predeterminada">
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">Email: {{ $adoption->shelterMember->email }}</td>
                    </tr>
                    <tr>
                        <td colspan="2">Dirección: {{ $adoption->shelterMember->address }} , Col.
                            {{ $adoption->shelterMember->colony }}, C.P. {{ $adoption->shelterMember->postal_code }},
                            Estado de {{ $adoption->shelterMember->state }} - {{ $adoption->shelterMember->city }}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"></td>
                    </tr>
                </table>

                <h5>Observaciones: </h5>
                <div class="observations">
                    {{ $adoption->observation }}
                </div><br>

                <p>El adoptante cuyos datos figuran en este documento acepta las siguientes cláusulas del presente
                    contrato de adopción:</p>
                <p>1. Ofrecer los cuidados que necesite al animal, alimentarlo, sacarlo de paseo, llevarlo a hacer sus
                    necesidades fuera del lugar de descanso y vivienda habitual, darle cobijo y tratarlo con respeto y
                    cariño.</p>
                <p>2. Llevar un control sanitario, visitando a su veterinario para vacunaciones, desparasitaciones y por
                    cualquier enfermedad que se le origine.</p>
                <p>3. No dejar libremente a la mascota por la vía pública, parque o campo, sin supervisión del
                    propietario y siempre cogido con correa.</p>
                <p>4. Si es la primera vez que está al cargo de un animal, procurará informarse lo mejor posible de los
                    principios básicos a tener en cuenta para ofrecerle una vida digna.</p>
                <p>5. Nunca debe desatenderlo, hacerlo pelear o trabajar, ni criar con él.</p>
                <p>6. No debe abandonarlo, regalarlo, cederlo, venderlo, o sacrificarlo sin justificación veterinaria
                    por enfermedad muy grave que lo obligue y sin previa autorización escrita del representante de la
                    adopción.</p>
                <p>7. No realizará amputaciones de ningún tipo por motivos estéticos. Nunca debe pegarle, humillarle ni
                    utilizarle con fines económicos.</p>
                <p>8. Es obligación del adoptante informar al representante de la adopción de cualquier cambio de
                    domicilio que se produzca, de teléfono, o e-mail, defunción o pérdida del animal.</p>
                <p>9. El adoptante se hace cargo civilmente de su animal según la ley 21.020 Ley de tenencia responsable
                    de mascotas.</p>
                <p>10. El adoptante permitirá estar al tanto de la condición del animal de mutuo acuerdo con el dueño
                    anterior, con el fin de observar el estado de adaptación, condiciones generales del animal,
                    reservándose el derecho a retirar la custodia del mismo si considera que no está adecuadamente
                    atendido o no se cumpliese el actual contrato en alguno de sus puntos.</p>
                <p>11. En caso de que el adoptante no se encuentre capacitado algún día para continuar encargándose del
                    animal adoptado, procederá a comunicarlo de inmediato, quien iniciará de nuevo los trámites para la
                    búsqueda de un nuevo adoptante. En esta situación, el adoptante cuidará del animal mientras se le
                    encuentra nuevo dueño, en caso de que en ese tiempo no pudiese recogerlo en casa de acogida alguna,
                    de lo contrario deberá el adoptante hacerse cargo de los gastos que dicho acto ocasione.</p>
                <p>12. En caso de que sea retirado de la custodia del adoptante, el animal por cualquier motivo, y si el
                    mismo presenta algún tipo de lesión o requiere tratamiento veterinario por falta de cuidados,
                    enfermedad, o cualquier otro causados directa o indirectamente por el adoptante, por la presente
                    éste acepta asumir todos los costes en los que se deberá incurrir para la recuperación del animal.
                </p><br><br><br><br>

                <table class="signature">
                    <tr>
                        <td>____________________</td>
                        <td>____________________</td>
                    </tr>
                    <tr>
                        <td>
                            Firma del adoptante<br>
                            {{ $adoption->shelterMember->name }} {{ $adoption->shelterMember->last_name }}
                        </td>
                        <td>Firma del rescatista</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="footer">
            <h6>
                <img src="img/logoRootBlack.png" alt="Logo">
                Designed by <a href="https://rootheim.com/">Root Heim Company</a>
            </h6>
        </div>
    </div>
</body>
</html>
