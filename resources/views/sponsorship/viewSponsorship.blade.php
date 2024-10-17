<div class="modal fade" id="viewSponsorship{{ $sponsorship->id }}" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel{{ $shelterMember->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="card-info">
                <div class="card-header bg-info">
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <h4 class="card-title text-white">Información del apadrinamiento</h4>
                        <button type="button" class="close text-white"  onclick="closeCurrentModal('#viewSponsorship{{$sponsorship->id}}')" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>ID</label>
                                <input type="text" disabled class="form-control" value="{{ $sponsorship->id }}" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Mascota</label>
                                <input type="text" disabled class="form-control" value="{{ $sponsorship->animal->name }}" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Fecha de Inicio</label>
                                <input type="text" disabled class="form-control" value="{{ $sponsorship->start_date }}" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Fecha de Finalización</label>
                                <input type="text" disabled class="form-control" value="{{ $sponsorship->finish_date }}" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Fecha de Pago</label>
                                <input type="text" disabled class="form-control" value="{{ $sponsorship->payment_date }}" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Monto</label>
                                <input type="text" disabled class="form-control" value="${{ number_format($sponsorship->amount, 2) }}" />
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Observación</label>
                                <textarea class="form-control" readonly>{{ $sponsorship->observation }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeCurrentModal('#viewSponsorship{{$sponsorship->id}}')">Cerrar</button>
            </div>
        </div>
    </div>
</div>
