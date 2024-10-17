<div class="modal fade" id="viewAdoption{{ $adoption->id }}" tabindex="-1" role="dialog" aria-labelledby="viewAdoptionLabel{{ $adoption->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content ">
            <div class="card-info">
                <div class="card-header " >
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <h4 class="card-title">Detalles de la Adopción</h4>
                        <button type="button" class="close d-sm-inline-block text-white" onclick="closeCurrentModal('#viewAdoption{{$adoption->id}}')" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="adoption_id">ID de Adopción:</label>
                                        <input type="text" class="form-control" value="{{ $adoption->id }}" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="adoption_date">Fecha de Adopción:</label>
                                        <input type="text" class="form-control" value="{{ $adoption->adoption_date }}" readonly>
                                    </div>
                                </div>                                
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="animal_name">Nombre de la Mascota:</label>
                                        <input type="text" class="form-control" value="{{ $adoption->animal->name }}" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="adopter_name">Nombre del Adoptante:</label>
                                        <input type="text" class="form-control" value="{{ $adoption->shelterMember->name }} {{ $adoption->shelterMember->last_name }}" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="observation">Notas:</label>
                                        <textarea class="form-control" readonly>{{ $adoption->observation }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"   onclick="closeCurrentModal('#viewAdoption{{$adoption->id}}')" >Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>

