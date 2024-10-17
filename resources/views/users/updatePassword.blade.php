<div class="modal fade" id="updatePassword{{$users->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="card-primary">
            <div class="card-header">
                <div class="d-sm-flex align-items-center justify-content-between">
                    <h4 class="card-title">Cambiar Contraseña<small> &nbsp;(*) Campos requeridos</small></h4>
                    <button type="button" class="close d-sm-inline-block text-white" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            <form action="{{route('users.updatePassword', $users->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                  <div class="form-group">
                    <label for="new_password">Nueva Contraseña</label>
                    <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Ingresa tu nueva contraseña" required>
                  </div>
                  <div class="form-group">
                    <label for="confirm_password">Confirmar Nueva Contraseña</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirmar contraseña" required>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                  <button type="submit" class="btn btn-primary">Actualizar Contraseña</button>
                </div>
              </form>
        </div>
      </div>
    </div>
  </div>
</div>
