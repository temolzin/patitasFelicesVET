<div class="modal fade" id="selectPets{{ $client->id }}" tabindex="-1" role="dialog" aria-labelledby="selectPetsModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="selectPetsModalLabel">Seleccionar Mascotas para {{ $client->name }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('clients.updatePets', $client->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="pets">Seleccionar Mascotas:</label>
                        <select name="pets[]" id="pets{{ $client->id }}" class="form-control" multiple>
                            @foreach($pets as $pet)
                                <option value="{{ $pet->id }}">{{ $pet->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const selectElement = document.getElementById('pets{{ $client->id }}');
    const maxPets = 3;

    selectElement.addEventListener('change', function() {
        const selectedOptions = Array.from(selectElement.selectedOptions).length;
        if (selectedOptions > maxPets) {
            alert('No puedes seleccionar más de ' + maxPets + ' mascotas.');
            selectElement.value = '';
        }
    });
});
</script>
