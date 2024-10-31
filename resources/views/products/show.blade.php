<div class="modal fade" id="view{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="card-primary">
                <div class="card-header">
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <h4 class="card-title">Detalles del Producto</h4>
                        <button type="button" class="close d-sm-inline-block text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Nombre:</strong> {{ $product->name }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Descripción:</strong> {{ $product->description }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Precio:</strong> ${{ number_format($product->price, 2) }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Cantidad en Stock:</strong> {{ $product->stock }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Categoría:</strong> {{ $product->category }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Estado:</strong> {{ $product->is_active ? 'Activo' : 'Inactivo' }}</p>
                        </div>
                        <div class="col-md-12">
                            <p><strong>Notas:</strong> {{ $product->notes }}</p>
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
