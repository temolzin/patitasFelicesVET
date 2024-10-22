<div class="modal fade" id="indexSponsorship{{ $vetMember->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="card-secondary">
                <div class="card-header">
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <h4 class="card-title">Apadrinamientos de {{ $vetMember->name }} {{ $vetMember->last_name }}</h4>
                        <button type="button" class="close d-sm-inline-block text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <div class="modal-body">
                    @php
                    $memberSponsorships = $sponsorships[$vetMember->id] ?? [];
                    @endphp
                    @if (empty($memberSponsorships))
                    <p>No hay apadrinamientos registrados para este miembro.</p>
                    @else
                    @foreach ($memberSponsorships as $sponsorship)
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title"><strong>Mascota:</strong> {{ $sponsorship->animal->name }}</h5>
                            <p class="card-text">
                                <strong>Fecha de Apadrinamiento:</strong> {{ $sponsorship->payment_date }}
                                <br>
                                <strong>Monto:</strong> {{ $sponsorship->amount }}
                            </p>
                            <div class="btn-group" role="group" aria-label="Options">
                                <button type="button" class="btn btn-info mr-2" data-toggle="modal" title="Ver Detalles" data-target="#viewSponsorship{{ $sponsorship->id }}">
                                    <i class="fas fa-eye"></i> Ver
                                </button>
                                <button type="button" class="btn btn-danger mr-2" data-toggle="modal" title="Eliminar Registro" data-target="#deleteSponsorship{{ $sponsorship->id }}">
                                    <i class="fas fa-trash-alt"></i> Eliminar
                                </button>
                                <a type="button" class="btn btn-secondary" title="Generar Recibo" target="_blank" href="{{ route('sponsorship.pdfSponsorship', Crypt::encrypt($sponsorship->id)) }}">
                                    <i class="fas fa-file-pdf"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    @include('sponsorship.viewSponsorship')
                    @include('sponsorship.deleteSponsorship')
                    @endforeach
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>
