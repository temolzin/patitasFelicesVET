@extends('adminlte::page')

@section('title', 'PatitasFelices | Dashboard')

@section('plugins.Fullcalendar', true)

@section('content')
    <section class="content">
        <div class="right_col" role="main">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    @if ($role->name === 'shelter')
                        <div class="row">
                            <div class="container-fluid">
                                <div class="card-box head">
                                    <div class="row align-items-center">
                                        <div class="col-md-2 text-center">
                                        @if ($user->getFirstMediaUrl('userGallery'))
                                            <img src="{{ $user->getFirstMediaUrl('userGallery') }}"
                                                alt="Foto de {{ $user->name }}">
                                        @else
                                            <img src="{{ asset('img/avatardefault.png') }}">
                                        @endif
                                        </div>
                                        <div class="col-md-8">
                                            <h4 class="font-weight-bold text-capitalize welcome">Bienvenid@</h4>
                                            <h1 class="font-weight-bold text-blue">{{ $user->name }} {{ $user->last_name }}</h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            @php
                                $totalAnimals = $animals->count();
                                $totalAppointments = $vetAppointments->count();
                            @endphp
                            <div class="col-lg-3 col-xs-6">
                                <div class="small-box bg-info">
                                    <div class="inner">
                                        <h3>{{ $totalAnimals }}</h3>
                                        <p>Mascotas</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-dog"></i>
                                    </div>
                                    <a href="{{ route('animals.index') }}" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-xs-6">
                                <div class="small-box bg-green">
                                    <div class="inner">
                                        <h3>{{ $totalSponsorship}}</h3>
                                        <p>Mascotas Apadrinadas</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-dollar fa-fw"></i>
                                    </div>
                                    <a href="{{ route('shelterMembers.godfather') }}" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-xs-6">
                                <div class="small-box bg-yellow">
                                    <div class="inner">
                                        <h3>{{ $totalAdoptions }}</h3>
                                        <p>Mascotas adoptadas</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-hand-holding-heart fa-fw"></i>
                                    </div>
                                    <a href="{{ route('shelterMembers.adopter') }}" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-xs-6">
                                <div class="small-box bg-red">
                                    <div class="inner">
                                        <h3>{{ $totalAppointments }}</h3>
                                        <p>Citas Veterinarias</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <a href="{{ route('vetAppointments.index') }}" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 mt-3 mb-3">
                                <div id="calendar"></div>
                            </div>
                        </div>
                    @else
                        <section class="content">
                            @php
                                $totalShelters = $shelters->count();
                                $totalUsers = $users->count();
                            @endphp
                            <div class="row">
                                <div class="container-fluid">
                                    <div class="card-box head">
                                        <div class="row align-items-center">
                                            <div class="col-md-2 text-center">
                                                @if ($user->getFirstMediaUrl('userGallery'))
                                                <img src="{{ $user->getFirstMediaUrl('userGallery') }}"
                                                    alt="Foto de {{ $user->name }}">
                                                @else
                                                <img src="{{ asset('img/avatarDefault.png') }}">
                                                @endif
                                            </div>
                                            <div class="col-md-8">
                                                <h4 class="font-weight-bold text-capitalize welcome">Bienvenid@</h4>
                                                <h1 class="font-weight-bold text-blue" style="font-size: 30px;">{{ $user->name }} {{ $user->last_name }}</h1>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-4 col-xs-6 p-1">
                                    <div class="small-box bg-info">
                                        <div class="inner">
                                            <h3>{{ $totalUsers }}</h3>
                                            <p>Usuarios</p>
                                        </div>
                                        <div class="icon">
                                            <i class="fas fa-fw fa-users"></i>
                                        </div>
                                        <a href="{{ route('users.index') }}" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-xs-6 p-1">
                                    <div class="small-box bg-success">
                                        <div class="inner">
                                            <h3>{{ $totalShelters }}</h3>
                                            <p>Albergues</p>
                                        </div>
                                        <div class="icon">
                                            <i class="fa fa-home"></i>
                                        </div>
                                        <a href="{{ route('shelters.index') }}" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-xs-6 p-1">
                                    <div class="small-box bg-danger">
                                        <div class="inner">
                                            <h3>{{ $totalRoles }}</h3>
                                            <p>Roles</p>
                                        </div>
                                        <div class="icon">
                                            <i class="fas fa-key"></i>
                                        </div>
                                        <a href="{{ route('roles.index') }}" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 p-1">
                                    <div class="card">
                                        <div class="card-header" style="background-color:#0d574c; color:white;">
                                            <h3 class="card-title">Albergues</h3>
                                            <div class="card-tools">
                                                <span class="badge badge-dark">Últimos registros</span>
                                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="card-body p-1">
                                            <ul id="listShelters" class="users-list clearfix">
                                            @foreach ($shelters as $shelter)
                                            <li class="p-1">
                                                @php
                                                    $logo = $shelter->users->getFirstMedia('shelterGallery');
                                                @endphp
                                                @if ($logo)
                                                    <img src="{{ $logo->getUrl() }}" 
                                                    alt="Logo de {{ $shelter->users->name }}" 
                                                    class="rounded-circle img-fluid" style="width: 120px; height: 120px;">
                                                @else
                                                    <img src="{{ asset('img/shelterdefault.png') }}" 
                                                    class="rounded-circle img-fluid" style="width: 120px; height: 120px;">
                                                @endif
                                                <a class="users-list-name">{{ $shelter->name }}</a>
                                            </li>
                                            @endforeach
                                            </ul>
                                        </div>
                                        <div class="card-footer text-center">
                                            <a href="{{ route('shelters.index') }}">Ver Todos</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 p-1">
                                    <div class="card card-success">
                                        <div class="card-header" style="background-color:#471866; color:white;">
                                            <h3 class="card-title">Usuarios</h3>
                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="card-body p-1">
                                            <table id="users" class="table table-striped display responsive nowrap" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>Nombre</th>
                                                        <th>Apellido</th>
                                                        <th>Email</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($users as $key => $user)
                                                        @if ($key < 4)
                                                            <tr>
                                                                <td>{{ $user->name }}</td>
                                                                <td>{{ $user->last_name }}</td>
                                                                <td>{{ $user->email }}</td>
                                                            </tr>
                                                        @else
                                                            @break
                                                        @endif
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="card-footer text-center">
                                            <a href="{{ route('users.index') }}">Ver Todos</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    @endif
                </div>
            </div>
        </div>
    </section>
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('css/dashboard/dashboard.css') }}">
@stop

@section('js')
    <script>
        $(document).ready(function() {
            $('#users').DataTable({
                order:[0, 'desc'],
                responsive: true,
                dom: 'r',
            });

            var appointments = @json($appointments);
            var newAppointmentUrl = '{{ route('vetAppointments.index') }}';

            $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today newAppointmentButton',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                customButtons: {
                    newAppointmentButton: {
                        text: 'Nueva Cita',
                        click: function() {
                            window.location.href = newAppointmentUrl;
                        }
                    }
                },
                events: appointments
            });
        });
    </script>
@stop
