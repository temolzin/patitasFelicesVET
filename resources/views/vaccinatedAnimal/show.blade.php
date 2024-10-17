<div class="modal fade" id="viewVaccinatedAnimal{{ $animal->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="card-secondary">
                <div class="card-header">
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <h4 class="card-title">Detalles de las Vacunas de {{ $animal->name }}</h4>
                        <button type="button" class="close d-sm-inline-block text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <div class="modal-body">
                    @php
                    $vaccinatedAnimal = $vaccinatedAnimals[$animal->id] ?? [];
                    @endphp
                    @if (empty($vaccinatedAnimal))
                    <p>No hay registros de vacunaciones para este animal.</p>
                    @else
                    @foreach($vaccinatedAnimal as $vaccinatedAnimal)
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title"><strong>Id de la vacunación:</strong> {{ $vaccinatedAnimal->id }}</h5>
                            <p class="card-text">
                                <strong>Fecha de Aplicación:</strong> {{ $vaccinatedAnimal->application_date }}
                                <br>
                                <strong>Nombre de la Vacuna:</strong> {{ $vaccinatedAnimal->vaccines->name }}
                            </p>
                            <div class="btn-group" role="group" aria-label="Options">
                                <button type="button" class="btn btn-danger mr-2" data-toggle="modal" title="deleteVaccinatedAnimal" data-target="#deleteVaccinatedAnimal{{ $vaccinatedAnimal->id }}">
                                    <i class="fas fa-trash-alt"></i> Eliminar
                                </button>
                            </div>
                        </div>
                    </div>
                    @include('vaccinatedAnimal.deleteVaccinatedAnimal')
                    @endforeach
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>
