<?php ob_start(); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Usuarios</h2>
    <a href="<?= BASE_URL ?>admin/usuarios/crear" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Nuevo</a>
</div>
<div class="card">
    <div class="card-body">
        <div class="mb-3">
            <input type="text" class="form-control table-search" placeholder="Buscar usuario...">
        </div>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead><tr><th>ID</th><th>Nombre</th><th>Email</th><th>Rol</th><th>Estado</th><th>Acciones</th></tr></thead>
                <tbody>
                    <?php foreach ($usuarios as $u): ?>
                    <tr>
                        <td><?= $u['id'] ?></td>
                        <td><strong><?= htmlspecialchars($u['nombre']) ?></strong></td>
                        <td><?= htmlspecialchars($u['email']) ?></td>
                        <td><span class="badge bg-info"><?= htmlspecialchars($u['rol']) ?></span></td>
                        <td><span class="badge bg-<?= $u['estado'] ? 'success' : 'secondary' ?>"><?= $u['estado'] ? 'Activo' : 'Inactivo' ?></span></td>
                        <td>
                            <a href="<?= BASE_URL ?>admin/usuarios/editar/<?= $u['id'] ?>" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                            <button class="btn btn-sm btn-danger delete-usuario" data-id="<?= $u['id'] ?>"><i class="bi bi-trash"></i></button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php if ($totalPages > 1): ?>
        <div class="d-flex justify-content-between align-items-center mt-3">
            <span class="pagination-info">Página <?=$currentPage?> de <?=$totalPages?></span>
            <nav><ul class="pagination pagination-sm mb-0">
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <li class="page-item <?=$i==$currentPage?'active':''?>"><a class="page-link" href="?page=<?=$i?>" data-page="<?=$i?>"><?=$i?></a></li>
                <?php endfor; ?>
            </ul></nav>
        </div>
        <?php endif; ?>
    </div>
</div>
<?php $content = ob_get_clean(); $title = 'Usuarios'; require __DIR__ . '/../layout.php'; ?>
