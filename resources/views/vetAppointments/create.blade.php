<div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="card-success">
                <div class="card-header">
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <h4 class="card-title">Agregar Cita Veterinaria <small> &nbsp;(*) Campos requeridos</small></h4>
                        <button type="button" class="close d-sm-inline-block text-white" data-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <form action="{{ route('vetAppointments.store') }}" method="post">
                    @csrf
                    <div class="card-body">
                        <div class="card">
                            <div class="card-header py-2 bg-secondary">
                                <h3 class="card-title">Datos de la cita veterinaria</h3>
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
                                                    <option value="{{ $animal->id }}" {{ old('animal_id') == $animal->id ? 'selected' : '' }}>
                                                        {{ $animal->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('animal_id')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="schedule_date" class="form-label">Fecha y hora de la
                                                cita(*)</label>
                                            <input type="datetime-local"
                                                class="form-control @error('schedule_date') is-invalid @enderror"
                                                name="schedule_date"
                                                value="{{ old('schedule_date') }}" required />
                                            @error('schedule_date')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="reason" class="form-label">Motivo de la
                                                cita(*)</label>
                                            <input type="text"
                                                class="form-control @error('reason') is-invalid @enderror"
                                                name="reason" placeholder="Motivo de la cita"
                                                value="{{ old('reason') }}" required />
                                            @error('reason')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="status" class="form-label">Estado de la cita</label>
                                            <select
                                                class="form-control @error('status') is-invalid @enderror"
                                                name="status">
                                                <option value="">Selecciona el estado</option>
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
                                                name="observation"
                                                placeholder="Observaciones">{{ old('observation') }}</textarea>
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
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" id="save" class="btn btn-success">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .select2-container .select2-selection--single {
        height: 40px;
        display: flex;
        align-items: center;
    }
    .select2-container .select2-selection--single .select2-selection__rendered {
        line-height: 40px;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 38px;
    }
</style>
