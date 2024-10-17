<div class="modal fade" id="viewAdoptions{{ $shelterMember->id }}" tabindex="-1" aria-labelledby="viewAdoptionsLabel{{ $shelterMember->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="card-secondary">
                <div class="card-header">
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <h4 class="card-title">Adopciones de {{ $shelterMember->name }} {{ $shelterMember->last_name }}</h4>
                        <button type="button" class="close d-sm-inline-block text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <div class="modal-body">
                    @php
                        $memberAdoptions = $adoptions->where('shelter_member_id', $shelterMember->id);
                    @endphp
                    @if (count($memberAdoptions) <= 0)
                        <p>No hay adopciones para este adoptante.</p>
                    @else
                        @foreach ($memberAdoptions as $adoption)
                            <div class="card mb-3">
                                <div class="row no-gutters">
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <h5 class="card-title">Mascota: {{ $adoption->animal->name }}</h5>
                                            <p class="card-text">Fecha de Adopción: {{ $adoption->adoption_date }}</p>
                                            <div class="btn-group" role="group" aria-label="Opciones">
                                                <button type="button" class="btn btn-info mr-2" data-toggle="modal" title="Ver adopción" data-target="#viewAdoption{{ $adoption->id }}" >
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button type="button" class="btn btn-danger mr-2" data-toggle="modal" title="Eliminar Adopción" data-target="#deleteAdoption{{ $adoption->id }}">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                                <a type="button" class="btn btn-secondary" title="Generar Contrato" target="_blank" href="{{ route('adoptions.pdfAdoption', Crypt::encrypt($adoption->id)) }}">
                                                    <i class="fas fa-file-pdf"></i>
                                                </a>
                                                @include('adoptions.delete')
                                                @include('adoptions.show')
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
