<div class="modal fade" id="view{{ $store->id }}" tabindex="-1" role="dialog" aria-labelledby="viewStoreLabel{{ $store->id }}" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="card-info">
                <div class="card-header">
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <h4 class="card-title">Ver Venta</h4>
                        <button type="button" class="close d-sm-inline-block text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="card">
                        <div class="card-header py-2 bg-secondary">
                            <h3 class="card-title">Datos de la Venta</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-lg-3">
                                    <label>ID</label>
                                    <input type="text" disabled class="form-control" value="{{ $store->id }}" />
                                </div>

                                <div class="form-group col-lg-3">
                                    <label for="viewStoreStatus">Estado</label>
                                    <input type="text" disabled class="form-control" value="{{ $store->status == 'abierta' ? 'Disponible' : 'No disponible' }}" />
                                </div>

                                <div class="form-group col-lg-3">
                                    <label for="viewStorePaymentMethod">Método de Pago</label>
                                    <input type="text" disabled class="form-control" value="{{ ucfirst($store->payment_method) }}" />
                                </div>

                                <div class="form-group col-lg-3">
                                    <label for="viewStoreTotal">Total</label>
                                    <input type="text" disabled class="form-control" value="${{ number_format($store->products->sum(fn($product) => $product->pivot->quantity * $product->cost) + $store->services->sum(fn($service) => $service->pivot->quantity * $service->cost), 2) }}" />
                                </div>
                            </div>

                            <table class="table table-bordered mt-3" id="viewStoreItemTable{{ $store->id }}">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Descripción</th>
                                        <th>Cantidad</th>
                                        <th>Precio</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($store->products as $product)
                                        <tr>
                                            <td>{{ $product->name }}</td>
                                            <td>{{ $product->description }}</td>
                                            <td>{{ $product->pivot->quantity }}</td>
                                            <td>${{ number_format($product->pivot->quantity * $product->cost, 2) }}</td>
                                        </tr>
                                    @endforeach
                                    @foreach($store->services as $service)
                                        <tr>
                                            <td>{{ $service->name }}</td>
                                            <td>{{ $service->description }}</td>
                                            <td>{{ $service->pivot->quantity }}</td>
                                            <td>${{ number_format($service->pivot->quantity * $service->cost, 2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
