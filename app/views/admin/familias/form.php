<?php ob_start(); ?>
<?php $isEdit = isset($familia); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><?= $isEdit ? 'Editar' : 'Nueva' ?> Familia</h2>
    <a href="<?= BASE_URL ?>admin/familias" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Volver</a>
</div>
<div class="card">
    <div class="card-body">
        <form method="POST" enctype="multipart/form-data" action="<?= $isEdit ? BASE_URL.'admin/familias/editar/'.$familia['id'] : BASE_URL.'admin/familias/crear' ?>">
            <?= csrf_field() ?>
            <div class="row g-3">
                <div class="col-md-6"><label class="form-label">Nombre *</label><input type="text" name="nombre" class="form-control" value="<?=htmlspecialchars($familia['nombre']??'')?>" required></div>
                <div class="col-md-2"><label class="form-label">Orden</label><input type="number" name="orden" class="form-control" value="<?=$familia['orden']??0?>"></div>
                <div class="col-md-2"><label class="form-label">Color</label><input type="color" name="color" class="form-control form-control-color" value="<?=htmlspecialchars($familia['color']??'#009933')?>"></div>
                <div class="col-md-2"><label class="form-label">Estado</label><select name="estado" class="form-select"><option value="1" <?=($familia['estado']??1)==1?'selected':''?>>Activo</option><option value="0" <?=($familia['estado']??1)==0?'selected':''?>>Inactivo</option></select></div>
                <div class="col-12"><label class="form-label">Descripción</label><textarea name="descripcion" class="form-control" rows="3"><?=htmlspecialchars($familia['descripcion']??'')?></textarea></div>
                <div class="col-md-6"><label class="form-label">Imagen</label><input type="file" name="imagen" class="form-control" accept="image/*"><?php if($isEdit&&$familia['imagen']):?><div class="mt-2"><img src="<?=BASE_URL.$familia['imagen']?>" height="60"></div><?php endif;?></div>
                <div class="col-md-6"><label class="form-label">Ícono</label><input type="file" name="icono" class="form-control" accept="image/*"><?php if($isEdit&&$familia['icono']):?><div class="mt-2"><img src="<?=BASE_URL.$familia['icono']?>" height="60"></div><?php endif;?></div>
                <div class="col-12"><button type="submit" class="btn btn-primary"><?=$isEdit?'Actualizar':'Guardar'?></button></div>
            </div>
        </form>
    </div>
</div>
<?php $content = ob_get_clean(); $title = $isEdit ? 'Editar Familia' : 'Nueva Familia'; require __DIR__ . '/../layout.php'; ?>
