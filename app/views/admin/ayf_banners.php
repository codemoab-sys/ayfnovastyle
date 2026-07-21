<?php ob_start(); ?>
<?php if (!empty($message)): ?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="bi bi-check-circle me-2"></i> <?=htmlspecialchars($message)?>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
<?php endif; ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Banners</h2>
    <div>
        <a href="<?=BASE_URL?>ayf-admin/banners/crear" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Nuevo</a>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead><tr><th>ID</th><th>Imagen</th><th>Título</th><th>Subtítulo</th><th>Orden</th><th>Estado</th><th>Acciones</th></tr></thead>
                <tbody>
                    <?php foreach ($banners as $b): ?>
                    <tr>
                        <td><?=$b['id']?></td>
                        <td><?php if($b['imagen']):
                            $imgPath = $b['imagen'];
                            if (strpos($imgPath, 'http://') === 0 || strpos($imgPath, 'https://') === 0) {
                                $imgUrl = $imgPath;
                            } elseif (strpos($imgPath, '/') === 0) {
                                $imgUrl = BASE_URL . ltrim($imgPath, '/');
                            } else {
                                $imgUrl = BASE_URL . $imgPath;
                            }
                        ?><img src="<?=$imgUrl?>" height="40" style="max-width:120px;object-fit:cover;border-radius:4px;" alt="banner"><?php endif;?></td>
                        <td><?=htmlspecialchars($b['titulo']??'')?></td>
                        <td><?=htmlspecialchars($b['subtitulo']??'')?></td>
                        <td><?=$b['orden']?></td>
                        <td><span class="badge bg-<?=$b['estado']?'success':'secondary'?>"><?=$b['estado']?'Activo':'Inactivo'?></span></td>
                        <td>
                            <a href="<?=BASE_URL?>ayf-admin/banners/editar/<?=$b['id']?>" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                            <button class="btn btn-sm btn-danger delete-item" data-id="<?=$b['id']?>" data-url="ayf-admin/banners/eliminar/"><i class="bi bi-trash"></i></button>
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
                <li class="page-item <?=$i==$currentPage?'active':''?>"><a class="page-link" href="?page=<?=$i?>"><?=$i?></a></li>
                <?php endfor; ?>
            </ul></nav>
        </div>
        <?php endif; ?>
    </div>
</div>
<?php $content = ob_get_clean(); $title = 'Banners'; require __DIR__.'/ayf_layout.php'; ?>
