<!-- Modal de Edición -->
<div class="modal fade" id="edit{{$shelterMember->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="card-warning">
                <div class="card-header">
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <h4 class="card-title">Editar miembro<small> &nbsp;(*) Campos requeridos</small></h4>
                        <button type="button" class="close d-sm-inline-block text-white" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                </div>
                <form action="{{route('shelterMember.update', $shelterMember->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="card">
                            <div class="card-header py-2 bg-secondary">
                                <h3 class="card-title">Datos del miembro</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fa fa-minus"></i></button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group text-center">
                                            <label for="photo" class="form-label"></label>
                                            <div class="photo-preview-container" style="display: flex; justify-content: center; margin-bottom: 10px;">
                                                @if($shelterMember->getFirstMediaUrl('photos'))
                                                <img id="photo-preview-edit-{{ $shelterMember->id }}" src="{{ $shelterMember->getFirstMediaUrl('photos') }}" alt="Foto Actual" style="width: 120px; height: 120px; border-radius: 50%; margin-bottom: 20px;">
                                                @else
                                                <img id="photo-preview-edit-{{ $shelterMember->id }}" src="{{ asset('img/avatardefault.png') }}" style="display: none; width: 120px; height: 120px; border-radius: 60%; object-fit: cover;">
                                                @endif
                                            </div>
                                            <input type="file" class="form-control @error('photo') is-invalid @enderror" name="photo" id="photo-edit-{{ $shelterMember->id }}" aria-describedby="helpId" placeholder=""  onchange="previewPhotoEdit(event, '{{ $shelterMember->id }}')">
                                            @error('photo')
                                            <span class="invalid-feedback" style="margin-top: -5px;">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="name" class="form-label">Nombre(*)</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" aria-describedby="helpId" placeholder="" value="{{$shelterMember->name}}" required />
                                            @error('name')
                                            <span class="invalid-feedback">
                                                <strong>{{$message}}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="last_name" class="form-label">Apellido(*)</label>
                                            <input type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" id="last_name" aria-describedby="helpId" placeholder="" value="{{$shelterMember->last_name}}" required />
                                            @error('last_name')
                                            <span class="invalid-feedback">
                                                <strong>{{$message}}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="phone" class="form-label">Teléfono(*)</label>
                                            <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone" aria-describedby="helpId" placeholder="" value="{{$shelterMember->phone}}" required />
                                            @error('phone')
                                            <span class="invalid-feedback">
                                                <strong>{{$message}}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="email" class="form-label">Correo(*)</label>
                                            <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" id="email" aria-describedby="helpId" placeholder="" value="{{$shelterMember->email}}" required />
                                            @error('email')
                                            <span class="invalid-feedback">
                                                <strong>{{$message}}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="state" class="form-label">Estado o Provincia(*)</label>
                                            <input type="text" class="form-control @error('state') is-invalid @enderror" name="state" id="state" aria-describedby="helpId" placeholder="" value="{{$shelterMember->state}}" required />
                                            @error('state')
                                            <span class="invalid-feedback">
                                                <strong>{{$message}}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="city" class="form-label">Ciudad(*)</label>
                                            <input type="text" class="form-control @error('city') is-invalid @enderror" name="city" id="city" aria-describedby="helpId" placeholder="" value="{{$shelterMember->city}}" required />
                                            @error('city')
                                            <span class="invalid-feedback">
                                                <strong>{{$message}}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="colony" class="form-label">Colonia(*)</label>
                                            <input type="text" class="form-control @error('colony') is-invalid @enderror" name="colony" id="colony" aria-describedby="helpId" placeholder="" value="{{$shelterMember->colony}}" required />
                                            @error('colony')
                                            <span class="invalid-feedback">
                                                <strong>{{$message}}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="address" class="form-label">Dirección(*)</label>
                                            <input type="text" class="form-control @error('address') is-invalid @enderror" name="address" id="address" aria-describedby="helpId" placeholder="" value="{{$shelterMember->address}}" required />
                                            @error('address')
                                            <span class="invalid-feedback">
                                                <strong>{{$message}}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="address" class="form-label">Codigo postal(*)</label>
                                            <input type="text" class="form-control @error('postal_code') is-invalid @enderror" name="postal_code" id="postal_code" aria-describedby="helpId" placeholder="" value="{{$shelterMember->postal_code}}" required />
                                            @error('postal_code')
                                            <span class="invalid-feedback">
                                                <strong>{{$message}}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="submit" id="edit" class="btn btn-warning">Actualizar</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function previewPhotoEdit(event, id) {
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
</script>
