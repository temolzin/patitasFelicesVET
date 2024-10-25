<div class="modal fade" id="createAssignedService{{ $animal->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="card-success">
                <div class="card-header">
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <h4 class="card-title">Agregar Servicio a {{ $animal->name }}<small>&nbsp;(*) Campos requeridos</small></h4>
                        <button type="button" class="close d-sm-inline-block text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <form action="{{ route('service_animals.store') }}" method="post" enctype="multipart/form-data"> 
                    @csrf
                    <input type="hidden" name="animal_id" value="{{ $animal->id }}">
                    <div class="card-body">
                        <div class="card">
                            <div class="card-header py-2 bg-secondary">
                                <h3 class="card-title">Datos del Servicio Aplicado</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="application_date" class="form-label">Fecha de Aplicación(*)</label>
                                            <input type="date" class="form-control @error('service_date') is-invalid @enderror" name="service_date" required />
                                            @error('service_date')
                                            <span class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="service_id" class="form-label">Servicio(*)</label>
                                            <select class="form-control select2 @error('service_id') is-invalid @enderror" name="service_id" required>
                                                <option value="">Seleccione un servicio</option>
                                                @foreach ($services as $service)
                                                <option value="{{ $service->id }}">{{ $service->name }} - ${{ $service->cost }}</option>
                                                @endforeach
                                            </select>
                                            @error('service_id')
                                            <span class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" id="save" class="btn btn-success">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
