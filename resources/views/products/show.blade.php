<div class="modal fade" id="view{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel{{ $product->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="card-info">
                <div class="card-header">
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <h4 class="card-title">Información del Producto</h4>
                        <button type="button" class="close d-sm-inline-block text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-header py-2 bg-secondary">
                            <h3 class="card-title">Datos del Producto</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12 text-center">
                                    @if ($product->getFirstMediaUrl('productGallery'))
                                        <img src="{{ $product->getFirstMediaUrl('productGallery') }}" alt="Foto del producto" class="img-fluid" 
                                         style="width: 120px; height: 120px; border-radius: 50%; margin-bottom: 5px;">
                                    @else
                                        <img src="{{ asset('img/logo.png') }}" alt="Foto del producto" class="img-fluid" 
                                        style="width: 120px; height: 120px; border-radius: 50%; margin-bottom: 5px;">
                                    @endif
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>ID</label>
                                        <input type="text" disabled class="form-control" value="{{ $product->id }}" />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Nombre</label>
                                        <input type="text" disabled class="form-control" value="{{ $product->name }}" />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Costo</label>
                                        <input type="text" disabled class="form-control" value="{{ $product->cost }}" />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Categoría</label>
                                        <input type="text" disabled class="form-control" value="{{ $product->category->name }}" />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Creado por</label>
                                        <input type="text" disabled class="form-control" value="{{ optional($product->creator)->name ?: 'No asignado' }}" />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Estado</label>
                                        <input type="text" disabled class="form-control" value="{{ $product->status }}" />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Cantidad</label>
                                        <input type="number" disabled class="form-control" value="{{ $product->amount }}" />
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Descripción</label>
                                        <textarea type="text" disabled class="form-control" >{{ $product->description }}</textarea>
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
