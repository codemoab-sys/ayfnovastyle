<?php ob_start(); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Productos</h2>
    <div>
        <a href="<?=BASE_URL?>ayf-admin/productos/crear" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Nuevo</a>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead><tr><th>ID</th><th>Imagen</th><th>Código</th><th>Nombre</th><th>Categoría</th><th>Marca</th><th>Precio</th><th>Stock</th><th>Estado</th><th>Acciones</th></tr></thead>
                <tbody>
                    <?php foreach ($productos as $p): ?>
                    <tr>
                        <td><?=$p['id']?></td>
                        <td><?php if($p['imagen_principal']):?><img src="<?=BASE_URL.$p['imagen_principal']?>" height="50" style="object-fit:cover;width:50px;border-radius:4px;"><?php endif;?></td>
                        <td><?=htmlspecialchars($p['codigo']??'')?></td>
                        <td><strong><?=htmlspecialchars($p['nombre'])?></strong></td>
                        <td><?=htmlspecialchars($p['categoria_nombre']??'')?></td>
                        <td><?=htmlspecialchars($p['marca_nombre']??'')?></td>
                        <td><?=$p['precio']?'S/ '.number_format($p['precio'],2):'-'?></td>
                        <td><?=$p['stock']??0?></td>
                        <td><span class="badge bg-<?=$p['estado']?'success':'secondary'?>"><?=$p['estado']?'Activo':'Inactivo'?></span></td>
                        <td>
                            <a href="<?=BASE_URL?>ayf-admin/productos/editar/<?=$p['id']?>" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                            <button class="btn btn-sm btn-danger delete-item" data-id="<?=$p['id']?>" data-url="ayf-admin/productos/eliminar/"><i class="bi bi-trash"></i></button>
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
<?php $content = ob_get_clean(); $title = 'Productos'; require __DIR__.'/ayf_layout.php'; ?>
