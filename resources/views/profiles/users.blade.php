@extends('adminlte::page')

@section('title', 'PatitasFelices | Perfil Usuario')

@section('content')
    <div class="row">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Información del Perfil</h3>
                </div>
                <div class="card-body text-center">
                    <div class="profile-img-container">
                    <img src="{{ $user->getFirstMediaUrl('userGallery') ?: asset('img/avatardefault.png') }}" class="img-circle elevation-2" alt="User Image" style="width: 150px; height: 150px;">
                        <a href="#" class="btn btn-outline-primary btn-sm edit-profile-pic" data-toggle="modal" data-target="#editLogo{{ $user->id }}">
                            <i class="fas fa-camera"></i>
                        </a>
                    </div>
                    <hr>
                    <form id="profile-form" action="{{ route('user.update', ['id' => $user->id]) }}" method="POST" style="display: none;">
                        @csrf
                        @method('PUT')
                        <div class="row mb-2">
                            <strong class="col-sm-4">Nombre:</strong>
                            <div class="col-sm-8"><input type="text" name="name" class="form-control" value="{{ $user->name }}"></div>
                        </div>
                        <div class="row mb-2">
                            <strong class="col-sm-4">Apellidos:</strong>
                            <div class="col-sm-8"><input type="text" name="last_name" class="form-control" value="{{ $user->last_name }}"></div>
                        </div>
                        <div class="row mb-2">
                            <strong class="col-sm-4">Correo Electrónico:</strong>
                            <div class="col-sm-8"><input type="email" name="email" class="form-control" value="{{ $user->email }}"></div>
                        </div>
                        <div class="row mb-2">
                            <strong class="col-sm-4">Teléfono:</strong>
                            <div class="col-sm-8"><input type="text" name="phone" class="form-control" value="{{ $user->phone }}"></div>
                        </div>
                        <div class="row mb-2">
                            <strong class="col-sm-4">Rol:</strong>
                            <div class="col-sm-8"><input type="text" class="form-control" value="{{ $user->roles->first()->name }}" disabled></div>
                        </div>
                        <button type="submit" class="btn btn-success">Guardar Cambios</button>
                        <button type="button" class="btn btn-secondary" id="cancel-edit">Cancelar</button>
                    </form>
                    <div id="profile-data" style="display: block;">
                        <div class="row mb-2">
                            <strong class="col-sm-4">Nombre:</strong>
                            <div class="col-sm-8">{{ $user->name }}</div>
                        </div>
                        <div class="row mb-2">
                            <strong class="col-sm-4">Apellidos:</strong>
                            <div class="col-sm-8">{{ $user->last_name }}</div>
                        </div>
                        <div class="row mb-2">
                            <strong class="col-sm-4">Correo Electrónico:</strong>
                            <div class="col-sm-8">{{ $user->email }}</div>
                        </div>
                        <div class="row mb-1">
                            <strong class="col-sm-4">Teléfono:</strong>
                            <div class="col-sm-8">{{ $user->phone }}</div>
                        </div>
                        <div class="row mb-2">
                            <strong class="col-sm-4">Rol:</strong>
                            <div class="col-sm-8">{{ $user->roles->first()->name }}</div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary" id="edit-profile">Editar Perfil</button>
                    <button class="btn btn-warning" id="change-password" data-toggle="modal" data-target="#changePasswordModal">Cambiar Contraseña</button>
                </div>
            </div>
        </div>

        <div class="col-md-7">
            @if($user->hasRole('admin'))
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Información Adicional del Administrador</h3>
                    </div>
                    <div class="card-body">
                        <p>Aquí puedes incluir información relevante para el administrador.</p>
                    </div>
                    
            @elseif($user->hasRole('vet'))
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Información de la Veterinaria</h3>
                    </div>
                    <div class="card-body text-center">
                    <div class="profile-img-container">
                    <img src="{{ $user->getFirstMediaUrl('vetGallery') ?: asset('img/vetdefault.png') }}" class="img-circle elevation-2" alt="Vet Image" style="width: 150px; height: 150px;">
                        <a href="#" class="btn btn-outline-primary btn-sm edit-profile-pic" data-toggle="modal" data-target="#editLogoVet{{ $user->id }}">
                            <i class="fas fa-camera"></i>
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="row mb-2">
                            <strong class="col-sm-4">Nombre de la Veterinaria:</strong>
                            <span class="col-sm-8">{{ $vet->name }}</span>
                        </div>
                        <div class="row mb-2">
                            <strong class="col-sm-4">Teléfono:</strong>
                            <span class="col-sm-8">{{ $vet->phone }}</span>
                        </div>
                        <div class="row mb-2">
                            <strong class="col-sm-4">Facebook:</strong>
                            <span class="col-sm-8">{{ $vet->facebook }}</span>
                        </div>
                        <div class="row mb-2">
                            <strong class="col-sm-4">TikTok:</strong>
                            <span class="col-sm-8">{{ $vet->tiktok }}</span>
                        </div>
                        <div class="row mb-2">
                            <strong class="col-sm-4">Estado:</strong>
                            <span class="col-sm-8">{{ $vet->state }}</span>
                        </div>
                        <div class="row mb-2">
                            <strong class="col-sm-4">Ciudad:</strong>
                            <span class="col-sm-8">{{ $vet->city }}</span>
                        </div>
                        <div class="row mb-2">
                            <strong class="col-sm-4">Colonia:</strong>
                            <span class="col-sm-8">{{ $vet->colony }}</span>
                        </div>
                        <div class="row mb-2">
                            <strong class="col-sm-4">Dirección:</strong>
                            <span class="col-sm-8">{{ $vet->address }}</span>
                        </div>
                        <div class="row mb-2">
                            <strong class="col-sm-4">Código Postal:</strong>
                            <span class="col-sm-8">{{ $vet->postal_code }}</span>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <div class="modal fade" id="editLogo{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="card-warning">
                <div class="card-header">
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <h4 class="card-title">Actualizar tu imagen de Perfil</h4>
                        <button type="button" class="close d-sm-inline-block text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <form action="{{ route('user.updatePicture') }}" enctype="multipart/form-data" method="POST" id="edit-user-form">
                    @csrf
                    @method('POST')
                    <div class="card-body">
                        <div class="card">
                            <div class="card-header py-2 bg-secondary">
                                <h3 class="card-title">Imagen del Perfil</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-8 offset-lg-2">
                                        <div class="form-group text-center">
                                            <label for="photo-{{ $user->id }}" class="form-label"></label>
                                            <div class="image-preview-container" style="display: flex; justify-content: center; margin-bottom: 10px;">
                                                <img id="photo-preview-edit-{{ $user->id }}" 
                                                     src="{{ ($user->getFirstMediaUrl('userGallery')) ? $user->getFirstMediaUrl('userGallery') : asset('img/avatardefault.png') }}" 
                                                     alt="Foto Actual" 
                                                     style="width: 120px; height: 120px; border-radius: 50%; margin-bottom: 5px;">
                                            </div>
                                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                                            <input type="file" class="form-control" name="photo" id="photo-{{ $user->id }}" onchange="previewImageEdit(event, {{ $user->id }})">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editLogoVet{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabeli" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="card-warning">
                <div class="card-header">
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <h4 class="card-title">Actualizar la imagen del albergue</h4>
                        <button type="button" class="close d-sm-inline-block text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <form action="{{ route('user.updatePictureVet') }}" enctype="multipart/form-data" method="POST" id="edit-vet-form">
                    @csrf
                    @method('POST')
                    <div class="card-body">
                        <div class="card">
                            <div class="card-header py-2 bg-secondary">
                                <h3 class="card-title">Imagen del Albergue</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-8 offset-lg-2">
                                        <div class="form-group text-center">
                                            <label for="photo-{{ $user->id }}" class="form-label"></label>
                                            <div class="image-preview-container" style="display: flex; justify-content: center; margin-bottom: 10px;">
                                                <img id="photo-preview-vet-{{ $user->id }}" 
                                                     src="{{ $user->getFirstMediaUrl('vetGallery') ? $user->getFirstMediaUrl('vetGallery') : asset('img/vetdefault.png') }}" 
                                                     alt="Foto Actual" 
                                                     style="width: 120px; height: 120px; border-radius: 50%; margin-bottom: 5px;">
                                            </div>
                                            <input type="hidden" name="vet_id" value="{{ $user->id }}">
                                            <input type="file" class="form-control" name="photo" id="photo-{{ $user->id }}" onchange="previewImageEditVet(event, {{ $user->id }})">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="changePasswordModalLabel">Cambiar Contraseña</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="change-password-form" action="{{ route('user.changePassword') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="current_password">Contraseña Actual:</label>
                        <input type="password" name="current_password" class="form-control" id="current_password" placeholder="Ingrese su contraseña actual" required>
                    </div>
                    <div class="form-group">
                        <label for="new_password">Nueva Contraseña:</label>
                        <input type="password" name="new_password" class="form-control" id="new_password" placeholder="Ingrese una nueva contraseña" required>
                    </div>
                    <div class="form-group">
                        <label for="new_password_confirmation">Confirmar Nueva Contraseña:</label>
                        <input type="password" name="new_password_confirmation" class="form-control" id="new_password_confirmation" placeholder="Confirme su nueva contraseña" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('css/profiles/profile.css') }}">
@stop

@section('js')
    <script>
        document.getElementById('edit-profile').addEventListener('click', function() {
            document.getElementById('profile-data').style.display = 'none';
            document.getElementById('profile-form').style.display = 'block';
            this.style.display = 'none';
            document.getElementById('change-password').style.display = 'none';
        });

        document.getElementById('cancel-edit').addEventListener('click', function() {
            document.getElementById('profile-form').style.display = 'none';
            document.getElementById('profile-data').style.display = 'block';
            document.getElementById('edit-profile').style.display = 'block';
            document.getElementById('change-password').style.display = 'block';
        });
        
        function previewImageEdit(event, id)
        {
            var input = event.target;
            var reader = new FileReader();
            reader.onload = function() {
                var dataURL = reader.result;
                var output = document.getElementById('photo-preview-edit-' + id);
                output.src = dataURL;
                output.style.display = 'block';
            };
            reader.readAsDataURL(input.files[0]);
        }

        function previewImageEditVet(event, vetId)
        {
            var input = event.target;
            var reader = new FileReader();
            reader.onload = function() {
                var dataURL = reader.result;
                var output = document.getElementById('photo-preview-vet-' + vetId);
                output.src = dataURL;
                output.style.display = 'block';
            };
            reader.readAsDataURL(input.files[0]);
        }

        @if (session('password_success'))
            Swal.fire({
                title: 'Éxito',
                text:  "{{ session('password_success') }}",
                icon: 'success',
                confirmButtonText: 'Aceptar'
            });
        @endif

        @if ($errors->any())
            Swal.fire({
                title: 'Error',
                text:  "{{ $errors->first() }}",
                icon: 'error',
                confirmButtonText: 'Cerrar'
            });
        @endif

        @if (session('success') && session()->has('image_updated'))
        Swal.fire({
            title: 'Éxito',
            text:  "{{ session('success') }}",
            icon: 'success',
            confirmButtonText: 'Aceptar'
            });
        @endif

        @if (session('error') && session()->has('image_updated'))
        Swal.fire({
            title: 'Error',
            text:  "{{ session('error') }}",
            icon: 'error',
            confirmButtonText: 'Cerrar'
        });
        @endif

    </script>
@stop
