@extends('adminlte::page')

@section('title', 'PatitasFelices | Fallecimientos')

@section('content')
    <section class="content">
        <div class="right_col" role="main">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Fallecimientos</h2>
                        <div class="row">
                            <div class="col-lg-12 text-right">
                                <button class="btn btn-success" data-toggle='modal' data-target="#create"> <i
                                        class="fa fa-edit"></i> Registrar Fallecimiento</button>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <table id="deaths" class="table table-striped display responsive nowrap"
                                        style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>FOTO</th>
                                                <th>NOMBRE</th>
                                                <th>FECHA</th>
                                                <th>CAUSA</th>
                                                <th>OPCIONES</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($deaths) <= 0)
                                                <tr>
                                                    <td colspan="6">No hay resultados</td>
                                                </tr>
                                            @else
                                                @foreach ($deaths as $death)
                                                    <tr>
                                                        <td scope="row">{{ $death->death_id }}</td>
                                                        <td>
                                                            @if ($death->animal->getFirstMediaUrl('animalGallery'))
                                                                <img src="{{ $death->animal->getFirstMediaUrl('animalGallery') }}"
                                                                    alt="Foto de {{ $death->animal->name }}"
                                                                    style="width: 50px; height: 50px; border-radius: 50%;">
                                                            @else
                                                                <img src="{{ asset('img/animaldefault.png') }}"
                                                                    style="width: 50px; height: 50px; border-radius: 50%;">
                                                            @endif
                                                        </td>
                                                        <td>{{ $death->animal->name }}</td>
                                                        <td>{{ $death->date }}</td>
                                                        <td>{{ $death->cause }}</td>
                                                        <td>
                                                            <div class="btn-group" role="group" aria-label="Opciones">
                                                                <button type="button" class="btn btn-info mr-2" data-toggle="modal"title="Ver Detalles" data-target="#view{{ $death->death_id }}">
                                                                    <i class="fas fa-eye"></i>
                                                                </button>
                                                                <button type="button" class="btn btn-warning mr-2" data-toggle="modal" title="Editar Datos" data-target="#edit{{ $death->death_id }}">
                                                                    <i class="fas fa-edit"></i>
                                                                </button>
                                                                @if($death->hasDependencies())
                                                                    <button type="button" class="btn btn-secondary mr-2" title="Eliminación no permitida: Existen datos relacionados con este registro." disabled>
                                                                        <i class="fas fa-trash-alt"></i>
                                                                    </button>
                                                                @else
                                                                    <button type="button" class="btn btn-danger mr-2" data-toggle="modal" title="Eliminar Registro" data-target="#delete{{ $death->death_id }}">
                                                                        <i class="fas fa-trash-alt"></i>
                                                                    </button>
                                                                @endif
                                                                @include('deaths.delete')
                                                        </td>
                                                    </tr>
                                                    @include('deaths.ver')
                                                    @include('deaths.info')
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                    @include('deaths.create')
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
            $('#deaths').DataTable({
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
