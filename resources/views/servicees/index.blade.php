@extends('adminlte::page')

@section('title', 'PatitasFelices | Servicios')

@section('content')
<section class="content">
    <div class="right_col" role="main">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Servicios</h2>
                    <div class="row">
                        <div class="col-lg-12 text-right">
                            <button class="btn btn-success" data-toggle='modal' data-target="#create"> <i
                                    class="fa fa-edit"></i> Registrar Servicio
                            </button>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box table-responsive">
                                <table id="services" class="table table-striped display responsive nowrap" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>NOMBRE</th>
                                            <th>COSTO</th>
                                            <th>DESCRIPCIÓN</th>
                                            <th>DISPONIBILIDAD</th>
                                            <th>DURACIÓN (min)</th>
                                            <th>OPCIONES</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($services) <= 0)
                                        <tr>
                                            <td colspan="7">No hay resultados</td>
                                        </tr>
                                        @else
                                        @foreach($services as $service)
                                        <tr>
                                            <td scope="row">{{$service->id}}</td>
                                            <td>{{$service->name}}</td>
                                            <td>{{$service->cost}}</td>
                                            <td>{{$service->description}}</td>
                                            <td>{{$service->availability}}</td>
                                            <td>{{$service->duration}}</td>
                                            <td>
                                                <div class="btn-group" role="group" aria-label="Opciones">
                                                    <button type="button" class="btn btn-info mr-2" data-toggle="modal" title="Ver Detalles" data-target="#view{{$service->id}}">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-warning mr-2" data-toggle="modal" title="Editar Datos" data-target="#edit{{$service->id}}">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    @if($service->exists())
                                                        <button type="button" class="btn btn-secondary mr-2" title="Eliminación no permitida: Existen datos relacionados con este servicio." disabled>
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    @else
                                                        <button type="button" class="btn btn-danger" data-toggle="modal" title="Eliminar Registro" data-target="#delete{{$service->id}}">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    @endif
                                                </div>
                                                @include('servicees.delete')
                                            </td>
                                        </tr>
                                        @include('servicees.edit')
                                        @include('servicees.show')
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                                @include('servicees.create')
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
        $('#services').DataTable({
            responsive: true,
            order: [0, 'desc'],
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
                window.location.href = "{{ route('services.index') }}";
            });
        }
        
        if (errorMessage) {
            Swal.fire({
                title: 'Error',
                text: errorMessage,
                icon: 'error',
                confirmButtonText: 'Aceptar'
            }).then((result) => {
                window.location.href = "{{ route('services.index') }}";
            });
        }
    });
</script>
@endsection
