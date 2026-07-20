<?php ob_start(); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Marcas</h2>
    <div>
        <button class="btn btn-primary btn-modal-create" data-modal="#modalMarca" data-title="Nueva Marca"><i class="bi bi-plus-lg"></i> Nueva</button>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <div class="mb-3">
            <input type="text" class="form-control table-search" placeholder="Buscar marca...">
        </div>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead><tr><th>ID</th><th>Logo</th><th>Nombre</th><th>Web</th><th>Estado</th><th>Acciones</th></tr></thead>
                <tbody>
                    <?php foreach ($marcas as $m): ?>
                    <tr>
                        <td><?=$m['id']?></td>
                        <td><?php if($m['logo']):?><img src="<?=BASE_URL.$m['logo']?>" height="30"><?php endif;?></td>
                        <td><strong><?=htmlspecialchars($m['nombre'])?></strong></td>
                        <td><?=htmlspecialchars($m['sitio_web']??'')?></td>
                        <td><span class="badge bg-<?=$m['estado']?'success':'secondary'?>"><?=$m['estado']?'Activo':'Inactivo'?></span></td>
                        <td>
                            <button class="btn btn-sm btn-warning btn-modal-edit" data-modal="#modalMarca" data-id="<?=$m['id']?>" data-url="ayf-admin/marcas/data/"><i class="bi bi-pencil"></i></button>
                            <button class="btn btn-sm btn-danger delete-item" data-id="<?=$m['id']?>" data-url="ayf-admin/marcas/eliminar/"><i class="bi bi-trash"></i></button>
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

<div class="modal fade" id="modalMarca" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="modal-form" method="POST" enctype="multipart/form-data" action="<?=BASE_URL?>ayf-admin/marcas/guardar">
                <div class="modal-header"><h5 class="modal-title">Marca</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                <div class="modal-body">
                    <input type="hidden" name="id">
                    <div class="row g-3">
                        <div class="col-12"><label class="form-label">Nombre *</label><input type="text" name="nombre" class="form-control" required></div>
                        <div class="col-12"><label class="form-label">Descripción</label><textarea name="descripcion" class="form-control" rows="2"></textarea></div>
                        <div class="col-12"><label class="form-label">Sitio Web</label><input type="url" name="sitio_web" class="form-control"></div>
                        <div class="col-6"><label class="form-label">Logo</label><input type="file" name="logo" class="form-control" accept="image/*"><div class="current-file mt-2" style="display:none"><img class="current-img" height="40"></div></div>
                        <div class="col-6"><label class="form-label">Estado</label><select name="estado" class="form-select"><option value="1">Activo</option><option value="0">Inactivo</option></select></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php $content = ob_get_clean(); $title = 'Marcas'; require __DIR__.'/ayf_layout.php'; ?>
