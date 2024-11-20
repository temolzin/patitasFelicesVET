<div class="modal" id="generateReportModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <form action="{{ route('generate.report') }}" method="POST">
                @csrf
                <div class="modal-header bg-primary">
                    <h5 class="modal-title">Generar Reporte de Ventas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label for="start_date">Fecha de Inicio</label>
                    <input type="date" name="start_date" required>

                    <label for="end_date">Fecha de Fin</label>
                    <input type="date" name="end_date" required>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Generar Reporte</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .modal-md {
    max-width: 500px; 
    }
</style>