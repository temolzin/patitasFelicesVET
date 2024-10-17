<div class="modal fade" id="createDonation{{$shelterMember->id}}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="card-success">
                <div class="card-header">
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <h4 class="card-title">Agregar Donación <small> &nbsp;(*) Campos requeridos</small></h4>
                        <button type="button" class="close d-sm-inline-block text-white" data-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <form action="{{ route('donation.store') }}" method="post">
                    @csrf
                    <input type="hidden" name="shelter_member_id" value="{{ $shelterMember->id }}">
                    <div class="card-body">
                        <div class="card">
                            <div class="card-header py-2 bg-secondary">
                                <h3 class="card-title">Datos de la Donación</h3>
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
                                            <label for="donation_date" class="form-label">Fecha de la
                                                Donación(*)</label>
                                            <input type="date"
                                                class="form-control @error('donation_date') is-invalid @enderror"
                                                name="donation_date" value="{{ old('donation_date') }}" required />
                                            @error('donation_date')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="type" class="form-label">Tipo de Donación(*)</label>
                                            <select class="form-control @error('type') is-invalid @enderror" name="type"
                                                required>
                                                <option value="">Seleccione un tipo de donación</option>
                                                @foreach ($type as $types)
                                                    <option value="{{ $types }}" {{ old('forms', $shelterMember->types ?? '') == $types ? 'selected' : '' }}>
                                                        {{ $types }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('type')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="amount" class="form-label">Monto o cantidad(*)</label>
                                            <input type="number"
                                                class="form-control @error('amount') is-invalid @enderror" name="amount"
                                                placeholder="Monto" value="{{ old('amount') }}" required />
                                            @error('amount')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="observation" class="form-label">Observaciones</label>
                                            <textarea class="form-control @error('observation') is-invalid @enderror"
                                                name="observation" placeholder="Observaciones"
                                                required>{{ old('observation') }}</textarea>
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
