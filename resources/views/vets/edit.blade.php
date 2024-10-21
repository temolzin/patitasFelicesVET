<div class="modal fade" id="edit{{$vets->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="card-warning">
                <div class="card-header">
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <h4 class="card-title">Editar veterinaria<small> &nbsp;(*) Campos requeridos</small></h4>
                        <button type="button" class="close d-sm-inline-block text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <form action="{{route('vets.update', $vets->id)}}" method="post" enctype="multipart/form-data">
                    @csrf @method('PUT')
                    <div class="card-body">
                        <div class="card">
                            <div class="card-header py-2 bg-secondary">
                                <h3 class="card-title">Datos de la veterinaria</h3>
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
                                            <label for="logo" class="form-label"></label>
                                            <div class="image-preview-container" style="display: flex; justify-content: center; margin-bottom: 10px;">
                                                @if($vets->users->getFirstMediaUrl('vetGallery'))
                                                    <img id="logo-preview-edit-{{ $vets->id }}" src="{{ $vets->users->getFirstMediaUrl('vetGallery') }}" alt="Logo Actual" style="width: 120px; height: 120px; border-radius: 50%; margin-bottom: 20px;">
                                                @else
                                                    <img id="logo-preview-edit-{{ $vets->id }}" src="{{ asset('img/vetDefault.png') }}" style="width: 120px; height: 120px; border-radius: 50%; margin-bottom: 5px;">
                                                @endif
                                            </div>
                                            <input type="file" class="form-control @error('logo') is-invalid @enderror" name="logo" id="logo-edit-{{ $vets->id }}" aria-describedby="helpId" placeholder="" onchange="previewImageEdit(event, {{ $vets->id }})">
                                            @error('logo')
                                            <span class="invalid-feedback" style="margin-top: -5px;">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <ul style="list-style-type: none; padding-left: 0;">
                                            <li>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label for="user_id" class="form-label">Usuario(*)</label>
                                                            <select class="form-control select2 @error('user_id') is-invalid @enderror" name="user_id" id="user_id" required style="height: 43px;">
                                                                <option value="">Seleccione un refugio</option>
                                                                @foreach(App\Models\User::all() as $users)
                                                                <option value="{{ $users->id }}" {{ old('user_id', $vets->user_id ?? '') == $users->id ? 'selected' : '' }}>
                                                                    {{ $users->name }}
                                                                </option>
                                                                @endforeach
                                                            </select>
                                                            @error('user_id')
                                                            <span class="invalid-feedback">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label for="name" class="form-label">Nombre(*)</label>
                                                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" aria-describedby="helpId" placeholder="" value="{{$vets->name}}" required />
                                                            @error('name')
                                                            <span class="invalid-feedback">
                                                                <strong>{{$message}}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label for="phone" class="form-label">Teléfono(*)</label>
                                                            <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone" aria-describedby="helpId" placeholder="" value="{{ $vets->phone }}" required />
                                                            @error('phone')
                                                            <span class="invalid-feedback">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label for="facebook" class="form-label">Facebook(*)</label>
                                                            <input type="text" class="form-control @error('facebook') is-invalid @enderror" name="facebook" id="facebook" aria-describedby="helpId" placeholder="" value="{{ $vets->facebook }}" required />
                                                            @error('facebook')
                                                            <span class="invalid-feedback">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label for="tiktok" class="form-label">Tiktok(*)</label>
                                                            <input type="text" class="form-control @error('tiktok') is-invalid @enderror" name="tiktok" id="tiktok" aria-describedby="helpId" placeholder="" value="{{ $vets->tiktok }}" required />
                                                            @error('tiktok')
                                                            <span class="invalid-feedback">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label for="state" class="form-label">Estado(*)</label>
                                                            <input type="text" class="form-control @error('state') is-invalid @enderror" name="state" id="state" aria-describedby="helpId" placeholder="" value="{{ $vets->state }}" required />
                                                            @error('state')
                                                            <span class="invalid-feedback">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label for="city" class="form-label">Ciudad(*)</label>
                                                            <input type="text" class="form-control @error('city') is-invalid @enderror" name="city" id="city" aria-describedby="helpId" placeholder="" value="{{ $vets->city }}" required />
                                                            @error('city')
                                                            <span class="invalid-feedback">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label for="colony" class="form-label">Colonia(*)</label>
                                                            <input type="text" class="form-control @error('colony') is-invalid @enderror" name="colony" id="colony" aria-describedby="helpId" placeholder="" value="{{ $vets->colony }}" required />
                                                            @error('colony')
                                                            <span class="invalid-feedback">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label for="address" class="form-label">Dirección(*)</label>
                                                            <input type="text" class="form-control @error('address') is-invalid @enderror" name="address" id="address" aria-describedby="helpId" placeholder="" value="{{ $vets->address }}" required />
                                                            @error('address')
                                                            <span class="invalid-feedback">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label for="postal_code" class="form-label">Código Postal(*)</label>
                                                            <input type="text" class="form-control @error('postal_code') is-invalid @enderror" name="postal_code" id="postal_code" aria-describedby="helpId" placeholder="" value="{{ $vets->postal_code }}" required />
                                                            @error('postal_code')
                                                            <span class="invalid-feedback">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
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
    function previewImageEdit(event, id) {
        var input = event.target;
        var reader = new FileReader();
        reader.onload = function() {
            var dataURL = reader.result;
            var output = document.getElementById('logo-preview-edit-' + id);
            output.src = dataURL;
            output.style.display = 'block';
        };
        reader.readAsDataURL(input.files[0]);
    }
</script>
