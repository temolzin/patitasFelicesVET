@extends('adminlte::page')

@section('title', 'PatitasFelices | Productos')

@section('content')
<section class="content">
    <div class="right_col" role="main">
        <div class="col-md-12 col-sm-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Productos</h2>
                    <div class="row">
                        <div class="col-lg-12 text-right">
                            <div class="btn-group" role="group" aria-label="Acciones de Producto">
                                <button class="btn btn-success mr-2" data-toggle='modal' data-target="#createProduct">
                                    <i class="fa fa-plus"></i> Registrar producto
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box table-responsive">
                                <table id="products" class="table table-striped display responsive nowrap" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>FOTO</th>
                                            <th>NOMBRE</th>
                                            <th>CATEGORÍA</th>
                                            <th>ESTADO</th>
                                            <th>CANTIDAD</th>
                                            <th>OPCIONES</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($products) <= 0)
                                        <tr>
                                            <td colspan="7">No hay resultados</td>
                                        </tr>
                                        @else
                                        @foreach($products as $product)
                                        <tr>
                                            <td scope="row">{{ $product->id }}</td>
                                            <td>
                                                @if ($product->getFirstMediaUrl('productGallery'))
                                                    <img src="{{ $product->getFirstMediaUrl('productGallery') }}" alt="Foto de {{ $product->name }}" style="width: 50px; height: 50px; border-radius: 50%;">
                                                @else
                                                    <img src="{{ asset('img/logo.png') }}" style="width: 50px; height: 50px; border-radius: 50%;">
                                                @endif
                                            </td>
                                            <td>{{ $product->name }}</td>
                                            <td>{{ $product->category->name }}</td>
                                            <td>{{ $product->status }}</td>
                                            <td>{{ $product->amount }}</td>
                                            <td>
                                                <div class="btn-group" role="group" aria-label="Opciones">
                                                    <button type="button" class="btn btn-info mr-2" data-toggle="modal" title="Ver Detalles" data-target="#view{{ $product->id }}">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-warning mr-2" data-toggle="modal" title="Editar Datos" data-target="#edit{{ $product->id }}">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-primary mr-2" data-toggle="modal" title="Actualizar Imagen" data-target="#editPhoto{{ $product->id }}">
                                                        <i class="fas fa-image"></i>
                                                    </button>
                                                    @if($product->exists() && $product->inventories()->count() > 0)
                                                        <button type="button" class="btn btn-secondary mr-2" title="Eliminación no permitida: Este producto está relacionado con un inventario." disabled>
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    @else
                                                        <button type="button" class="btn btn-danger mr-2" data-toggle="modal" title="Eliminar Registro" data-target="#delete{{ $product->id }}">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    @endif
                                                </div>
                                            </td>
                                            @include('products.edit')
                                            @include('products.delete')
                                            @include('products.show')
                                            @include('products.editPhoto')
                                        </tr>
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
            order:[0, 'desc'],
            buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
            dom: 'Bfrtip',
        });
        var successMessage = "{{ session('success') }}";
        var errorMessage = "{{ session('error') }}";
        if (successMessage) {
            Swal.fire({
                title: 'Éxito',
                text: successMessage,
                icon: 'success',
                confirmButtonText: 'Aceptar'
            }).then((result) => {
                window.location.href = "{{ route('products.index') }}";
            });
        }
        if (errorMessage) {
            Swal.fire({
                title: 'Error',
                text: errorMessage,
                icon: 'error',
                confirmButtonText: 'Aceptar'
            }).then((result) => {
                window.location.href = "{{ route('products.index') }}";
            });
        }
    });
</script>
@endsection
