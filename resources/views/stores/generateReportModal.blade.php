<div class="modal fade" id="generateReportModal" tabindex="-1" role="dialog" aria-labelledby="generateReportModal" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header modal-header-custom bg-maroon">
                <h5 class="modal-title" id="generateReportModal">Generar Reporte de Ventas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('generate.report') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="start_date" class="form-label">Fecha de Inicio(*)</label>
                        <input type="date" name="start_date" id="start_date" class="form-control" required placeholder="Ingrese fecha inicio" />

                        <label for="end_date" class="form-label">Fecha de Fin(*)</label>
                        <input type="date" name="end_date" id="end_date" class="form-control" required placeholder="Ingrese fecha fin" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn bg-maroon">Generar Reporte</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .select2-container .select2-selection--single {
        height: 40px;
        display: flex;
        align-items: center;
    }

    .modal-header-custom {
        background-color: #800000;
    }
</style>
