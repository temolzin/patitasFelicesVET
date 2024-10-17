<!-- Modal de Edición -->
<div class="modal fade" id="edit{{ $death->death_id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="card-warning">
                <div class="card-header">
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <h4 class="card-title">Editar Fallecimiento<small> &nbsp;(*) Campos requeridos</small></h4>
                        <button type="button" class="close d-sm-inline-block text-white" data-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <form action="{{ route('deaths.update', $death->death_id) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="card">
                            <div class="card-header py-2 bg-secondary">
                                <h3 class="card-title">Datos del Fallecimiento</h3>
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
                                            <img src="{{ $death->animal->getFirstMediaUrl('animalGallery') ?? asset('img/animaldefault.png') }}"
                                                alt="Foto del Animal"
                                                style="width: 150px; height: 150px; border-radius: 50%;">
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="form-group">
                                            <label for="animal_id" class="form-label">Nombre (*)</label>
                                            <select id="animal_id_select"
                                                    class="form-control select2 @error('animal_id') is-invalid @enderror"
                                                    name="animal_id" required>
                                                <option value="">Seleccione una mascota</option>
                                                @foreach ($animals as $animal)
                                                    <option value="{{ $animal->id }}" {{ old('animal_id', $death->animal_id) == $animal->id ? 'selected' : '' }}>
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
                                        <div class="form-group">
                                            <label for="date" class="form-label">Fecha (*)</label>
                                            <input type="date"
                                                class="form-control @error('date') is-invalid @enderror" name="date"
                                                id="date" value="{{ $death->date }}" required />
                                            @error('date')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cause" class="form-label">Causa (*)</label>
                                            <input type="text"
                                                class="form-control @error('cause') is-invalid @enderror" name="cause"
                                                id="cause" value="{{ $death->cause }}"/>
                                            @error('cause')
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
