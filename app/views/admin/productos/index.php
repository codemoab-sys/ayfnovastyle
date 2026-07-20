<?php ob_start(); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Productos <span class="badge bg-secondary fs-6"><?=$totalProductos??0?></span></h2>
    <a href="<?= BASE_URL ?>admin/productos/crear" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Nuevo</a>
</div>
<div class="card">
    <div class="card-body">
        <div class="mb-3">
            <input type="text" class="form-control table-search" placeholder="Buscar producto...">
        </div>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead><tr><th>ID</th><th>Imagen</th><th>Código</th><th>Nombre Comercial</th><th>Familia</th><th>Marca</th><th>Destacado</th><th>Estado</th><th>Acciones</th></tr></thead>
                <tbody>
                    <?php foreach ($productos as $p): ?>
                    <tr>
                        <td><?=$p['id']?></td>
                        <td><?php if($p['imagen_principal']):?><img src="<?=BASE_URL.$p['imagen_principal']?>" height="40" style="object-fit:cover;width:40px;border-radius:4px;"><?php else:?><span class="text-muted">&mdash;</span><?php endif;?></td>
                        <td><strong><?=htmlspecialchars($p['codigo']??'')?></strong></td>
                        <td><?=htmlspecialchars($p['nombre_comercial'])?></td>
                        <td><?=htmlspecialchars($p['familia_nombre']??'')?></td>
                        <td><?=htmlspecialchars($p['marca_nombre']??'')?></td>
                        <td><?php if($p['destacado']):?><span class="badge bg-warning text-dark">Destacado</span><?php endif;?></td>
                        <td><span class="badge bg-<?=$p['estado']?'success':'secondary'?>"><?=$p['estado']?'Activo':'Inactivo'?></span></td>
                        <td>
                            <a href="<?=BASE_URL?>admin/productos/editar/<?=$p['id']?>" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                            <button class="btn btn-sm btn-danger delete-producto" data-id="<?=$p['id']?>"><i class="bi bi-trash"></i></button>
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
<?php $content = ob_get_clean(); $title = 'Productos'; require __DIR__ . '/../layout.php'; ?>
