@extends('adminlte::page')

@section('title', 'PatitasFelices | Especies')

@section('content')
<section class="content">
    <div class="right_col" role="main">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Especies</h2>
                    <div class="row">
                        <div class="col-lg-12 text-right">
                            <button class="btn btn-success" data-toggle='modal' data-target="#create"> <i
                                    class="fa fa-edit"></i> Registrar Especie
                            </button>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box table-responsive">
                                <table id="species" class="table table-striped display responsive nowrap" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>NOMBRE</th>
                                            <th>DESCRIPCIÓN</th>
                                            <th>OPCIONES</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($species) <= 0)
                                        <tr>
                                            <td colspan="4">No hay resultados</td>
                                        </tr>
                                        @else
                                        @foreach($species as $species)
                                        <tr>
                                            <td scope="row">{{$species->id}}</td>
                                            <td>{{$species->name}}</td>
                                            <td>{{$species->description}}</td>
                                            <td>
                                                <div class="btn-group" role="group" aria-label="Opciones">
                                                    <button type="button" class="btn btn-info mr-2" data-toggle="modal" title="Ver Detalles" data-target="#view{{$species->id}}">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-warning mr-2" data-toggle="modal" title="Editar Datos" data-target="#edit{{$species->id}}">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    @if($species->hasDependencies())
                                                        <button type="button" class="btn btn-secondary mr-2" title="Eliminación no permitida: Existen datos relacionados con este registro." disabled>
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    @else
                                                        <button type="button" class="btn btn-danger mr-2" data-toggle="modal" title="Eliminar Registro" data-target="#delete{{ $species->id }}">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    @endif
                                                </div>
                                            </td>
                                            @include('species.delete')
                                        </tr>
                                        @include('species.ver')
                                        @include('species.info')
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                                @include('species.create')
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
        $('#species').DataTable({
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

        function checkForm(formId, isEdit) {
            var formIsValid = true;
            $('#' + formId + ' input[required]').each(function() {
                if (isEdit && $(this).attr('name') === 'password') {
                    return true; 
                }
                if ($(this).val() === '') {
                    formIsValid = false;
                    return false;
                }
            });
            $('#save' + formId + ' #edit').prop('disabled', !formIsValid);
            if (!formIsValid) {
                toastr.error('Por favor, completa todos los campos obligatorios.');
            }
        }

        $('#createModal').on('shown.bs.modal', function () {
            checkForm('userForm', false);
        });

        $('#editModal').on('shown.bs.modal', function () {
            checkForm('userForm', true);
        });

        $('#userForm input').on('input', function() {
            checkForm('userForm', false); 
        });
    });
</script>
@endsection
