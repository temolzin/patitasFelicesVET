<div class="modal fade" id="deleteAdoption{{ $adoption->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title" id="exampleModalLabel">Eliminar Adopción</h5>
                <button type="button" class="close" onclick="closeCurrentModal('#deleteAdoption{{$adoption->id}}')" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('adoptions.destroy', $adoption->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body text-center text-danger">
                    ¿Estás seguro de eliminar la adopción <strong>{{ $adoption->animal->name }}</strong>?
                </div>
                <input type="hidden" name="modal_id" value="viewAdoptions{{ $shelterMember->id }}">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeCurrentModal('#deleteAdoption{{$adoption->id}}')">Cancelar</button>
                    <input type="hidden" name="modal_id" value="viewAdoptions{{ $shelterMember->id }}">
                    <button type="submit" class="btn btn-danger">Confirmar</button>
                </div>
            </form>
        </div>
    </div>
</div>
