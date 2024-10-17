<div class="modal fade" id="viewDonation{{ $donation->id }}" tabindex="-1" role="dialog"
    aria-labelledby="viewDonationLabel{{ $donation->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content ">
            <div class="card-info">
                <div class="card-header ">
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <h4 class="card-title">Detalles de la donacion</h4>
                        <button type="button" class="close d-sm-inline-block text-white"
                            onclick="closeCurrentModal('#viewDonation{{ $donation->id }}')" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>ID</label>
                                        <input type="text" disabled class="form-control" value="{{ $donation->id }}" />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Fecha de la Donación</label>
                                        <input type="text" class="form-control" value="{{ $donation->donation_date }}"
                                            disabled/>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Tipo de Donación</label>
                                        <input type="text" class="form-control" value="{{ $donation->type }}"
                                            disabled />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Monto</label>
                                        <input type="text" class="form-control"
                                            value="${{ number_format($donation->amount, 2) }}" disabled />
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Observaciones</label>
                                        <textarea class="form-control" rows="3"
                                            disabled>{{ $donation->observation }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        onclick="closeCurrentModal('#viewDonation{{ $donation->id }}')">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>
