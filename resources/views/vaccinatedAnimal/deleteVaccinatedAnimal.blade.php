<div class="modal fade" id="deleteVaccinatedAnimal{{ $vaccinatedAnimal->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title" id="deleteModalLabel">Eliminar aplicación de vacuna</h5>
                <button type="button" class="close" onclick="closeCurrentModal('#deleteVaccinatedAnimal{{ $vaccinatedAnimal->id }}')" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ¿Estás seguro de que deseas eliminar esta aplicación de vacuna?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeCurrentModal('#deleteVaccinatedAnimal{{ $vaccinatedAnimal->id }}')">Cancelar</button>
                <form action="{{ route('vaccinated_animals.destroy', $vaccinatedAnimal->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="modal_id" value="viewVaccinatedAnimal{{ $animal->id }}">
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>
