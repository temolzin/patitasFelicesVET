<div class="modal fade" id="createSponsorship{{ $shelterMember->id }}" tabindex="-1" role="dialog" aria-labelledby="createSponsorshipLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{ route('sponsorship.store') }}" method="POST">
            @csrf
            <input type="hidden" name="shelter_member_id" value="{{ $shelterMember->id }}">
            <div class="modal-content">
                <div class="card-success">
                    <div class="card-header">
                        <div class="d-sm-flex align-items-center justify-content-between">
                            <h4 class="card-title">Agregar apadrinamiento <small>&nbsp;(*) Campos requeridos</small></h4>
                            <button type="button" class="close d-sm-inline-block text-white" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="card">
                            <div class="card-header py-2 bg-secondary">
                                <h3 class="card-title">Datos del apadrinamiento</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6 mb-3">
                                        <div class="form-group">
                                            <label for="animal_id" class="form-label">Mascota(*)</label>
                                            <select class="form-control select2 @error('animal_id') is-invalid @enderror" name="animal_id" required>
                                                <option value="">Selecciona la mascota para apadrinar</option>
                                                @php
                                                $sponsoredAnimals = [];
                                                @endphp
                                                @if(isset($sponsorships[$shelterMember->id]) && count($sponsorships[$shelterMember->id]) > 0)
                                                @foreach ($sponsorships[$shelterMember->id] as $sponsorship)
                                                @if (!in_array($sponsorship->animal->id, $sponsoredAnimals))
                                                <option value="{{ $sponsorship->animal->id }}" {{ old('animal_id') == $sponsorship->animal->id ? 'selected' : '' }}>
                                                    {{ $sponsorship->animal->name }} (Ya apadrinada)
                                                </option>
                                                @php
                                                $sponsoredAnimals[] = $sponsorship->animal->id;
                                                @endphp
                                                @endif
                                                @endforeach
                                                @else
                                                <option disabled>No hay mascotas apadrinadas</option>
                                                @endif
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
                                    <div class="col-lg-6 mb-3">
                                        <div class="form-group">
                                            <label for="start_date" class="form-label">Fecha de inicio</label>
                                            <input type="date" class="form-control @error('start_date') is-invalid @enderror" name="start_date" value="{{ old('start_date') }}" required />
                                            @error('start_date')
                                            <span class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <div class="form-group">
                                            <label for="finish_date" class="form-label">Fecha de finalización</label>
                                            <input type="date" class="form-control @error('finish_date') is-invalid @enderror" name="finish_date" value="{{ old('finish_date') }}" required />
                                            @error('finish_date')
                                            <span class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <div class="form-group">
                                            <label for="payment_date" class="form-label">Fecha de el pago</label>
                                            <input type="date" class="form-control @error('payment_date') is-invalid @enderror" name="payment_date" value="{{ old('payment_date') }}" required />
                                            @error('payment_date')
                                            <span class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="amount" class="form-label">Monto</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">$</span>
                                                </div>
                                                <input type="number" class="form-control @error('amount') is-invalid @enderror" name="amount" id="amount" placeholder="Ingresa el monto con que apadrina" value="{{ old('amount') }}" required>
                                                @error('amount')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div id="alerta-numero" class="alert alert-danger" style="display: none;">
                                                Por favor ingrese solo números en este campo.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="observation" class="form-label">Observación</label>
                                            <textarea class="form-control @error('observation') is-invalid @enderror" name="observation" placeholder="Ingresa observación" required>{{ old('observation') }}</textarea>
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
                </div>
            </div>
    </div>
    </form>
</div>
