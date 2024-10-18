@extends('adminlte::page')

@section('title', 'PatitasFelices | Personal')

@section('content')
<section class="content">
    <div class="right_col" role="main">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Personal</h2>
                    <div class="row">
                        <div class="col-lg-12 text-right">
                            <button class="btn btn-success" data-toggle='modal' data-target="#create"> <i class="fa fa-edit"></i> Registrar Personal
                            </button>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box table-responsive">
                                <table id="staff" class="table table-striped display responsive nowrap" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>FOTO</th>
                                            <th>NOMBRE COMPLETO</th>
                                            <th>TELEFONO</th>
                                            <th>OPCIONES</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($vetMember) <= 0) <tr>
                                            <td colspan="4">No hay resultados</td>
                                            </tr>
                                            @else
                                            @foreach($vetMember as $vetMember)
                                            <tr>
                                                <td scope="row">{{$vetMember->id}}</td>
                                                <td>
                                                    @if($vetMember->getMedia('photos')->isNotEmpty())
                                                    @php
                                                    $photo = $vetMember->getFirstMedia('photos');
                                                    @endphp
                                                    <img src="{{ $photo->getUrl() }}" alt="Photo not found" style="width: 50px; height: 50px; border-radius: 50%;">
                                                    @else
                                                    <img src="{{ asset('img/avatardefault.png') }}" style="width: 50px; height: 50px; border-radius: 50%;">
                                                    @endif
                                                </td>
                                                <td>{{$vetMember->name}} {{$vetMember->last_name}} </td>
                                                <td>{{$vetMember->phone}}</td>
                                                <td>
                                                    <div class="btn-group" role="group" aria-label="Opciones">
                                                        <button type="button" class="btn btn-info mr-2" data-toggle="modal" title="Ver Detalles" data-target="#view{{$vetMember->id}}">
                                                            <i class="fas fa-eye"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-warning mr-2" data-toggle="modal" title="Editar Datos" data-target="#edit{{$vetMember->id}}">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        @if($vetMember->hasDependencies())
                                                            <button type="button" class="btn btn-secondary mr-2" title="Eliminación no permitida: Existen datos relacionados con este registro." disabled>
                                                                <i class="fas fa-trash-alt"></i>
                                                            </button>
                                                        @else
                                                            <button type="button" class="btn btn-danger mr-2" data-toggle="modal" title="Eliminar Registro" data-target="#delete{{ $vetMember->id }}">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </button>
                                                        @endif
                                                    </div>
                                                </td>
                                                @include('vetMembers.delete')
                                            </tr>
                                            @include('vetMembers.view')
                                            @include('vetMembers.info')
                                            @endforeach
                                            @endif
                                    </tbody>
                                    @include('vetMembers.create')
                                </table>
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
        $('#staff').DataTable({
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

    });
</script>
@endsection
