<?php include "header.php"; ?>

<div class="page-header">
    <h1 class="page-title">
        <i class="bi bi-plus-circle"></i> Nueva Denuncia
    </h1>
</div>

<div class="table-container">
    <div class="card-body p-4">
        <form method="POST" action="index.php?action=crear">
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
            <div class="d-flex gap-2 justify-content-end">
                <a href="index.php" class="btn btn-secondary">Cancelar</a>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>
</div>

<?php include "footer.php"; ?>
