@extends('adminlte::page')

@section('title', 'PatitasFelices | Albergues')

@section('content')
<section class="content">
    <div class="right_col" role="main">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Albergue</h2>
                    <div class="row">
                        <div class="col-lg-12 text-right">
                            <button class="btn btn-success" data-toggle='modal' data-target="#create"> <i class="fa fa-edit"></i> Registrar Albergue </button>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box table-responsive">
                                <table id="shelters" class="table table-striped display responsive nowrap" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>LOGO</th>
                                            <th>USUARIO</th>
                                            <th>NOMBRE</th>
                                            <th>TELÉFONO</th>
                                            <th>OPCIONES</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($shelters) <= 0)
                                        <tr>
                                            <td colspan="8">No hay resultados</td>
                                        </tr>
                                        @else
                                        @foreach($shelters as $shelters)
                                        <tr>
                                        <td scope="row">{{$shelters->id}}</td>
                                        <td>
                                            @if($shelters->users->getFirstMediaUrl('shelterGallery'))
                                                <img id="logo-preview-edit-{{ $shelters->id }}" src="{{ $shelters->users->getFirstMediaUrl('shelterGallery') }}" 
                                                alt="Logo Actual" 
                                                style="width: 50px; height: 50px; border-radius: 50%;">
                                            @else
                                                <img id="logo-preview-edit-{{ $shelters->id }}" src="{{ asset('img/shelterdefault.png') }}" 
                                                style="width: 50px; height: 50px; border-radius: 50%;">
                                            @endif                                                                                                   
                                        </td>
                                            <td>{{ $shelters->users->name }} {{ $shelters->users->last_name }}</td>
                                            <td>{{ $shelters->name }}</td>
                                            <td>{{ $shelters->phone }}</td>
                                            <td>
                                                <div class="btn-group" role="group" aria-label="Opciones">
                                                    <button type="button" class="btn btn-info mr-2" data-toggle="modal" title="Ver Detalles"  data-target="#view{{$shelters->id}}">
                                                        <i class="fas fa-eye"></i>
                                                    <button type="button" class="btn btn-warning mr-2" data-toggle="modal" title="Editar Datos" data-target="#edit{{$shelters->id}}">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    @if($shelters->hasDependencies())
                                                        <button type="button" class="btn btn-secondary mr-2" title="Eliminación no permitida: Existen datos relacionados con este registro." disabled>
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    @else
                                                        <button type="button" class="btn btn-danger mr-2" data-toggle="modal" title="Eliminar Registro" data-target="#delete{{ $shelters->id }}">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    @endif
                                                </div>
                                            </td>
                                            @include('shelters.delete')
                                        </tr>
                                        @include('shelters.show')
                                        @include('shelters.edit')
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                                @include('shelters.create')
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
            $('#shelters').DataTable({
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
            $('#create').on('shown.bs.modal', function () {
                $('.select2').select2({
                    dropdownParent: $('#create')
                });
            });
            $('#edit').on('shown.bs.modal', function () {
                $('.select2').select2({
                    dropdownParent: $('#edit')
                });
            });
            $('#userForm input').on('input', function() {
                checkForm('userForm', false); 
            });
        });
    </script>
@endsection
