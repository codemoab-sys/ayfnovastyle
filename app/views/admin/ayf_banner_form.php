<?php ob_start(); ?>
<?php $isEdit = isset($banner); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><?= $isEdit ? 'Editar' : 'Nuevo' ?> Banner</h2>
    <a href="<?= BASE_URL ?>ayf-admin/banners" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Volver</a>
</div>
<div class="card">
    <div class="card-body">
        <form method="POST" enctype="multipart/form-data" action="<?= $isEdit ? BASE_URL.'ayf-admin/banners/editar/'.$banner['id'] : BASE_URL.'ayf-admin/banners/crear' ?>">
            <?= csrf_field() ?>
            <div class="row g-3">
                <div class="col-md-6"><label class="form-label">Título</label><input type="text" name="titulo" class="form-control" value="<?=htmlspecialchars($banner['titulo']??'')?>"></div>
                <div class="col-md-6"><label class="form-label">Orden</label><input type="number" name="orden" class="form-control" value="<?=$banner['orden']??0?>"></div>
                <div class="col-12"><label class="form-label">Subtítulo</label><input type="text" name="subtitulo" class="form-control" value="<?=htmlspecialchars($banner['subtitulo']??'')?>"></div>
                <div class="col-12"><label class="form-label">Link</label><input type="url" name="link" class="form-control" value="<?=htmlspecialchars($banner['link']??'')?>"></div>
                <div class="col-md-6"><label class="form-label">Imagen</label><input type="file" name="imagen" class="form-control" accept="image/*"><?php if($isEdit&&$banner['imagen']):?><div class="mt-2"><img src="<?=BASE_URL.$banner['imagen']?>" height="80"><div class="form-check mt-1"><input class="form-check-input" type="checkbox" name="eliminar_imagen" id="eliminar_imagen" value="1"><label class="form-check-label" for="eliminar_imagen">Eliminar imagen actual</label></div></div><?php endif;?></div>
                <div class="col-md-6"><label class="form-label">Estado</label><select name="estado" class="form-select"><option value="1" <?=($banner['estado']??1)==1?'selected':''?>>Activo</option><option value="0" <?=($banner['estado']??1)==0?'selected':''?>>Inactivo</option></select></div>
                <div class="col-12"><button type="submit" class="btn btn-primary"><?=$isEdit?'Actualizar':'Guardar'?></button></div>
            </div>
        </form>
    </div>
</div>
<?php $content = ob_get_clean(); $title = $isEdit ? 'Editar Banner' : 'Nuevo Banner'; require __DIR__.'/ayf_layout.php'; ?>
