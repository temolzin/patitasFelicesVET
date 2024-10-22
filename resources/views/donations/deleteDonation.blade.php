<div class="modal fade" id="deleteDonation{{ $donation->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title" id="exampleModalLabel">Eliminar Donacion</h5>
                <button type="button" class="close" onclick="closeCurrentModal('#deleteDonation{{$donation->id}}')"aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('donation.destroy', $donation->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body text-center text-danger">
                    ¿Estás seguro de eliminar la donación?
                </div>
                <input type="hidden" name="modal_id" value="viewDonations{{ $vetMember->id }}">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        onclick="closeCurrentModal('#deleteDonation{{$donation->id}}')">Cancelar</button>
                    <button type="submit" class="btn btn-danger">Confirmar</button>
                </div>
            </form>
        </div>
    </div>
</div>
