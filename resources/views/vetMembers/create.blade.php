<div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="card-success">
                <div class="card-header">
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <h4 class="card-title">Agregar miembro <small> &nbsp;(*) Campos requeridos</small></h4>
                        <button type="button" class="close d-sm-inline-block text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <form action="{{ route('vetMember.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="type_member" value="{{ $typeMember }}">
                    <div class="card-body">
                        <div class="card">
                            <div class="card-header py-2 bg-secondary">
                                <h3 class="card-title">Datos del miembro</h3>
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
                                            <label for="photo" class="form-label"></label>
                                            <div class="photo-preview-container" style="display: flex; justify-content: center; margin-bottom: 10px;">
                                                <img id="photo-preview" src="#" alt="Vista previa de la foto" style="display: none; width: 120px; height: 120px; border-radius: 60%; object-fit: cover;">
                                            </div>
                                            <input type="file" class="form-control @error('photo') is-invalid @enderror" name="photo" id="photo" aria-describedby="photoHelp" onchange="previewPhoto(event)"/>
                                            @error('photo')
                                            <span class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="name" class="form-label">Nombre(*)</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Ingresa el nombre del miembro" value="{{ old('name') }}" required />
                                            @error('name')
                                            <span class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="last_name" class="form-label">Apellido(*)</label>
                                            <input type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" placeholder="Ingresa el apellido paterno del miembro" value="{{ old('last_name') }}" required />
                                            @error('last_name')
                                            <span class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="phone" class="form-label">Teléfono(*)</label>
                                            <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" placeholder="Ingresa número de teléfono" value="{{ old('phone') }}" required />
                                            @error('phone')
                                            <span class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="email" class="form-label">Correo(*)</label>
                                            <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Ingresa el correo" value="{{ old('email') }}" required />
                                            @error('email')
                                            <span class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="state" class="form-label">Estado o Provincia(*)</label>
                                            <input type="text" class="form-control @error('state') is-invalid @enderror" name="state" placeholder="Ingresa el estado o provincia" value="{{ old('state') }}" required />
                                            @error('state')
                                            <span class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="city" class="form-label">Ciudad(*)</label>
                                            <input type="text" class="form-control @error('city') is-invalid @enderror" name="city" placeholder="Ingresa la ciudad" value="{{ old('city') }}" required />
                                            @error('city')
                                            <span class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="colony" class="form-label">Colonia(*)</label>
                                            <input type="text" class="form-control @error('colony') is-invalid @enderror" name="colony" placeholder="Ingresa la colonia" value="{{ old('colony') }}" required />
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
                                            <input type="text" class="form-control @error('address') is-invalid @enderror" name="address" placeholder="Ingresa la dirección" value="{{ old('address') }}" required />
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
                                            <input type="text" class="form-control @error('postal_code') is-invalid @enderror" name="postal_code" placeholder="Ingresa el código postal" value="{{ old('postal_code') }}" required />
                                            @error('postal_code')
                                            <span class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" id="save" class="btn btn-success">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function previewPhoto(event) {
        var input = event.target;
        var reader = new FileReader();
        reader.onload = function() {
            var dataURL = reader.result;
            var output = document.getElementById('photo-preview');
            output.src = dataURL;
            output.style.display = 'block';
        };
        reader.readAsDataURL(input.files[0]);
    }
</script>
