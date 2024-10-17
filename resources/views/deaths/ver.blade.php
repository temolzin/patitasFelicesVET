<!-- Modal de Información del Fallecimiento -->
<div class="modal fade" id="view{{ $death->death_id }}" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel{{ $death->death_id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="card-info">
                <div class="card-header">
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <h4 class="card-title">Información del Fallecimiento</h4>
                        <button type="button" class="close d-sm-inline-block text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-header py-2 bg-secondary">
                            <h3 class="card-title">Datos del Deceso</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group text-center">
                                        <label for="" class="form-label">Foto del Animal</label><br>
                                        <img src="{{ $death->animal->getFirstMediaUrl('animalGallery') ?? asset('img/animaldefault.png') }}" alt="Foto del Animal" style="width: 150px; height: 150px; border-radius: 50%;">
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="form-group">
                                        <label>ID</label>
                                        <input type="text" disabled class="form-control" value="{{ $death->death_id }}" />
                                    </div>
                                    <div class="form-group">
                                        <label>Nombre del Animal</label>
                                        <input type="text" disabled class="form-control" value="{{ $death->animal->name }}" />
                                    </div>
                                    <div class="form-group">
                                        <label>Fecha de Fallecimiento</label>
                                        <input type="text" disabled class="form-control" value="{{ $death->date }}" />
                                    </div>
                                    <div class="form-group">
                                        <label>Causa del Fallecimiento</label>
                                        <input type="text" disabled class="form-control" value="{{ $death->cause }}" />
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
