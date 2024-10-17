<div class="modal fade" id="view{{ $shelters->id }}" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel{{ $shelters->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="card-info">
                <div class="card-header">
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <h4 class="card-title">Información del albergue</h4>
                        <button type="button" class="close d-sm-inline-block text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-header py-2 bg-secondary">
                            <h3 class="card-title">Datos del albergue</h3>
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
                                        @if($shelters->getFirstMediaUrl('shelterGallery'))
                                            <img id="logo-preview-edit-{{ $shelters->id }}" src="{{ $shelters->getFirstMediaUrl('shelterGallery') }}" 
                                            alt="Logo Actual" 
                                            style="width: 120px; height: 120px; border-radius: 50%;">
                                        @else
                                            <img src="{{ asset('img/shelterDefault.png') }}" style="width: 120px; height: 120px; border-radius: 50%;">
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label>ID</label>
                                        <input type="text" disabled class="form-control" value="{{ $shelters->id }}" />
                                    </div>
                                </div>
                                <div class="col-lg-5">
                                    <div class="form-group text-center">
                                        <label>Nombre</label>
                                        <input type="text" disabled class="form-control" value="{{ $shelters->name }}" style="width: 100%;" />
                                    </div>
                                </div>
                                <div class="col-lg-5">
                                    <div class="form-group">
                                        <label>Usuario</label>
                                        <input type="text" disabled class="form-control" value="{{ $shelters->users->name }} {{ $shelters->users->last_name }}" />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Teléfono</label>
                                        <input type="text" disabled class="form-control" value="{{ $shelters->phone }}" />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Facebook</label>
                                        <input type="text" disabled class="form-control" value="{{ $shelters->facebook }}" />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Tiktok</label>
                                        <input type="text" disabled class="form-control" value="{{ $shelters->tiktok }}" />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Estado</label>
                                        <input type="text" disabled class="form-control" value="{{ $shelters->state }}" />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Ciudad</label>
                                        <input type="text" disabled class="form-control" value="{{ $shelters->city }}" />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Colonia</label>
                                        <input type="text" disabled class="form-control" value="{{ $shelters->colony }}" />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Dirección</label>
                                        <input type="text" disabled class="form-control" value="{{ $shelters->address }}" />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Código Postal</label>
                                        <input type="text" disabled class="form-control" value="{{ $shelters->postal_code }}" />
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
