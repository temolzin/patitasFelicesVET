<div class="modal fade" id="edit{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="card-primary">
                <div class="card-header">
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <h4 class="card-title">Editar Producto <small> &nbsp;(*) Campos requeridos</small></h4>
                        <button type="button" class="close d-sm-inline-block text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <form action="{{ route('products.update', $product->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
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
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="name" class="form-label">Nombre(*)</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Nombre del producto" value="{{ old('name', $product->name) }}" required />
                                            @error('name')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="price" class="form-label">Precio(*)</label>
                                            <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" name="price" placeholder="Precio del producto" value="{{ old('price', $product->price) }}" required />
                                            @error('price')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="stock" class="form-label">Stock(*)</label>
                                            <input type="number" class="form-control @error('stock') is-invalid @enderror" name="stock" placeholder="Cantidad en stock" value="{{ old('stock', $product->stock) }}" required />
                                            @error('stock')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="category" class="form-label">Categoría(*)</label>
                                            <input type="text" id="category" class="form-control @error('category') is-invalid @enderror" name="category" placeholder="Ingresa la categoría" value="{{ old('category', $product->category) }}" required />
                                            @error('category')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>                                    
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="description" class="form-label">Descripción</label>
                                            <textarea class="form-control @error('description') is-invalid @enderror" name="description" rows="3" placeholder="Descripción del producto">{{ old('description', $product->description) }}</textarea>
                                            @error('description')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="notes" class="form-label">Notas</label>
                                            <textarea class="form-control @error('notes') is-invalid @enderror" name="notes" rows="3" placeholder="Notas adicionales sobre el producto">{{ old('notes', $product->notes) }}</textarea>
                                            @error('notes')
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
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function previewImage(event, id) {
        var input = event.target;
        var reader = new FileReader();
        reader.onload = function () {
            var dataURL = reader.result;
            var output = document.getElementById('image-preview-' + id);
            output.src = dataURL;
            output.style.display = 'block';
        };
        reader.readAsDataURL(input.files[0]);
    }
</script>
<style>
    .select2-container .select2-selection--single {
        height: 40px;
        display: flex;
        align-items: center;
    }
</style>
