@extends('adminlte::page')

@section('title', 'PatitasFelices | Vacunas')

@section('content')
<section class="content">
    <div class="right_col" role="main">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Vacunas</h2>
                    <div class="row">
                        <div class="col-lg-12 text-right">
                            <button class="btn btn-success" data-toggle='modal' data-target="#create"> <i
                                    class="fa fa-edit"></i> Registrar Vacuna
                            </button>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box table-responsive">
                                <table id="vaccines" class="table table-striped display responsive nowrap" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>NOMBRE</th>
                                            <th>TIPO</th>
                                            <th>OPCIONES</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($vaccines) <= 0)
                                        <tr>
                                            <td colspan="8">No hay resultados</td>
                                        </tr>
                                        @else
                                        @foreach($vaccines as $vaccines)
                                        <tr>
                                            <td scope="row">{{$vaccines->vaccine_id}}</td>
                                            <td>{{$vaccines->name}}</td>
                                            <td>{{$vaccines->type}}</td>
                                            <td>
                                                <div class="btn-group" role="group" aria-label="Opciones">
                                                    <button type="button" class="btn btn-info mr-2" data-toggle="modal" title="Ver Detalles" data-target="#view{{$vaccines->vaccine_id}}">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-warning mr-2" data-toggle="modal" title="Editar Datos" data-target="#edit{{$vaccines->vaccine_id}}">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    @if($vaccines->exists())
                                                        <button type="button" class="btn btn-secondary mr-2" title="Eliminación no permitida: Existen datos relacionados con esta vacuna." disabled>
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    @else
                                                        <button type="button" class="btn btn-danger" data-toggle="modal" title="Eliminar Registro" data-target="#delete{{$vaccines->vaccine_id}}">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    @endif
                                                @include('vaccines.delete')
                                            </td>
                                        </tr>
                                        @include('vaccines.ver')
                                        @include('vaccines.info')
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                                @include('vaccines.create')
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
            $('#vaccines').DataTable({
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
                    // Excluye la validación de la contraseña solo en el modal de edición
                    if (isEdit && $(this).attr('name') === 'password') {
                        return true; // Continuar con la iteración
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
                checkForm('userForm', false); // No es edición en este caso
            });
        });
    </script>
@endsection
