<div class="modal fade" id="view{{ $client->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="card-info">
                <div class="card-header">
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <h4 class="card-title">Detalles del Cliente</h4>
                        <button type="button" class="close d-sm-inline-block text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="card">
                        <div class="card-header py-2 bg-secondary">
                            <h3 class="card-title">Información del Cliente</h3>
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
                                        <label for="name" class="form-label">Nombre:</label>
                                        <p>{{ $client->name }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="last_name" class="form-label">Apellido:</label>
                                        <p>{{ $client->last_name }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="number_pets" class="form-label">Número de Mascotas:</label>
                                        <p>{{ $client->number_pets }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="phone" class="form-label">Teléfono:</label>
                                        <p>{{ $client->phone }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="email" class="form-label">Correo Electrónico:</label>
                                        <p>{{ $client->email }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="state" class="form-label">Estado:</label>
                                        <p>{{ $client->state }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="city" class="form-label">Ciudad:</label>
                                        <p>{{ $client->city }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="colony" class="form-label">Colonia:</label>
                                        <p>{{ $client->colony }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="address" class="form-label">Dirección:</label>
                                        <p>{{ $client->address }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="postal_code" class="form-label">Código Postal:</label>
                                        <p>{{ $client->postal_code }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="observations" class="form-label">Observaciones:</label>
                                        <p>{{ $client->observations }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>
