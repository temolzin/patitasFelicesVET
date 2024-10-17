@extends('adminlte::page')

@section('title', 'PatitasFelices | Citas Veterinarias')

@section('content')
<section class="content">
    <div class="right_col" role="main">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Citas Veterinarias</h2>
                    <div class="row">
                        <div class="col-lg-12 text-right">
                            <button class="btn btn-success" data-toggle='modal' data-target="#create"> 
                                <i class="fa fa-edit"></i> Agregar Cita Veterinaria </button>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box table-responsive">
                                <table id="vets" class="table table-striped display responsive nowrap"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>ANIMAL</th>
                                            <th>FECHA Y HORA DE LA CITA</th>
                                            <th>MOTIVO DE LA CITA</th>
                                            <th>OPCIONES</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($vets) <= 0)
                                            <tr>
                                                <td colspan="7">No hay resultados</td>
                                            </tr>
                                        @else
                                            @foreach($vets as $vet)
                                                <tr>
                                                    <td scope="row">{{$vet->id}}</td>
                                                    <td>{{ $vet->animal->name }}</td>
                                                    <td>{{ $vet->schedule_date }}</td>
                                                    <td>{{ $vet->reason }}</td>
                                                    <td>
                                                        <div class="btn-group" role="group" aria-label="Opciones">
                                                            <button type="button" class="btn btn-info mr-2" data-toggle="modal" title="Ver Detalles" data-target="#view{{$vet->id}}">
                                                                <i class="fas fa-eye"></i>
                                                            </button>
                                                            <button type="button" class="btn btn-warning mr-2" title="Editar Datos" data-toggle="modal" data-target="#edit{{$vet->id}}">
                                                                <i class="fas fa-edit"></i>
                                                            </button>
                                                            @if($vet->hasDependencies())
                                                                <button type="button" class="btn btn-secondary mr-2" title="Eliminación no permitida: Existen datos relacionados con esta cita." disabled>
                                                                    <i class="fas fa-trash-alt"></i>
                                                                </button>
                                                            @else
                                                                <button type="button" class="btn btn-danger" data-toggle="modal" title="Eliminar Registro" data-target="#delete{{$vet->id}}">
                                                                    <i class="fas fa-trash-alt"></i>
                                                                </button>
                                                            @endif
                                                        </div>
                                                    </td>
                                                    @include('vetAppointments.delete')
                                                </tr>
                                                @include('vetAppointments.show')
                                                @include('vetAppointments.edit')
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                                @include('vetAppointments.create')
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
    $(document).ready(function () {
        $('#vets').DataTable({
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
        $('#createModal').on('shown.bs.modal', function () {
            checkForm('userForm', false);
        });
        $('#editModal').on('shown.bs.modal', function () {
            checkForm('userForm', true);
        });
        $('#userForm input').on('input', function () {
            checkForm('userForm', false);
        });
    });

    $('#create').on('shown.bs.modal', function () {
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
