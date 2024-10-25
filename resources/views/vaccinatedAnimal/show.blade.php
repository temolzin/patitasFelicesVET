<div class="modal fade" id="viewVaccinatedAnimal{{ $animal->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="card-secondary">
                <div class="card-header">
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <h4 class="card-title">Detalles de {{ $animal->name }}</h4>
                        <button type="button" class="close d-sm-inline-block text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <div class="modal-body">
                    <h5 class="mt-4">Vacunas</h5>
                    @php
                    $vaccinatedAnimal = $vaccinatedAnimals[$animal->id] ?? [];
                    @endphp
                    @if (empty($vaccinatedAnimal))
                        <p>No hay registros de vacunaciones para este animal.</p>
                    @else
                        @foreach($vaccinatedAnimal as $vaccinatedAnimal)
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h6 class="card-title"><strong>ID de la vacunación:</strong> {{ $vaccinatedAnimal->id }}</h6>
                                    <p class="card-text">
                                        <strong>Fecha de Aplicación:</strong> {{ $vaccinatedAnimal->application_date }}
                                        <br>
                                        <strong>Nombre de la Vacuna:</strong> {{ $vaccinatedAnimal->vaccines->name }}
                                    </p>
                                    <div class="btn-group" role="group" aria-label="Options">
                                        <button type="button" class="btn btn-danger mr-2" data-toggle="modal" title="Eliminar Vacunación" data-target="#deleteVaccinatedAnimal{{ $vaccinatedAnimal->id }}">
                                            <i class="fas fa-trash-alt"></i> Eliminar
                                        </button>
                                    </div>
                                </div>
                            </div>
                            @include('vaccinatedAnimal.deleteVaccinatedAnimal')
                        @endforeach
                    @endif

                    <h5 class="mt-4">Servicios</h5>
                    @php
                    $services = $animal->assignedServices ?? collect();
                    @endphp
                    @if ($services->isEmpty())
                        <p>No hay registros de servicios para este animal.</p>
                    @else
                        @foreach($services as $assignService)
                            <div class="card mb-3">
                                <div class="card-body">
                                <h6 class="card-title"><strong>Nombre del servicio:</strong> {{ $assignService->service->name }}</h6>
                                    <p class="card-text">
                                    <strong>Costo:</strong> {{ $assignService->service->cost }}
                                    <br>
                                    <strong>Descripción:</strong> {{ $assignService->service->description }}
                                        <br>
                                        <strong>Fecha del servicio:</strong> {{ $assignService->service_date }}
                                    </p>
                                    <div class="btn-group" role="group" aria-label="Options">
                                        <button type="button" class="btn btn-danger mr-2" data-toggle="modal" title="Eliminar Servicio" data-target="#deleteAppliedService{{ $assignService->id }}">
                                            <i class="fas fa-trash-alt"></i> Eliminar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        @include('assignService.deleteAssignService', ['assignService' => $assignService, 'animal' => $animal])
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>
