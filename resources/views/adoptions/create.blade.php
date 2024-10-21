<div class="modal fade" id="createAdoption{{ $vetMember->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="card-success">
                <div class="card-header">
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <h4 class="card-title">Agregar Adopción a {{ $vetMember->name }} {{ $vetMember->last_name }}<small>&nbsp;(*) Campos requeridos</small></h4>
                        <button type="button" class="close d-sm-inline-block text-white" data-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <form action="{{ route('adoptions.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="vet_member_id" value="{{ $vetMember->id }}">
                    <div class="card-body">
                        <div class="card">
                            <div class="card-header py-2 bg-secondary">
                                <h3 class="card-title">Datos de la Adopción</h3>
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
                                            <label for="adoption_date" class="form-label">Fecha de Adopción(*)</label>
                                            <input type="date"
                                                class="form-control @error('adoption_date') is-invalid @enderror"
                                                name="adoption_date" required />
                                            @error('adoption_date')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="animal_id" class="form-label">Mascota(*)</label>
                                            <select
                                                class="form-control select2 @error('animal_id') is-invalid @enderror"
                                                name="animal_id" required>
                                                <option value="">Seleccione una mascota</option>
                                                @foreach ($animals as $animal)
                                                    <option value="{{ $animal->id }}">{{ $animal->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('animal_id')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="observation" class="form-label">Notas</label>
                                            <textarea class="form-control @error('observation') is-invalid @enderror" name="observation"></textarea>
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
    }
</style>
