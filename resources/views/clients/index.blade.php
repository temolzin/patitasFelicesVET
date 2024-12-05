@extends('adminlte::page')

@section('title', 'PatitasFelices | Clientes')

@section('content')
    <section class="content">
        <div class="right_col" role="main">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Clientes</h2>
                        <div class="row">
                            <div class="col-lg-12 text-right">
                                <button class="btn btn-success" data-toggle='modal' data-target="#create"> <i
                                        class="fa fa-edit"></i> Registrar Cliente</button>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <table id="clients" class="table table-striped display responsive nowrap"
                                        style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>NOMBRE</th>
                                                <th>APELLIDO</th>
                                                <th>TELÉFONO</th>
                                                <th>CORREO</th>
                                                <th>CIUDAD</th>
                                                <th>MASCOTAS</th>
                                                <th>OPCIONES</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($clients) <= 0)
                                                <tr>
                                                    <td colspan="8">No hay resultados</td>
                                                </tr>
                                            @else
                                                @foreach ($clients as $client)
                                                    <tr>
                                                        <td scope="row">{{ $client->id }}</td>
                                                        <td>{{ $client->name }}</td>
                                                        <td>{{ $client->last_name }}</td>
                                                        <td>{{ $client->phone }}</td>
                                                        <td>{{ $client->email }}</td>
                                                        <td>{{ $client->city }}</td>
                                                        <td>{{ $client->animal->name }}</td>
                                                        <td>
                                                            <div class="btn-group" role="group" aria-label="Opciones">
                                                                <button type="button" class="btn btn-info mr-2" data-toggle="modal" title="Ver Detalles" data-target="#view{{ $client->id }}">
                                                                    <i class="fas fa-eye"></i>
                                                                </button>
                                                                <button type="button" class="btn btn-warning mr-2" data-toggle="modal" title="Editar Datos" data-target="#edit{{ $client->id }}">
                                                                    <i class="fas fa-edit"></i>
                                                                </button>
                                                                <button type="button" class="btn btn-danger mr-2" data-toggle="modal" title="Eliminar Registro" data-target="#delete{{ $client->id }}">
                                                                    <i class="fas fa-trash-alt"></i>
                                                                </button>
                                                                <button type="button" class="btn btn-primary mr-2" title="Generar Reporte" onclick="window.location.href='{{ route('clients.report', Crypt::encrypt($client->id)) }}'">
                                                                    <i class="fas fa-file-alt"></i>
                                                                </button> 
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    @include('clients.show')
                                                    @include('clients.edit')
                                                    @include('clients.delete')
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                    @include('clients.create')
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
            $('#clients').DataTable({
                responsive: true,
                order:[0, 'desc'],
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

            var errorMessage = "{{ session('error') }}";
            if (errorMessage) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: errorMessage,
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
