<?php ob_start(); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Banners</h2>
    <a href="<?= BASE_URL ?>admin/banners/crear" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Nuevo</a>
</div>
<div class="card">
    <div class="card-body">
        <div class="mb-3">
            <input type="text" class="form-control table-search" placeholder="Buscar banner...">
        </div>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead><tr><th>ID</th><th>Imagen</th><th>Título</th><th>Orden</th><th>Estado</th><th>Acciones</th></tr></thead>
                <tbody>
                    <?php foreach ($banners as $b): ?>
                    <tr>
                        <td><?= $b['id'] ?></td>
                        <td><?php if ($b['imagen']): ?><img src="<?= BASE_URL . $b['imagen'] ?>" height="40" style="border-radius:4px;object-fit:cover;width:60px;"><?php else: ?><span class="text-muted">—</span><?php endif; ?></td>
                        <td><strong><?= htmlspecialchars($b['titulo'] ?? '') ?></strong></td>
                        <td><?= $b['orden'] ?></td>
                        <td><span class="badge bg-<?= $b['estado'] ? 'success' : 'secondary' ?>"><?= $b['estado'] ? 'Activo' : 'Inactivo' ?></span></td>
                        <td>
                            <a href="<?= BASE_URL ?>admin/banners/editar/<?= $b['id'] ?>" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                            <button class="btn btn-sm btn-danger delete-banner" data-id="<?= $b['id'] ?>"><i class="bi bi-trash"></i></button>
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
<?php $content = ob_get_clean(); $title = 'Banners'; require __DIR__ . '/../layout.php'; ?>
