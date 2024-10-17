<div class="modal fade" id="view{{ $shelterMember->id }}" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel{{ $shelterMember->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="card-info">
                <div class="card-header">
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <h4 class="card-title">Información del miembro</h4>
                        <button type="button" class="close d-sm-inline-block text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <div class="modal-body">
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
                                <div class="col-lg-12">
                                    <div class="form-group">
                                            <div class="form-group text-center">
                                                @if($shelterMember->getMedia('photos')->isNotEmpty())
                                                <img src="{{ $shelterMember->getFirstMedia('photos')->getUrl() }}" alt="{{ $shelterMember->name }}" class="img-fluid" style="width: 120px; height: 120px; border-radius: 60%;" />
                                                @else
                                                <img src="{{ asset('img/avatardefault.png') }}" style="width: 120px; height: 120px; border-radius: 50%;">
                                                @endif
                                            </div>
                                        <label>ID</label>
                                        <input type="text" disabled class="form-control" value="{{ $shelterMember->id }}" />
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Nombre</label>
                                        <input type="text" disabled class="form-control" value="{{ $shelterMember->name }}" />
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Apellido</label>
                                        <input type="text" disabled class="form-control" value="{{ $shelterMember->last_name }}" />
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Telefono</label>
                                        <input type="text" disabled class="form-control" value="{{ $shelterMember->phone}}" />
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Correo</label>
                                        <input type="text" disabled class="form-control" value="{{ $shelterMember->email}}" />
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Estado/Provincia</label>
                                        <input type="text" disabled class="form-control" value="{{ $shelterMember->state}}" />
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Ciudad</label>
                                        <input type="text" disabled class="form-control" value="{{ $shelterMember->city}}" />
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Colonia</label>
                                        <input type="text" disabled class="form-control" value="{{ $shelterMember->colony}}" />
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Dirección</label>
                                        <input type="text" disabled class="form-control" value="{{ $shelterMember->address}}" />
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Codigo postal</label>
                                        <input type="text" disabled class="form-control" value="{{ $shelterMember->postal_code}}" />
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Tipo de miembro</label>
                                        <input type="text" disabled class="form-control" value="{{ $shelterMember->type_member}}" />
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
