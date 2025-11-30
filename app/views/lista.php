<?php include "header.php"; ?>

<div class="page-header">
    <h1 class="page-title">
        <i class="bi bi-search"></i> Denuncias
    </h1>
</div>

<!-- Filtro de Estado -->
<div class="filter-bar">
    <form method="GET" action="index.php" class="filter-form">
        <input type="hidden" name="action" value="index">
        <input type="hidden" name="busqueda" value="<?= htmlspecialchars($busqueda ?? '') ?>">
        <label for="filtroEstado" class="filter-label">
            <i class="bi bi-funnel"></i> Filtrar por Estado:
        </label>
        <select name="estado" id="filtroEstado" class="form-select filter-select" onchange="this.form.submit()">
            <option value="">Todos los estados</option>
            <option value="Pendiente" <?= ($estado ?? '') == 'Pendiente' ? 'selected' : '' ?>>Pendiente</option>
            <option value="En proceso" <?= ($estado ?? '') == 'En proceso' ? 'selected' : '' ?>>En proceso</option>
            <option value="Resuelto" <?= ($estado ?? '') == 'Resuelto' ? 'selected' : '' ?>>Resuelto</option>
        </select>
        <?php if (!empty($estado)): ?>
            <a href="index.php?action=index<?= !empty($busqueda) ? '&busqueda=' . urlencode($busqueda) : '' ?>" class="btn btn-outline-secondary btn-clear-filter">
                <i class="bi bi-x-circle"></i> Limpiar filtro
            </a>
        <?php endif; ?>
    </form>
</div>

<div class="page-actions">
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCrear">
        <i class="bi bi-plus-circle"></i> Nuevo
    </button>
    <form method="GET" action="index.php" class="search-form">
        <input type="hidden" name="action" value="index">
        <input type="hidden" name="estado" value="<?= htmlspecialchars($estado ?? '') ?>">
        <input type="text" 
               name="busqueda" 
               class="form-control search-input" 
               placeholder="Buscar..." 
               value="<?= htmlspecialchars($busqueda ?? '') ?>">
        <button type="submit" class="btn btn-primary search-btn">
            <i class="bi bi-search"></i> Buscar
        </button>
    </form>
</div>

<?php if ($totalRegistros > 0): ?>
    <div class="table-container">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Opciones</th>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Descripción</th>
                    <th>Ubicación</th>
                    <th>Ciudadano</th>
                    <th>Fecha</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $lista->fetch(PDO::FETCH_ASSOC)): ?>
                    <tr>
                        <td>
                            <button type="button" 
                                    class="btn btn-warning btn-sm btn-edit" 
                                    onclick="editarDenuncia(<?= $row['id'] ?>)">
                                <i class="bi bi-pencil"></i> Editar
                            </button>
                            <button type="button" 
                                    class="btn btn-danger btn-sm btn-delete" 
                                    onclick="confirmarEliminar(<?= $row['id'] ?>, '<?= htmlspecialchars($row['titulo'], ENT_QUOTES) ?>')">
                                <i class="bi bi-trash"></i> Eliminar
                            </button>
                        </td>
                        <td><?= $row['id'] ?></td>
                        <td><?= htmlspecialchars($row['titulo']) ?></td>
                        <td><?= htmlspecialchars($row['descripcion']) ?></td>
                        <td><?= htmlspecialchars($row['ubicacion']) ?></td>
                        <td><?= htmlspecialchars($row['ciudadano']) ?></td>
                        <td><?= date('Y-m-d', strtotime($row['fecha_registro'])) ?></td>
                        <td><?= htmlspecialchars($row['estado']) ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <!-- Paginación -->
    <?php if ($totalPaginas > 1): ?>
        <nav class="pagination-nav">
            <ul class="pagination">
                <li class="page-item <?= $pagina <= 1 ? 'disabled' : '' ?>">
                    <a class="page-link" 
                       href="index.php?action=index&pagina=<?= $pagina - 1 ?><?= !empty($busqueda) ? '&busqueda=' . urlencode($busqueda) : '' ?><?= !empty($estado) ? '&estado=' . urlencode($estado) : '' ?>">
                        Anterior
                    </a>
                </li>

                <?php
                $inicio = max(1, $pagina - 2);
                $fin = min($totalPaginas, $pagina + 2);
                
                if ($inicio > 1): ?>
                    <li class="page-item">
                        <a class="page-link" 
                           href="index.php?action=index&pagina=1<?= !empty($busqueda) ? '&busqueda=' . urlencode($busqueda) : '' ?><?= !empty($estado) ? '&estado=' . urlencode($estado) : '' ?>">
                            1
                        </a>
                    </li>
                    <?php if ($inicio > 2): ?>
                        <li class="page-item disabled">
                            <span class="page-link">...</span>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>

                <?php for ($i = $inicio; $i <= $fin; $i++): ?>
                    <li class="page-item <?= $i == $pagina ? 'active' : '' ?>">
                        <a class="page-link" 
                           href="index.php?action=index&pagina=<?= $i ?><?= !empty($busqueda) ? '&busqueda=' . urlencode($busqueda) : '' ?><?= !empty($estado) ? '&estado=' . urlencode($estado) : '' ?>">
                            <?= $i ?>
                        </a>
                    </li>
                <?php endfor; ?>

                <?php if ($fin < $totalPaginas): ?>
                    <?php if ($fin < $totalPaginas - 1): ?>
                        <li class="page-item disabled">
                            <span class="page-link">...</span>
                        </li>
                    <?php endif; ?>
                    <li class="page-item">
                        <a class="page-link" 
                           href="index.php?action=index&pagina=<?= $totalPaginas ?><?= !empty($busqueda) ? '&busqueda=' . urlencode($busqueda) : '' ?><?= !empty($estado) ? '&estado=' . urlencode($estado) : '' ?>">
                            <?= $totalPaginas ?>
                        </a>
                    </li>
                <?php endif; ?>

                <li class="page-item <?= $pagina >= $totalPaginas ? 'disabled' : '' ?>">
                    <a class="page-link" 
                       href="index.php?action=index&pagina=<?= $pagina + 1 ?><?= !empty($busqueda) ? '&busqueda=' . urlencode($busqueda) : '' ?><?= !empty($estado) ? '&estado=' . urlencode($estado) : '' ?>">
                        Siguiente
                    </a>
                </li>
            </ul>
        </nav>
    <?php endif; ?>

<?php else: ?>
    <div class="alert alert-warning text-center">
        <h5>No se encontraron denuncias</h5>
        <p>
            <?php if (!empty($busqueda) || !empty($estado)): ?>
                <?php if (!empty($busqueda) && !empty($estado)): ?>
                    No hay resultados para la búsqueda "<strong><?= htmlspecialchars($busqueda) ?></strong>" con estado "<strong><?= htmlspecialchars($estado) ?></strong>".
                <?php elseif (!empty($busqueda)): ?>
                    No hay resultados para la búsqueda: "<strong><?= htmlspecialchars($busqueda) ?></strong>".
                <?php elseif (!empty($estado)): ?>
                    No hay denuncias con estado "<strong><?= htmlspecialchars($estado) ?></strong>".
                <?php endif; ?>
            <?php else: ?>
                Aún no se han registrado denuncias.
            <?php endif; ?>
        </p>
    </div>
<?php endif; ?>

<!-- Modal Crear/Editar -->
<div class="modal fade" id="modalCrear" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nuevo Reporte de Denuncia</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="index.php?action=crear" id="formDenuncia">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="titulo" class="form-label">Título <span class="text-danger">*</span></label>
                        <input type="text" name="titulo" id="titulo" class="form-control" placeholder="Ingrese título" required maxlength="100">
                    </div>
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción <span class="text-danger">*</span></label>
                        <textarea name="descripcion" id="descripcion" class="form-control" rows="3" placeholder="Ingrese descripción" required maxlength="255"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="ubicacion" class="form-label">Ubicación <span class="text-danger">*</span></label>
                        <input type="text" name="ubicacion" id="ubicacion" class="form-control" placeholder="Ingrese ubicación (ej. coordenadas o dirección)" required maxlength="150">
                    </div>
                    <div class="mb-3">
                        <label for="ciudadano" class="form-label">Ciudadano <span class="text-danger">*</span></label>
                        <input type="text" name="ciudadano" id="ciudadano" class="form-control" placeholder="Ingrese nombre del ciudadano" required maxlength="100">
                    </div>
                    <div class="mb-3">
                        <label for="telefono" class="form-label">Teléfono <span class="text-danger">*</span></label>
                        <input type="text" name="telefono" id="telefono" class="form-control" placeholder="Ingrese teléfono" required maxlength="15">
                    </div>
                    <div class="mb-3">
                        <label for="estado" class="form-label">Estado <span class="text-danger">*</span></label>
                        <select name="estado" id="estado" class="form-select" required>
                            <option value="Pendiente" selected>Pendiente</option>
                            <option value="En proceso">En proceso</option>
                            <option value="Resuelto">Resuelto</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Eliminar -->
<div class="modal fade" id="modalEliminar" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content modal-danger">
            <div class="modal-header">
                <h5 class="modal-title">Eliminar registro</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Deseas eliminar al registro: <strong id="tituloEliminar"></strong></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <a href="#" id="btnEliminarConfirm" class="btn btn-danger">Eliminar</a>
            </div>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>
