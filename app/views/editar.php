<?php include "header.php"; ?>

<div class="page-header">
    <h1 class="page-title">
        <i class="bi bi-pencil"></i> Editar Denuncia #<?= $denuncia['id'] ?>
    </h1>
</div>

<div class="table-container">
    <div class="card-body p-4">
        <form method="POST" action="index.php?action=editar&id=<?= $denuncia['id'] ?>">
            <div class="mb-3">
                <label for="titulo" class="form-label">Título <span class="text-danger">*</span></label>
                <input type="text" name="titulo" id="titulo" class="form-control" value="<?= htmlspecialchars($denuncia['titulo']) ?>" required maxlength="100">
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción <span class="text-danger">*</span></label>
                <textarea name="descripcion" id="descripcion" class="form-control" rows="3" required maxlength="255"><?= htmlspecialchars($denuncia['descripcion']) ?></textarea>
            </div>
            <div class="mb-3">
                <label for="ubicacion" class="form-label">Ubicación <span class="text-danger">*</span></label>
                <input type="text" name="ubicacion" id="ubicacion" class="form-control" value="<?= htmlspecialchars($denuncia['ubicacion']) ?>" required maxlength="150">
            </div>
            <div class="mb-3">
                <label for="ciudadano" class="form-label">Ciudadano <span class="text-danger">*</span></label>
                <input type="text" name="ciudadano" id="ciudadano" class="form-control" value="<?= htmlspecialchars($denuncia['ciudadano']) ?>" required maxlength="100">
            </div>
            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono <span class="text-danger">*</span></label>
                <input type="text" name="telefono" id="telefono" class="form-control" value="<?= htmlspecialchars($denuncia['telefono_ciudadano']) ?>" required maxlength="15">
            </div>
            <div class="mb-3">
                <label for="estado" class="form-label">Estado <span class="text-danger">*</span></label>
                <select name="estado" id="estado" class="form-select" required>
                    <option value="Pendiente" <?= ($denuncia['estado'] == "Pendiente") ? "selected" : "" ?>>Pendiente</option>
                    <option value="En proceso" <?= ($denuncia['estado'] == "En proceso") ? "selected" : "" ?>>En proceso</option>
                    <option value="Resuelto" <?= ($denuncia['estado'] == "Resuelto") ? "selected" : "" ?>>Resuelto</option>
                </select>
            </div>
            <div class="alert alert-info">
                <strong>Fecha de registro:</strong> <?= date('d/m/Y H:i', strtotime($denuncia['fecha_registro'])) ?>
            </div>
            <div class="d-flex gap-2 justify-content-end">
                <a href="index.php" class="btn btn-secondary">Cancelar</a>
                <button type="submit" class="btn btn-primary">Actualizar</button>
            </div>
        </form>
    </div>
</div>

<?php include "footer.php"; ?>
