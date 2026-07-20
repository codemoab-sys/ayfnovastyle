<?php ob_start(); ?>
<?php $isEdit = isset($marca); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><?= $isEdit ? 'Editar' : 'Nueva' ?> Marca</h2>
    <a href="<?= BASE_URL ?>admin/marcas" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Volver</a>
</div>
<div class="card">
    <div class="card-body">
        <form method="POST" enctype="multipart/form-data" action="<?= $isEdit ? BASE_URL.'admin/marcas/editar/'.$marca['id'] : BASE_URL.'admin/marcas/crear' ?>">
            <?= csrf_field() ?>
            <div class="row g-3">
                <div class="col-md-8"><label class="form-label">Nombre *</label><input type="text" name="nombre" class="form-control" value="<?=htmlspecialchars($marca['nombre']??'')?>" required></div>
                <div class="col-md-4"><label class="form-label">Estado</label><select name="estado" class="form-select"><option value="1" <?=($marca['estado']??1)==1?'selected':''?>>Activo</option><option value="0" <?=($marca['estado']??1)==0?'selected':''?>>Inactivo</option></select></div>
                <div class="col-12"><label class="form-label">Descripción</label><textarea name="descripcion" class="form-control" rows="2"><?=htmlspecialchars($marca['descripcion']??'')?></textarea></div>
                <div class="col-md-8"><label class="form-label">Sitio Web</label><input type="url" name="sitio_web" class="form-control" value="<?=htmlspecialchars($marca['sitio_web']??'')?>" placeholder="https://..."></div>
                <div class="col-md-4"><label class="form-label">Logo</label><input type="file" name="logo" class="form-control" accept="image/*"><?php if($isEdit&&$marca['logo']):?><div class="mt-2"><img src="<?=BASE_URL.$marca['logo']?>" height="50"></div><?php endif;?></div>
                <div class="col-12"><button type="submit" class="btn btn-primary"><?=$isEdit?'Actualizar':'Guardar'?></button></div>
            </div>
        </form>
    </div>
</div>
<?php $content = ob_get_clean(); $title = $isEdit ? 'Editar Marca' : 'Nueva Marca'; require __DIR__ . '/../layout.php'; ?>
