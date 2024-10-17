<div class="modal fade"  id="create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="card-success">
        <div class="card-header">
          <div class="d-sm-flex align-items-center justify-content-between">
            <h4 class="card-title">Agregar usuario <small> &nbsp;(*) Campos requeridos</small></h4>
            <button type="button" class="close d-sm-inline-block text-white" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        </div>
        <form action="{{ route('users.store') }}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="card-body">
            <div class="card">
              <div class="card-header py-2 bg-secondary">
                <h3 class="card-title">Datos del usuario</h3>
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
                        <div class="image-preview-container" style="display: flex; justify-content: center; margin-bottom: 10px;">
                            <img id="photo-preview" src="#" alt="Vista previa de la photo" style="display: none; width: 120px; height: 120px; border-radius: 60%; object-fit: cover;">
                        </div>
                        <input type="file" class="form-control @error('photo') is-invalid @enderror" name="photo" id="photo" aria-describedby="photoHelp" onchange="previewImage(event)" />
                        @error('photo')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                 </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label for="" class="form-label">Nombre(*)</label>
                      <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Ingresa nombre (s)" value="{{ old('name') }}" required/>
                      @error('name')
                      <span class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label for="" class="form-label">Apellido(*)</label>
                      <input type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" placeholder="Ingresa apellido(s)" value="{{ old('last_name') }}" required/>
                      @error('last_name')
                      <span class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label for="" class="form-label">Telefono(*)</label>
                      <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" placeholder="Ingresa numero de telefono" value="{{ old('phone') }}" required/>
                      @error('phone')
                      <span class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label for="" class="form-label">Email(*)</label>
                      <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Ingresa email" value="{{ old('email') }}" required/>
                      @error('email')
                      <span class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                        <label for="password" class="form-label">Contraseña(*)</label>
                        <div class="input-group">
                            <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Ingresa contraseña" required>
                            <div class="input-group-append">
                            </div>
                        </div>
                        @error('password')
                          <span class="invalid-feedback">
                             <strong>{{ $message }}</strong>
                          </span>
                         @enderror
                     </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                        <label for="role" class="form-label">Rol(*)</label>
                        <select id="role_id" class="form-control select2" name="role_id">
                            <option value="">Selecciona el rol</option>
                            @foreach($roles as $role)
                            <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>
                                {{$role->name}}
                            </option>
                            @endforeach
                        </select>
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
  function previewImage(event) {
      var input = event.target;
      var reader = new FileReader();
      reader.onload = function () {
          var dataURL = reader.result;
          var output = document.getElementById('photo-preview');
          output.src = dataURL;
          output.style.display = 'block';
      };
      reader.readAsDataURL(input.files[0]);
  }
</script>
<style>
  .select2-container .select2-selection--single {
      height: 40px;
      display: flex;
      align-items: center;
  }
</style>
