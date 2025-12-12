$(document).ready(function() {
    initDataTable();
    initDeleteConfirmation();
});

/**
 * Inicializa DataTables con configuración en español
 */
function initDataTable() {
    $('#products-table').DataTable({
        responsive: true,
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json'
        },
        columnDefs: [
            { orderable: false, targets: -1 }, // Desactiva ordenamiento en columna de acciones
            { className: 'text-center', targets: [0, 3, 4, 5, 6] }
        ],
        order: [[1, 'asc']], // Ordenar por nombre por defecto
        pageLength: 10,
        lengthMenu: [5, 10, 25, 50, 100],
        dom: '<"row"<"col-md-6"l><"col-md-6"f>>rtip'
    });
}

/**
 * Confirmación antes de eliminar
 */
function initDeleteConfirmation() {
    $('.delete-form').on('submit', function(e) {
        e.preventDefault();

        if (confirm('¿Está seguro de eliminar este producto?')) {
            this.submit();
        }
    });
}
