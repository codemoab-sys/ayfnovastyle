<?php ob_start(); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Buenas Prácticas <span class="badge bg-secondary fs-6"><?=$total??0?></span></h2>
    <button class="btn btn-primary btn-modal-create" data-modal="#modalBP" data-title="Nueva Buena Práctica"><i class="bi bi-plus-lg"></i> Nueva</button>
</div>
<div class="card">
    <div class="card-body">
        <div class="mb-3">
            <input type="text" class="form-control table-search" placeholder="Buscar...">
        </div>
        <div class="row">
            <?php if (empty($items)): ?>
            <div class="col-12 text-center py-5 text-muted"><i class="bi bi-award" style="font-size:3rem"></i><p class="mt-2">No hay buenas prácticas registradas</p></div>
            <?php else: ?>
            <?php foreach ($items as $bp): ?>
            <div class="col-md-6 col-lg-4 mb-3">
                <div class="card bp-card h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h6 class="card-title mb-0"><?=htmlspecialchars($bp['titulo'])?></h6>
                            <span class="badge bg-<?=$bp['estado']?'success':'secondary'?>"><?=$bp['estado']?'Activo':'Inactivo'?></span>
                        </div>
                        <p class="card-text small text-muted"><?=htmlspecialchars(mb_substr($bp['descripcion']??'', 0, 120))?></p>
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted"><?=htmlspecialchars($bp['categoria'])?></small>
                            <div>
                                <button class="btn btn-sm btn-warning btn-modal-edit" data-modal="#modalBP" data-id="<?=$bp['id']?>" data-url="admin/buenas-practicas/data/"><i class="bi bi-pencil"></i></button>
                                <button class="btn btn-sm btn-danger delete-bp" data-id="<?=$bp['id']?>"><i class="bi bi-trash"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
            <?php endif; ?>
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
<div class="modal fade" id="modalBP" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="modal-form" method="POST" enctype="multipart/form-data" action="<?=BASE_URL?>admin/buenas-practicas/guardar">
                <?= csrf_field() ?>
                <div class="modal-header"><h5 class="modal-title">Buena Práctica</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                <div class="modal-body">
                    <input type="hidden" name="id">
                    <div class="row g-3">
                        <div class="col-12"><label class="form-label">Título *</label><input type="text" name="titulo" class="form-control" required></div>
                        <div class="col-md-8"><label class="form-label">Categoría</label>
                            <select name="categoria" class="form-select">
                                <option value="general">General</option>
                                <option value="seguridad">Seguridad</option>
                                <option value="calidad">Calidad</option>
                                <option value="almacenamiento">Almacenamiento</option>
                                <option value="higiene">Higiene</option>
                            </select>
                        </div>
                        <div class="col-md-4"><label class="form-label">Estado</label><select name="estado" class="form-select"><option value="1">Activo</option><option value="0">Inactivo</option></select></div>
                        <div class="col-12"><label class="form-label">Descripción</label><textarea name="descripcion" class="form-control" rows="3"></textarea></div>
                        <div class="col-12"><label class="form-label">Archivo adjunto (PDF/imagen)</label><input type="file" name="archivo" class="form-control"></div>
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

<?php $content = ob_get_clean(); $title = 'Buenas Prácticas'; require __DIR__ . '/../layout.php'; ?>
