// Función para confirmar eliminación
function confirmarEliminar(id, titulo) {
    document.getElementById('tituloEliminar').textContent = titulo;
    document.getElementById('btnEliminarConfirm').href = 'index.php?action=eliminar&id=' + id;
    
    const modal = new bootstrap.Modal(document.getElementById('modalEliminar'));
    modal.show();
}

// Función para editar denuncia
function editarDenuncia(id) {
    // Hacer una petición AJAX para obtener los datos de la denuncia
    fetch('index.php?action=obtener&id=' + id)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const denuncia = data.denuncia;
                
                // Cambiar el título del modal
                document.querySelector('#modalCrear .modal-title').textContent = 'Editar Reporte de Denuncia';
                
                // Llenar el formulario
                document.getElementById('titulo').value = denuncia.titulo;
                document.getElementById('descripcion').value = denuncia.descripcion;
                document.getElementById('ubicacion').value = denuncia.ubicacion;
                document.getElementById('ciudadano').value = denuncia.ciudadano;
                document.getElementById('telefono').value = denuncia.telefono_ciudadano;
                document.getElementById('estado').value = denuncia.estado;
                
                // Cambiar la acción del formulario
                document.getElementById('formDenuncia').action = 'index.php?action=editar&id=' + id;
                
                // Mostrar el modal
                const modal = new bootstrap.Modal(document.getElementById('modalCrear'));
                modal.show();
            }
        })
        .catch(error => {
            console.error('Error:', error);
            // Si falla AJAX, redirigir a la página de edición
            window.location.href = 'index.php?action=editar&id=' + id;
        });
}

// Limpiar formulario cuando se cierra el modal
document.getElementById('modalCrear').addEventListener('hidden.bs.modal', function () {
    document.getElementById('formDenuncia').reset();
    document.querySelector('#modalCrear .modal-title').textContent = 'Nuevo Reporte de Denuncia';
    document.getElementById('formDenuncia').action = 'index.php?action=crear';
    // Resetear el estado a Pendiente por defecto
    document.getElementById('estado').value = 'Pendiente';
});

// Toggle sidebar en móviles
document.addEventListener('DOMContentLoaded', function() {
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebar = document.querySelector('.sidebar');
    
    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', function() {
            sidebar.classList.toggle('show');
        });
    }
    
    // Cerrar sidebar al hacer clic fuera en móviles
    document.addEventListener('click', function(event) {
        if (window.innerWidth <= 992) {
            if (!sidebar.contains(event.target) && !sidebarToggle.contains(event.target)) {
                sidebar.classList.remove('show');
            }
        }
    });
});
