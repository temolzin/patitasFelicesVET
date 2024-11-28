<div class="modal fade" id="edit{{ $client->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="card-warning">
                <div class="card-header">
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <h4 class="card-title">Editar Cliente <small> &nbsp;(*) Campos requeridos</small></h4>
                        <button type="button" class="close d-sm-inline-block text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <form action="{{ route('clients.update', $client->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="card">
                            <div class="card-header py-2 bg-secondary">
                                <h3 class="card-title">Datos del Cliente</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="name" class="form-label">Nombre(*)</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                   name="name" value="{{ old('name', $client->name) }}" required />
                                            @error('name')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="last_name" class="form-label">Apellido(*)</label>
                                            <input type="text" class="form-control @error('last_name') is-invalid @enderror"
                                                   name="last_name" value="{{ old('last_name', $client->last_name) }}" required />
                                            @error('last_name')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="animal_id">Seleccionar Mascota:</label>
                                            <select class="form-control select2" id="animal_id" name="animal_id" required>
                                                <option value="">Seleccione una mascota</option>
                                                @foreach($animals as $animal)
                                                    <option value="{{ $animal->id }}" {{ old('animal_id', $client->animal_id) == $animal->id ? 'selected' : '' }}>
                                                        {{ $animal->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('animal_id')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="phone" class="form-label">Teléfono(*)</label>
                                            <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                                   name="phone" value="{{ old('phone', $client->phone) }}" required />
                                            @error('phone')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="email" class="form-label">Correo Electrónico(*)</label>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                                   name="email" value="{{ old('email', $client->email) }}" required />
                                            @error('email')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="state" class="form-label">Estado(*)</label>
                                            <input type="text" class="form-control @error('state') is-invalid @enderror"
                                                   name="state" value="{{ old('state', $client->state) }}" required />
                                            @error('state')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="city" class="form-label">Ciudad(*)</label>
                                            <input type="text" class="form-control @error('city') is-invalid @enderror"
                                                   name="city" value="{{ old('city', $client->city) }}" required />
                                            @error('city')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="colony" class="form-label">Colonia</label>
                                            <input type="text" class="form-control @error('colony') is-invalid @enderror"
                                                   name="colony" value="{{ old('colony', $client->colony) }}" />
                                            @error('colony')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="address" class="form-label">Dirección(*)</label>
                                            <input type="text" class="form-control @error('address') is-invalid @enderror"
                                                   name="address" value="{{ old('address', $client->address) }}" required />
                                            @error('address')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="postal_code" class="form-label">Código Postal(*)</label>
                                            <input type="text" class="form-control @error('postal_code') is-invalid @enderror"
                                                   name="postal_code" value="{{ old('postal_code', $client->postal_code) }}" required />
                                            @error('postal_code')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="observations" class="form-label">Observaciones</label>
                                            <textarea class="form-control @error('observations') is-invalid @enderror"
                                                      name="observations">{{ old('observations', $client->observations) }}</textarea>
                                            @error('observations')
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
                        <button type="submit" id="save" class="btn btn-warning">Actualizar</button>
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
  </style>
  