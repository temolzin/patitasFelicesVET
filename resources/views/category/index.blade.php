@extends('adminlte::page')

@section('title', ' PatitasFelices | Categorías')

@section('content')
    <section class="content">
        <div class="right_col" role="main">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Categorías</h2>
                        <div class="row">
                            <div class="col-lg-12 text-right">
                                <div class="btn-group" role="group" aria-label="Acciones de Usuario">
                                    <button class="btn btn-success mr-2" data-toggle='modal' data-target="#createCategory">
                                        <i class="fa fa-plus"></i> Registrar Categoría
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
                                    <table id="categories" class="table table-striped display responsive nowrap"
                                        style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>NOMBRE</th>
                                                <th>DESCRIPCIÓN</th>
                                                <th>OPCIONES</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($categories) <= 0)
                                                <tr>
                                                    <td colspan="4">No hay resultados</td>
                                                </tr>
                                            @else
                                                @foreach ($categories as $category)
                                                    <tr>
                                                        <td scope="row">{{ $category->id }}</td>
                                                        <td>{{ $category->name }}</td>
                                                        <td>{{ $category->description }}</td>
                                                        <td>
                                                            <div class="btn-group" role="group" aria-label="Opciones">
                                                                <button type="button" class="btn btn-info mr-2"
                                                                    data-toggle="modal" title="Ver Detalles"
                                                                    data-target="#view{{ $category->id }}">
                                                                    <i class="fas fa-eye"></i>
                                                                </button>
                                                                <button type="button" class="btn btn-warning mr-2"
                                                                    data-toggle="modal" title="Editar Datos"
                                                                    data-target="#edit{{ $category->id }}">
                                                                    <i class="fas fa-edit"></i>
                                                                </button>
                                                                <button type="button" class="btn btn-danger mr-2"
                                                                    data-toggle="modal" title="Eliminar Registro"
                                                                    data-target="#delete{{ $category->id }}">
                                                                    <i class="fas fa-trash-alt"></i>
                                                                </button>
                                                            </div>
                                                        </td>
                                                        @include('category.edit')
                                                        @include('category.delete')
                                                        @include('category.show')
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                    @include('category.create')
                                    <div class="d-flex justify-content-center">
                                        {!! $categories->links('pagination::bootstrap-4') !!}
                                    </div>
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
            $('#categories').DataTable({
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
                    window.location.href = "{{ route('category.index') }}";
                });
            }
            if (errorMessage) {
                Swal.fire({
                    title: 'Error',
                    text: errorMessage,
                    icon: 'error',
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    window.location.href = "{{ route('category.index') }}";
                });
            }
        });
    </script>
@endsection
