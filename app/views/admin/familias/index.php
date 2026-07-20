<?php ob_start(); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Familias</h2>
    <div>
        <button class="btn btn-primary btn-modal-create" data-modal="#modalFamilia" data-title="Nueva Familia"><i class="bi bi-plus-lg"></i> Nueva</button>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <div class="mb-3">
            <input type="text" class="form-control table-search" placeholder="Buscar familia...">
        </div>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead><tr><th>ID</th><th>Color</th><th>Nombre</th><th>Slug</th><th>Orden</th><th>Estado</th><th>Acciones</th></tr></thead>
                <tbody>
                    <?php foreach ($familias as $f): ?>
                    <tr>
                        <td><?=$f['id']?></td>
                        <td><span style="display:inline-block;width:24px;height:24px;border-radius:50%;background:<?=htmlspecialchars($f['color']??'#009933')?>"></span></td>
                        <td><strong><?=htmlspecialchars($f['nombre'])?></strong></td>
                        <td><code><?=htmlspecialchars($f['slug'])?></code></td>
                        <td><?=$f['orden']?></td>
                        <td><span class="badge bg-<?=$f['estado']?'success':'secondary'?>"><?=$f['estado']?'Activo':'Inactivo'?></span></td>
                        <td>
                            <button class="btn btn-sm btn-warning btn-modal-edit" data-modal="#modalFamilia" data-id="<?=$f['id']?>" data-url="admin/familias/data/"><i class="bi bi-pencil"></i></button>
                            <button class="btn btn-sm btn-danger delete-familia" data-id="<?=$f['id']?>"><i class="bi bi-trash"></i></button>
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

<!-- Modal -->
<div class="modal fade" id="modalFamilia" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form class="modal-form" method="POST" enctype="multipart/form-data" action="<?=BASE_URL?>admin/familias/guardar">
                <div class="modal-header"><h5 class="modal-title">Familia</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                <div class="modal-body">
                    <input type="hidden" name="id">
                    <div class="row g-3">
                        <div class="col-md-6"><label class="form-label">Nombre *</label><input type="text" name="nombre" class="form-control" required></div>
                        <div class="col-md-2"><label class="form-label">Orden</label><input type="number" name="orden" class="form-control" value="0"></div>
                        <div class="col-md-2"><label class="form-label">Color</label><input type="color" name="color" class="form-control form-control-color" value="#009933"></div>
                        <div class="col-md-2"><label class="form-label">Estado</label><select name="estado" class="form-select"><option value="1">Activo</option><option value="0">Inactivo</option></select></div>
                        <div class="col-12"><label class="form-label">Descripción</label><textarea name="descripcion" class="form-control" rows="2"></textarea></div>
                        <div class="col-md-6"><label class="form-label">Imagen</label><input type="file" name="imagen" class="form-control" accept="image/*"><div class="current-file mt-2" style="display:none"><img class="current-img" height="60"></div></div>
                        <div class="col-md-6"><label class="form-label">Ícono</label><input type="file" name="icono" class="form-control" accept="image/*"><div class="current-file mt-2" style="display:none"><img class="current-icono" height="60"></div></div>
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

<?php $content = ob_get_clean(); $title = 'Familias'; require __DIR__.'/../layout.php'; ?>
