@extends('adminlte::page')

@section('title', 'PatitasFelices | Productos')

@section('content')
    <section class="content">
        <div class="right_col" role="main">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Productos</h2>
                        <div class="row">
                            <div class="col-lg-12 text-right">
                                <button class="btn btn-success" data-toggle="modal" data-target="#create"> <i
                                        class="fa fa-edit"></i> Registrar Producto</button>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <table id="products" class="table table-striped display responsive nowrap"
                                        style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>NOMBRE</th>
                                                <th>DESCRIPCIÓN</th>
                                                <th>PRECIO</th>
                                                <th>STOCK</th>
                                                <th>CATEGORÍA</th>
                                                <th>ESTADO</th>
                                                <th>OPCIONES</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($products) <= 0)
                                                <tr>
                                                    <td colspan="8">No hay resultados</td>
                                                </tr>
                                            @else
                                                @foreach ($products as $product)
                                                    <tr>
                                                        <td>{{ $product->id }}</td>
                                                        <td>{{ $product->name }}</td>
                                                        <td>{{ $product->description }}</td>
                                                        <td>{{ $product->price }}</td>
                                                        <td>{{ $product->stock }}</td>
                                                        <td>{{ $product->category }}</td>
                                                        <td>{{ $product->is_active ? 'Activo' : 'Inactivo' }}</td>
                                                        <td>
                                                            <div class="btn-group" role="group" aria-label="Opciones">
                                                                <button type="button" class="btn btn-info mr-2" data-toggle="modal" title="Ver Detalles" data-target="#view{{ $product->id }}">
                                                                    <i class="fas fa-eye"></i>
                                                                </button>
                                                                <button type="button" class="btn btn-warning mr-2" data-toggle="modal" title="Editar Datos" data-target="#delete{{ $product->id }}">
                                                                    <i class="fas fa-edit"></i>
                                                                </button>
                                                                <button type="button" class="btn btn-danger mr-2" data-toggle="modal" title="Eliminar Registro" data-target="#delete{{ $product->id }}">
                                                                    <i class="fas fa-trash-alt"></i>
                                                                </button>
                                                                <button type="button" class="btn btn-primary mr-2" data-toggle="modal" title="Comprar Producto" data-target="#buy{{ $product->id }}">
                                                                    <i class="fas fa-shopping-cart"></i> Comprar
                                                                </button>                                                             
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    @include('products.delete')
                                                    @include('products.buy')
                                                    @include('products.show')
                                                    @include('products.edit')
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                    @include('products.create')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('#products').DataTable({
                responsive: true,
                order: [0, 'desc'],
                buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
                dom: 'Bfrtip',
            });

            var successMessage = "{{ session('success') }}";
            if (successMessage) {
                Swal.fire({
                    icon: 'success',
                    title: 'Éxito',
                    text: successMessage,
                    confirmButtonText: 'Aceptar'
                });
            }
        });

        $('#create').on('shown.bs.modal', function() {
            $('.select2').select2({
                dropdownParent: $('#create')
            });
        });

        $('[id^=edit]').on('shown.bs.modal', function () {
            $('.select2').select2({
                dropdownParent: $(this)
            });
        });
    </script>
@endsection
