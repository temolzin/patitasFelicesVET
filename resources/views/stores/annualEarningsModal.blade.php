<div class="modal fade" id="annualEarningsModal" tabindex="-1" role="dialog" aria-labelledby="annualEarningsModal" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header modal-header-custom bg-info">
                <h5 class="modal-title" id="annualEarningsModal">Generar Reporte Anual</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('generate.annual.report') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="year" class="form-label">Seleccione el Año(*)</label>
                        <select name="year" id="year" class="form-control" required>
                            @for ($i = 2000; $i <= date('Y'); $i++)
                                <option value="{{ $i }}" {{ $i == date('Y') ? 'selected' : '' }}>{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-info">Generar Reporte</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .modal-header-custom {
        background-color: #007BFF;
    }
</style>
