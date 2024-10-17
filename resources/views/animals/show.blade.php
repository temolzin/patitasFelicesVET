<!-- Modal para ver detalles del animal -->
<div class="modal fade" id="view{{ $animal->id }}" tabindex="-1" role="dialog"
    aria-labelledby="viewAnimalModalLabel{{ $animal->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="card-info">
                <div class="card-header">
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <h4 class="card-title">Detalles de la Mascota</h4>
                        <button type="button" class="close d-sm-inline-block text-white" data-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-header py-2 bg-secondary">
                            <h3 class="card-title">Datos de la Mascota</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group text-center">
                                        @if ($animal->getFirstMediaUrl('animalGallery'))
                                            <img src="{{ $animal->getFirstMediaUrl('animalGallery') }}"
                                                alt="Foto del Animal" class="img-fluid"
                                                style="width: 120px; height: 120px; border-radius: 50%; margin-bottom: 5px;">
                                        @else
                                            <img src="{{ asset('img/animaldefault.png') }}" alt="Foto del Animal"
                                                class="img-fluid"
                                                style="width: 120px; height: 120px; border-radius: 50%; margin-bottom: 5px;">
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="name">Nombre:</label>
                                        <input type="text" class="form-control" value="{{ $animal->name }}"
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="specie">Especie:</label>
                                        <input type="text" class="form-control" value="{{ $animal->specie->name }}"
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="breed">Raza:</label>
                                        <input type="text" class="form-control" value="{{ $animal->breed }}"
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="birth_date">Edad:</label>
                                        <input type="text" class="form-control" value="{{ $animal->age }}" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="sex">Sexo:</label>
                                        <input type="text" class="form-control" value="{{ $animal->sex }}" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="color">Color:</label>
                                        <input type="text" class="form-control" value="{{ $animal->color }}"
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="weight">Peso:</label>
                                        <input type="text" class="form-control" value="{{ $animal->weight }}"
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="is_sterilized">Esterilizado:</label>
                                        <input type="text" class="form-control" value="{{ $animal->is_sterilized == 1 ? 'Sí' : 'No' }}" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="entry_date">Fecha de Ingreso:</label>
                                        <input type="text" class="form-control" value="{{ $animal->entry_date }}"
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="origin">Origen:</label>
                                        <input type="text" class="form-control" value="{{ $animal->origin }}"
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="behavior">Comportamiento:</label>
                                        <input type="text" class="form-control" value="{{ $animal->behavior }}"
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="history">Historia:</label>
                                        <textarea class="form-control" readonly>{{ $animal->history }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
</div>
