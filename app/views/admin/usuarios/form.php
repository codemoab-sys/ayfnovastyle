<?php ob_start(); ?>
<?php $isEdit = isset($usuario); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><?= $isEdit ? 'Editar' : 'Nuevo' ?> Usuario</h2>
    <a href="<?= BASE_URL ?>admin/usuarios" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Volver</a>
</div>
<div class="card">
    <div class="card-body">
        <form method="POST" action="<?= $isEdit ? BASE_URL . 'admin/usuarios/editar/' . $usuario['id'] : BASE_URL . 'admin/usuarios/crear' ?>">
            <?= csrf_field() ?>
            <div class="row g-3">
                <div class="col-md-6"><label class="form-label">Nombre *</label><input type="text" name="nombre" class="form-control" value="<?= htmlspecialchars($usuario['nombre'] ?? '') ?>" required></div>
                <div class="col-md-6"><label class="form-label">Email *</label><input type="email" name="email" class="form-control" value="<?= htmlspecialchars($usuario['email'] ?? '') ?>" required></div>
                <div class="col-md-4"><label class="form-label">Contraseña <?= $isEdit ? '(dejar vacío para mantener)' : '*' ?></label><input type="password" name="password" class="form-control" <?= $isEdit ? '' : 'required' ?>></div>
                <div class="col-md-4"><label class="form-label">Rol</label><select name="rol" class="form-select"><option value="admin" <?= ($usuario['rol'] ?? '') == 'admin' ? 'selected' : '' ?>>Admin</option><option value="editor" <?= ($usuario['rol'] ?? 'editor') == 'editor' ? 'selected' : '' ?>>Editor</option></select></div>
                <div class="col-md-4"><label class="form-label">Estado</label><select name="estado" class="form-select"><option value="1" <?= ($usuario['estado'] ?? 1) == 1 ? 'selected' : '' ?>>Activo</option><option value="0" <?= ($usuario['estado'] ?? 1) == 0 ? 'selected' : '' ?>>Inactivo</option></select></div>
                <div class="col-12"><button type="submit" class="btn btn-primary"><?= $isEdit ? 'Actualizar' : 'Guardar' ?></button></div>
            </div>
        </form>
    </div>
</div>
<?php $content = ob_get_clean(); $title = $isEdit ? 'Editar Usuario' : 'Nuevo Usuario'; require __DIR__ . '/../layout.php'; ?>
