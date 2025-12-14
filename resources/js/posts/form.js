document.addEventListener('DOMContentLoaded', function() {
    initStockAutoState();
    initFormValidation();
});

/**
 * Cambia el estado automáticamente según la cantidad
 */
function initStockAutoState() {
    const cantidadInput = document.getElementById('Cantidad');
    const estadoSelect = document.getElementById('Estado');

    if (cantidadInput && estadoSelect) {
        cantidadInput.addEventListener('change', function() {
            const cantidad = Number.parseInt(this.value) || 0;
            estadoSelect.value = cantidad === 0 ? 'agotado' : 'disponible';
        });
    }
}

/**
 * Validación adicional del formulario
 */
function initFormValidation() {
    const form = document.querySelector('form');

    if (form) {
        form.addEventListener('submit', function(e) {
            const precio = Number.parseFloat(document.getElementById('Precio_por_unidad').value);
            const cantidad = Number.parseInt(document.getElementById('Cantidad').value);

            if (precio < 0) {
                e.preventDefault();
                alert('El precio no puede ser negativo');
                return false;
            }

            if (cantidad < 0) {
                e.preventDefault();
                alert('La cantidad no puede ser negativa');
                return false;
            }
        });
    }
}
