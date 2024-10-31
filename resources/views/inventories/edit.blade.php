<div class="modal fade" id="edit{{ $inventory->id }}" tabindex="-1" role="dialog" aria-labelledby="editInventoryLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="card-warning">
                <div class="card-header">
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <h4 class="card-title">Editar Inventario
                            <small>&nbsp;(*) Campos requeridos</small>
                        </h4>
                        <button type="button" class="close d-sm-inline-block text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <form action="{{ route('inventories.update', $inventory->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="card">
                            <div class="card-header py-2 bg-secondary">
                                <h3 class="card-title">Datos del Inventario</h3>
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
                                            <label for="product_id" class="form-label">Producto(*)</label>
                                            <select class="form-control" id="product_id_{{ $inventory->id }}">
                                                <option value="">Seleccione un producto</option>
                                                @foreach($products as $product)
                                                    <option value="{{ $product->id }}" data-description="{{ $product->description }}">{{ $product->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="status" class="form-label">Estado(*)</label>
                                            <select class="form-control" id="status" name="status" required>
                                                <option value="disponible" {{ $inventory->status == 'disponible' ? 'selected' : '' }}>Disponible</option>
                                                <option value="no disponible" {{ $inventory->status == 'no disponible' ? 'selected' : '' }}>No disponible</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <button type="button" id="addProductBtn_{{ $inventory->id }}" class="btn btn-primary">Agregar Producto</button>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <table class="table table-bordered" id="productTable_{{ $inventory->id }}">
                                            <thead>
                                                <tr>
                                                    <th>Nombre</th>
                                                    <th>Descripción</th>
                                                    <th>Cantidad</th>
                                                    <th>Acción</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($inventory->products as $product)
                                                    <tr>
                                                        <td>{{ $product->name }}<input type="hidden" name="products[]" value="{{ $product->id }}"></td>
                                                        <td>{{ $product->description }}</td>
                                                        <td><input type="number" class="form-control" name="quantities[]" min="1" value="{{ $product->pivot->quantity }}"></td>
                                                        <td><button type="button" class="btn btn-danger btn-sm delete-row">
                                                        <i class="fas fa-trash-alt"></i>
                                                        </button></td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
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

<script>
    document.querySelector('#productTable_{{ $inventory->id }}').addEventListener('click', function(e) {
        if (e.target.classList.contains('delete-row')) {
            e.target.closest('tr').remove();
        }
    });

    document.getElementById('addProductBtn_{{ $inventory->id }}').addEventListener('click', function() {
        const productId = document.getElementById('product_id_{{ $inventory->id }}').value;

        if (productId !== "") {
            const productName = document.getElementById('product_id_{{ $inventory->id }}').selectedOptions[0].text;
            const productDescription = document.getElementById('product_id_{{ $inventory->id }}').selectedOptions[0].getAttribute('data-description');
            const tableBody = document.querySelector('#productTable_{{ $inventory->id }} tbody');
            const newRow = document.createElement('tr');
            newRow.innerHTML = `
                <td>${productName}<input type="hidden" name="products[]" value="${productId}"></td>
                <td>${productDescription}</td>
                <td><input type="number" class="form-control" name="quantities[]" min="1" value="1"></td>
                <td><button type="button" class="btn btn-danger btn-sm delete-row">
                <i class="fas fa-trash-alt"></i>
                </button></td>`;

            tableBody.appendChild(newRow);

            document.getElementById('product_id_{{ $inventory->id }}').value = '';
        } else {
            alert('Por favor seleccione un producto.');
        }
    });
</script>

<style>
    #productTable_{{ $inventory->id }} tbody tr:nth-child(odd) {
        background-color: #ffffff;
    }
    #productTable_{{ $inventory->id }} tbody tr:nth-child(even) {
        background-color: #f2f2f2;
    }
</style>
