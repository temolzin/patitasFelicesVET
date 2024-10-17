<div class="modal fade" id="edit{{ $vet->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="card-warning">
                <div class="card-header">
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <h4 class="card-title">Editar Cita Veterinaria<small> &nbsp;(*) Campos requeridos</small></h4>
                        <button type="button" class="close d-sm-inline-block text-white" data-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <form action="{{ route('vetAppointments.update', $vet->id) }}" method="post" enctype="multipart/form-data">
                    @csrf @method('PUT')
                    <div class="card-body">
                        <div class="card">
                            <div class="card-header py-2 bg-secondary">
                                <h3 class="card-title">Datos de la Cita</h3>
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
                                            <label for="animal_id" class="form-label">Animal(*)</label>
                                            <select id="animal_id_select"
                                                class="form-control select2 @error('animal_id') is-invalid @enderror"
                                                name="animal_id" required>
                                            <option value="">Seleccione un animal</option>
                                                @foreach ($animals as $animal)
                                                    <option value="{{ $animal->id }}" {{ old('animal_id', $vet->animal_id) == $animal->id ? 'selected' : '' }}>
                                                        {{ $animal->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('animal_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="schedule_date" class="form-label">Fecha y Hora de la
                                                Cita(*)</label>
                                            <input type="datetime-local"
                                                class="form-control @error('schedule_date') is-invalid @enderror"
                                                name="schedule_date" id="schedule_date"
                                                value="{{ $vet->schedule_date }}" required />
                                            @error('schedule_date')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="reason" class="form-label">Razón de la
                                                Cita(*)</label>
                                            <input type="text"
                                                class="form-control @error('reason') is-invalid @enderror"
                                                name="reason" id="reason"
                                                value="{{ $vet->reason }}" required />
                                            @error('reason')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="status" class="form-label">Estado de la
                                                Cita(*)</label>
                                            <select
                                                class="form-control @error('status') is-invalid @enderror"
                                                name="status" id="status" required
                                                style="height: 43px;">
                                                <option value="">Seleccione un estado</option>
                                                @foreach($status as $statu)
                                                    <option value="{{ $statu }}" {{ old('status', $vet->status ?? '') == $statu ? 'selected' : '' }}>
                                                        {{ $statu }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('status')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="observation" class="form-label">Observaciones</label>
                                            <textarea class="form-control @error('observation') is-invalid @enderror"
                                                name="observation" id="observation"
                                                rows="3">{{ $vet->observation }}</textarea>
                                            @error('observation')
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
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" id="edit" class="btn btn-warning">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
