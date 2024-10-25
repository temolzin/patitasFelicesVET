<div class="modal fade" id="edit{{ $service->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{ $service->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="card-success"> <!-- Cambiado a card-success para que sea verde -->
                <div class="card-header">
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <h4 class="card-title">Editar Información del Servicio</h4>
                        <button type="button" class="close d-sm-inline-block text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <form action="{{ route('services.update', $service->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="card">
                            <div class="card-header py-2 bg-secondary"> <!-- Mantiene el fondo secundario en el encabezado -->
                                <h3 class="card-title">Editar Datos del Servicio</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <input type="hidden" name="service_id" value="{{ $service->id }}" />
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Nombre del Servicio(*)</label>
                                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $service->name) }}" required />
                                            @error('name')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Descripción(*)</label>
                                            <textarea name="description" class="form-control @error('description') is-invalid @enderror" required>{{ old('description', $service->description) }}</textarea>
                                            @error('description')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Costo(*)</label>
                                            <input type="number" step="0.01" name="cost" class="form-control @error('cost') is-invalid @enderror" value="{{ old('cost', $service->cost) }}" required />
                                            @error('cost')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Disponibilidad(*)</label>
                                            <select name="availability" class="form-control @error('availability') is-invalid @enderror" required>
                                                <option value="">Seleccione...</option>
                                                <option value="Disponible" {{ old('availability', $service->availability) == 'Disponible' ? 'selected' : '' }}>Disponible</option>
                                                <option value="No disponible" {{ old('availability', $service->availability) == 'No disponible' ? 'selected' : '' }}>No disponible</option>
                                            </select>
                                            @error('availability')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Duración(*) (en minutos)</label>
                                            <input type="number" name="duration" class="form-control @error('duration') is-invalid @enderror" value="{{ old('duration', $service->duration) }}" required />
                                            @error('duration')
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
                        <button type="submit" class="btn btn-success">Guardar Cambios</button> <!-- Botón en verde -->
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
