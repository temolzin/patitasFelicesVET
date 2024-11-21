<div class="modal fade" id="edit{{ $store->id }}" tabindex="-1" role="dialog" aria-labelledby="editStoreLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="card-warning">
                <div class="card-header">
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <h4 class="card-title">Editar Venta
                            <small>&nbsp;(*) Campos requeridos</small>
                        </h4>
                        <button type="button" class="close d-sm-inline-block text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <form action="{{ route('stores.update', $store->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="card">
                            <div class="card-header py-2 bg-secondary">
                                <h3 class="card-title">Datos de la Venta</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-lg-6">
                                        <label for="edit_item_type">Tipo de Ítem</label>
                                        <select name="edit_item_type" id="edit_item_type_{{ $store->id }}" class="form-control">
                                            <option value="">Selecciona el tipo</option>
                                            <option value="product">Producto</option>
                                            <option value="service">Servicio</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-lg-6" id="editItemSelectContainer_{{ $store->id }}">
                                        <label id="editItemLabel_{{ $store->id }}" for="edit_item_id">Selecciona un ítem</label>
                                        <select name="edit_item_id" id="edit_item_id_{{ $store->id }}" class="form-control">
                                            <option value="">Selecciona un ítem</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row align-items-center text-center">
                                    <div class="form-group col-lg-4">
                                        <label for="editStoreStatus" class="form-label">Estado(*)</label>
                                        <select class="form-control" id="editStoreStatus" name="editStoreStatus" required>
                                            <option value="abierta" {{ $store->status == 'abierta' ? 'selected' : '' }}>Disponible</option>
                                            <option value="cerrada" {{ $store->status == 'cerrada' ? 'selected' : '' }}>No disponible</option>
                                        </select>
                                    </div>
                                
                                    <div class="form-group col-lg-4 d-flex justify-content-center">
                                        <button type="button" id="addEditItemToStoreBtn_{{ $store->id }}" class="btn btn-primary">Agregar Ítem</button>
                                    </div>
                                
                                    <div class="form-group col-lg-4">
                                        <label for="editPaymentMethod">Método de Pago</label>
                                        <select name="editStoreMetodPay" id="editStoreMetodPay" class="form-control">
                                            <option value="efectivo" {{ $store->payment_method == 'efectivo' ? 'selected' : '' }}>Efectivo</option>
                                            <option value="tarjeta" {{ $store->payment_method == 'tarjeta' ? 'selected' : '' }}>Tarjeta</option>                                        </select>
                                    </div>
                                </div>                                

                                <table class="table table-bordered mt-3" id="editStoreItemTable_{{ $store->id }}">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Descripción</th>
                                            <th>Cantidad</th>
                                            <th>Precio</th>
                                            <th>Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($store->products as $product)
                                            <tr>
                                                <td>{{ $product->name }}<input type="hidden" name="products[]" value="{{ $product->id }}"></td>
                                                <td>{{ $product->description }}</td>
                                                <td><input type="number" class="form-control quantity-input" name="quantities[]" min="1" value="{{ $product->pivot->quantity }}"></td>
                                                <td><input type="number" class="form-control price-input" name="cost[]" value="{{ $product->cost }}" readonly></td>
                                                <td><button type="button" class="btn btn-danger btn-sm delete-row"><i class="fas fa-trash-alt"></i></button></td>
                                            </tr>
                                        @endforeach

                                        @foreach($store->services as $service)
                                            <tr>
                                                <td>{{ $service->name }}<input type="hidden" name="services[]" value="{{ $service->id }}"></td>
                                                <td>{{ $service->description }}</td>
                                                <td><input type="number" class="form-control quantity-input" name="service_quantities[]" min="1" value="{{ $service->pivot->quantity }}"></td>
                                                <td><input type="number" class="form-control price-input" name="cost[]" value="{{ $service->cost }}" readonly></td>
                                                <td><button type="button" class="btn btn-danger btn-sm delete-row"><i class="fas fa-trash-alt"></i></button></td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" id="saveEditStore" class="btn btn-warning">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const itemTypeSelect = document.getElementById('edit_item_type_{{ $store->id }}');
        const itemSelect = document.getElementById('edit_item_id_{{ $store->id }}');
        const itemTableBody = document.querySelector('#editStoreItemTable_{{ $store->id }} tbody');
        
        const products = @json($products);
        const services = @json($services);

        itemTypeSelect.addEventListener('change', function() {
            itemSelect.innerHTML = '<option value="">Selecciona un ítem</option>';

            let items = [];
            if (itemTypeSelect.value === 'product') {
                items = products;
            } else if (itemTypeSelect.value === 'service') {
                items = services;
            }

            items.forEach(item => {
                const option = document.createElement('option');
                option.value = item.id;
                option.text = item.name;
                option.dataset.description = item.description;
                option.dataset.cost = item.cost;
                itemSelect.appendChild(option);
            });
        });

        document.getElementById('addEditItemToStoreBtn_{{ $store->id }}').addEventListener('click', function() {
            const itemId = itemSelect.value;
            if (!itemId) return alert('Por favor selecciona un ítem.');

            const itemName = itemSelect.selectedOptions[0].text;
            const itemDescription = itemSelect.selectedOptions[0].dataset.description;
            const itemCost = parseFloat(itemSelect.selectedOptions[0].dataset.cost);

            const newRow = document.createElement('tr');
            newRow.innerHTML = `  
                <td>${itemName}<input type="hidden" name="products[]" value="${itemId}"></td>
                <td>${itemDescription}</td>
                <td><input type="number" class="form-control quantity-input" name="quantities[]" min="1" value="1"></td>
                <td><input type="number" class="form-control price-input" name="cost[]" value="${itemCost}" readonly></td>
                <td><button type="button" class="btn btn-danger btn-sm delete-row"><i class="fas fa-trash-alt"></i></button></td>
            `;
            itemTableBody.appendChild(newRow);

            newRow.querySelector('.quantity-input').addEventListener('input', function() {
                const quantity = parseInt(this.value);
                const priceInput = newRow.querySelector('.price-input');
                priceInput.value = (itemCost * quantity).toFixed(2);
            });

            newRow.querySelector('.delete-row').addEventListener('click', function() {
                newRow.remove();
            });
        });
    });
</script>


<style>
    #editStoreItemTable_{{ $store->id }} tbody tr:nth-child(odd) {
        background-color: #ffffff;
    }
    #editStoreItemTable_{{ $store->id }} tbody tr:nth-child(even) {
        background-color: #f2f2f2;
    }
</style>
