@extends('adminlte::page')
@section('title', 'PatitasFelices | Usuario')
@section('content')
<section class="content">
    <div class="right_col" role="main">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Usuarios</h2>
                    <div class="row">
                        <div class="col-lg-12 text-right">
                            <button class="btn btn-success" data-toggle='modal' data-target="#create"> <i
                                    class="fa fa-edit"></i> Registrar Usuario
                            </button>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box table-responsive">
                                <table id="users" class="table table-striped display responsive nowrap" style="width:100%">
                            <thead>
                                <tr>
                                            <th>ID</th>
                                            <th>FOTO</th>
                                            <th>NOMBRE</th>
                                            <th>APELLIDO </th>
                                            <th>TELEFONO</th>
                                            <th>EMAIL</th>
                                            <th>OPCIONES</th>
                                        </tr>
                                </thead>
                                    <tbody>
                                        @if(count($users) <= 0)
                                        <tr>
                                            <td colspan="8">No hay resultados</td>
                                        </tr>
                                        @else
                                        @foreach($users as $users)
                                        <tr>
                                            <td scope="row">{{$users->id}}</td>
                                            <td>                                          
                                                @if($users->getMedia('userGallery')->isNotEmpty())
                                                @php
                                                $photo = $users->getFirstMedia('userGallery');
                                                @endphp
                                                <img src="{{ $photo->getUrl() }}" alt="photo not found" style="width: 50px; height: 50px; border-radius: 50%;" > 
                                                @else
                                                <img src="{{ asset('img/avatardefault.png') }}" style="width: 50px; height: 50px; border-radius: 50%;">
                                                @endif                                                                                                    
                                            </td>
                                            <td>{{$users->name}}</td>
                                            <td>{{$users->last_name}}</td>
                                            <td>{{$users->phone}}</td>
                                            <td>{{$users->email}}</td>
                                            <td>
                                            <div class="btn-group" role="group" aria-label="Opciones">
                                                <button type="button" class="btn btn-info mr-2" data-toggle="modal" title="Ver Detalles" data-target="#view{{$users->id}}">
                                                    <i class="fas fa-eye"></i>
                                                <button type="button" class="btn btn-warning mr-2" data-toggle="modal" title="Editar Datos" data-target="#edit{{$users->id}}">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                @if($users->hasDependencies())
                                                    <button type="button" class="btn btn-secondary mr-2" title="No se puede eliminar registro: Contiene dependencias." disabled>
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                @else
                                                    <button type="button" class="btn btn-danger mr-2" data-toggle="modal" title="Eliminar Registro" data-target="#delete{{$users->id}}">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                @endif
                                                <button type="button" class="btn btn-primary mr-2" data-toggle="modal" title="Cambiar Contraseña"  data-target="#updatePassword{{$users->id}}">
                                                    <i class="fas fa-lock"></i>
                                                </button>
                                            </td>
                                            @include('users.updatePassword')
                                            @include('users.delete')
                                        </tr>
                                        @include('users.ver')
                                        @include('users.info')
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                                @include('users.create')
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
            $('#users').DataTable({
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
            @if ($errors->any())
            @foreach ($errors->all() as $error)
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '{{ $error }}',
                confirmButtonText: 'Aceptar'
            });
            @endforeach
            @endif
            
            $('#create').on('shown.bs.modal', function () {
                ('userForm', false);
                $('.select2').select2({
                    dropdownParent: $('#create')
                });
            });
            $('#edit').on('shown.bs.modal', function () {
                ('userForm', false);
                $('.select2').select2({
                    dropdownParent: $('#edit')
                });
            });
            $('#userForm input').on('input', function() {
                checkForm('userForm', false); // No es edición en este caso
            });
        });
    </script>
@endsection
