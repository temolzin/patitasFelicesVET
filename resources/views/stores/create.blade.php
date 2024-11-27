<div class="modal fade" id="createStore" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="card-success">
                <div class="card-header">
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <h4 class="card-title">Registrar Ventas
                            <small>&nbsp;(*) Campos requeridos</small>
                        </h4>
                        <button type="button" class="close d-sm-inline-block text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <form action="{{ route('stores.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="card">
                            <div class="card-header py-2 bg-secondary">
                                <h3 class="card-title">Ingrese los Datos de la Venta</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-lg-6">
                                        <label for="client_id">Cliente (*)</label>
                                        <select id="client_id" class="form-control" name="client_id" required>
                                        <option value="">Selecciona un cliente</option>
                                            @foreach($clients as $client)
                                            <option value="{{ $client->id }}" {{ old('client_id') == $client->id ? 'selected' : '' }}>{{ $client->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label for="item_type">Tipo de Ítem</label>
                                        <select id="item_type" class="form-control">
                                            <option value="">Selecciona el tipo</option>
                                            <option value="product">Producto</option>
                                            <option value="service">Servicio</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-lg-6" id="itemSelectContainer">
                                        <label id="itemLabel" for="item_id">Selecciona un ítem</label>
                                        <select id="item_id" class="form-control">
                                            <option value="">Selecciona un ítem</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label for="storeMetodPay" class="form-label">Método de Pago (*)</label>
                                        <select class="form-control" id="storeMetodPay" name="payment_method" required>
                                            <option value="efectivo">Efectivo</option>
                                            <option value="tarjeta">Tarjeta</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="storeDescription">Descripción de la Venta</label>
                                    <textarea id="storeDescription" class="form-control" name="description" rows="3"></textarea>
                                </div>
                                <div class="row">
                                    <div class="form-group col-lg-12 d-flex justify-content-end">
                                        <button type="button" id="addItemToStoreBtn" class="btn btn-success">Agregar Ítem</button>
                                    </div>
                                </div>
                                <table class="table table-bordered mt-3" id="storeItemTable">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Cantidad</th>
                                            <th>Precio</th>
                                            <th>Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" id="saveStore" class="btn btn-success">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const itemTypeSelect = document.getElementById('item_type');
        const itemSelect = document.getElementById('item_id');
        const itemTableBody = document.querySelector('#storeItemTable tbody');
        
        const products = @json($products);
        const services = @json($services);
    
        document.getElementById('addItemToStoreBtn').removeEventListener('click', addItemToStore);
    
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
    
        function addItemToStore() {
            const itemId = itemSelect.value;
            if (!itemId) return alert('Por favor selecciona un ítem.');

            const itemName = itemSelect.selectedOptions[0].text;
            const itemCost = parseFloat(itemSelect.selectedOptions[0].dataset.cost);

            const isProduct = itemTypeSelect.value === 'product';

            const newRow = document.createElement('tr');
            newRow.innerHTML = `
                <td>${itemName}<input type="hidden" name="${isProduct ? 'products[]' : 'services[]'}" value="${itemId}"></td>
                <td><input type="number" class="form-control quantity-input" name="${isProduct ? 'product_quantities[]' : 'service_quantities[]'}" min="1" value="1"></td>
                <td><input type="number" class="form-control price-input" name="cost[]" value="${itemCost}" readonly></td>
                <td><button type="button" class="btn btn-danger btn-sm delete-row"><i class="fas fa-trash-alt"></i></button></td>
                `;
            itemTableBody.appendChild(newRow);

            newRow.querySelector('.quantity-input').addEventListener('input', function () {
                const quantity = parseInt(this.value);
                const priceField = newRow.querySelector('.price-input');
                priceField.value = quantity * itemCost;
            });

            newRow.querySelector('.delete-row').addEventListener('click', () => newRow.remove());

            itemSelect.selectedIndex = 0;
            itemTypeSelect.selectedIndex = 0;
        }

        document.getElementById('addItemToStoreBtn').addEventListener('click', addItemToStore);
    
        $('#createStore').on('hidden.bs.modal', function () {
            itemTableBody.innerHTML = '';
            itemSelect.selectedIndex = 0;
            itemTypeSelect.selectedIndex = 0;
        });
    });
</script>
