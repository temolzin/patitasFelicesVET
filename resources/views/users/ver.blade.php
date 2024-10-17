<div class="modal fade" id="view{{ $users->id }}" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel{{ $users->id }}" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="card-info">
        <div class="card-header">
          <div class="d-sm-flex align-items-center justify-content-between">
            <h4 class="card-title">Información del Usuario </h4>
            <button type="button" class="close d-sm-inline-block text-white" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        </div>
        <div class="modal-body">
          <div class="card">
            <div class="card-header py-2 bg-secondary">
              <h3 class="card-title">Datos del Usuario</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-lg-12">
                  <div class="image-preview-container" style="display: flex; justify-content: center;">
                      @if($users->getMedia('photo')->isNotEmpty())
                          <img src="{{ $users->getFirstMedia('photo')->getUrl() }}" alt="{{ $users->name }}" class="img-fluid" 
                          style="width: 120px; height: 120px; border-radius: 60%;" />
                      @else
                          <img src="{{ asset('img/avatardefault.png') }}" style="width: 120px; height: 120px; border-radius: 50%;">
                      @endif
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="form-group">
                    <label>ID</label>
                    <input type="text" disabled class="form-control" value="{{ $users->id }}" />
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="form-group">
                    <label>Nombre</label>
                    <input type="text" disabled class="form-control" value="{{ $users->name }}" />
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="form-group">
                    <label>Apellido</label>
                    <input type="text" disabled class="form-control" value="{{ $users->last_name }}" />
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="form-group">
                    <label>Teléfono</label>
                    <input type="text" disabled class="form-control" value="{{ $users->phone }}" />
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="form-group">
                    <label>Email</label>
                    <input type="text" disabled class="form-control" value="{{ $users->email }}" />
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="form-group">
                    <label>Rol</label>
                    <input type="text" disabled class="form-control" value="{{ $users->roles->first()->name ?? 'Sin rol asignado'}}" />
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
</div>
