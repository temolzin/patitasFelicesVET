@extends('adminlte::page')

@section('title', 'PatitasFelices | Ventas')

@section('content')
<section class="content">
    <div class="right_col" role="main">
        <div class="col-md-12 col-sm-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Ventas</h2>
                    <div class="row">
                        <div class="col-lg-12 text-right">
                            <div class="btn-group" role="group" aria-label="Acciones de Ventaa">
                                <button class="btn btn-success mr-2" data-toggle='modal' data-target="#createStore">
                                    <i class="fa fa-plus"></i> Registrar venta
                                </button>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#generateReportModal">
                                    Generar Reporte
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
                                <table id="stores" class="table table-striped display responsive nowrap" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Fecha y Hora de la Venta</th>
                                            <th>Estado</th>
                                            <th>Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($stores) <= 0)
                                        <tr>
                                            <td colspan="4">No hay resultados</td>
                                        </tr>
                                        @else
                                        @foreach($stores as $store)
                                        <tr>
                                            <td scope="row">{{ $store->id }}</td>
                                            <td>{{ $store->created_at->format('d/m/Y H:i:s') }}</td>
                                            <td>{{ $store->status }}</td>
                                            <td>
                                                <div class="btn-group" role="group" aria-label="Opciones">
                                                    <button type="button" class="btn btn-info mr-2" data-toggle="modal" title="Ver Detalles" data-target="#view{{ $store->id }}">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-warning mr-2" data-toggle="modal" title="Editar Datos" data-target="#edit{{ $store->id }}">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-danger mr-2" data-toggle="modal" title="Eliminar Registro" data-target="#delete{{ $store->id }}">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                    
                                                </div>
                                                @include('stores.delete')
                                                @include('stores.show')
                                                @include('stores.edit')
                                            </td>
                                        </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                                @include('stores.create')
                                @include('stores.generateReportModal')
                                <div class="d-flex justify-content-center">
                                    {!! $stores->links('pagination::bootstrap-4') !!}
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
        $('#stores').DataTable({
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
                window.location.href = "{{ route('stores.index') }}";
            });
        }
        if (errorMessage) {
            Swal.fire({
                title: 'Error',
                text: errorMessage,
                icon: 'error',
                confirmButtonText: 'Aceptar'
            }).then((result) => {
                window.location.href = "{{ route('stores.index') }}";
            });
        }
    });
</script>
@endsection
