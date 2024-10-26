<div class="modal fade" id="deleteAppliedService{{ $assignService->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title" id="deleteModalLabel">Eliminar servicio aplicado</h5>
                <button type="button" class="close" onclick="closeCurrentModal('#deleteAppliedService{{ $assignService->id }}')" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ¿Estás seguro de que deseas eliminar este servicio aplicado?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeCurrentModal('#deleteAppliedService{{ $assignService->id }}')">Cancelar</button>
                <form action="{{ route('service_animals.destroy', $assignService->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="modal_id" value="viewVaccinatedAnimal{{ $animal->id }}">
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>
