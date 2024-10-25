@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Seleccionar Mascotas para {{ $client->name }}</h2>
    <form action="{{ route('clients.updatePets', $client->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="pets">Seleccionar Mascotas:</label>
            <select name="pets[]" id="pets" class="form-control" multiple>
                @foreach($pets as $pet)
                    <option value="{{ $pet->id }}">{{ $pet->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ route('clients.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const selectElement = document.getElementById('pets');
    const maxPets = 3; // Cambia este valor si es necesario

    selectElement.addEventListener('change', function() {
        const selectedOptions = Array.from(selectElement.selectedOptions).length;
        if (selectedOptions > maxPets) {
            alert('No puedes seleccionar más de ' + maxPets + ' mascotas.');
            selectElement.value = ''; // Resetea la selección
        }
    });
});
</script>
@endsection
