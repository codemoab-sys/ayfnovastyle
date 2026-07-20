<?php ob_start(); ?>
<?php $isEdit = isset($producto); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><?= $isEdit ? 'Editar' : 'Nuevo' ?> Producto</h2>
    <a href="<?= BASE_URL ?>ayf-admin/productos" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Volver</a>
</div>
<div class="card">
    <div class="card-body">
        <form method="POST" enctype="multipart/form-data" action="<?= $isEdit ? BASE_URL.'ayf-admin/productos/editar/'.$producto['id'] : BASE_URL.'ayf-admin/productos/crear' ?>">
            <?= csrf_field() ?>
            <div class="row g-3">
                <div class="col-md-4"><label class="form-label">Categoría *</label><select name="categoria_id" class="form-select" required><option value="">Seleccionar</option><?php foreach($categorias as $c):?><option value="<?=$c['id']?>" <?=($producto['categoria_id']??'')==$c['id']?'selected':''?>><?=htmlspecialchars($c['nombre'])?></option><?php endforeach;?></select></div>
                <div class="col-md-4"><label class="form-label">Marca *</label><select name="marca_id" class="form-select" required><option value="">Seleccionar</option><?php foreach($marcas as $m):?><option value="<?=$m['id']?>" <?=($producto['marca_id']??'')==$m['id']?'selected':''?>><?=htmlspecialchars($m['nombre'])?></option><?php endforeach;?></select></div>
                <div class="col-md-4"><label class="form-label">Género</label><select name="genero" class="form-select"><option value="unisex" <?=($producto['genero']??'')=='unisex'?'selected':''?>>Unisex</option><option value="hombre" <?=($producto['genero']??'')=='hombre'?'selected':''?>>Hombre</option><option value="mujer" <?=($producto['genero']??'')=='mujer'?'selected':''?>>Mujer</option><option value="niño" <?=($producto['genero']??'')=='niño'?'selected':''?>>Niño</option><option value="niña" <?=($producto['genero']??'')=='niña'?'selected':''?>>Niña</option></select></div>
                <div class="col-md-4"><label class="form-label">Código</label><input type="text" name="codigo" class="form-control" value="<?=htmlspecialchars($producto['codigo']??'')?>"></div>
                <div class="col-md-8"><label class="form-label">Nombre *</label><input type="text" name="nombre" class="form-control" value="<?=htmlspecialchars($producto['nombre']??'')?>" required></div>
                <div class="col-12"><label class="form-label">Descripción</label><textarea name="descripcion" class="form-control" rows="4"><?=htmlspecialchars($producto['descripcion']??'')?></textarea></div>
                <div class="col-md-4"><label class="form-label">Material</label><input type="text" name="material" class="form-control" value="<?=htmlspecialchars($producto['material']??'')?>" placeholder="Ej: Cuero, Gamuza, Lona"></div>
                <div class="col-md-4"><label class="form-label">Tallas</label><input type="text" name="tallas" class="form-control" value="<?=htmlspecialchars($producto['tallas']??'')?>" placeholder="Ej: 36,37,38,39,40"></div>
                <div class="col-md-4"><label class="form-label">Colores</label><input type="text" name="colores" class="form-control" value="<?=htmlspecialchars($producto['colores']??'')?>" placeholder="Ej: Negro,Blanco,Rojo"></div>
                <div class="col-md-3"><label class="form-label">Precio (S/) <small class="text-muted">actual</small></label><input type="number" step="0.01" name="precio" class="form-control" value="<?=$producto['precio']??''?>"></div>
                <div class="col-md-3"><label class="form-label">Precio Anterior (S/) <small class="text-muted">tachado</small></label><input type="number" step="0.01" name="precio_anterior" class="form-control" value="<?=$producto['precio_anterior']??''?>" placeholder="Ej: 120.00"></div>
                <div class="col-md-2"><label class="form-label">Stock</label><input type="number" name="stock" class="form-control" value="<?=$producto['stock']??0?>"></div>
                <div class="col-md-2"><label class="form-label">Orden</label><input type="number" name="orden" class="form-control" value="<?=$producto['orden']??0?>"></div>
                <div class="col-md-2"><label class="form-label">Destacado</label><div class="form-check form-switch mt-2"><input type="checkbox" name="destacado" class="form-check-input" value="1" <?=($producto['destacado']??0)?'checked':''?>></div></div>
                <div class="col-md-2"><label class="form-label">Nuevo</label><div class="form-check form-switch mt-2"><input type="checkbox" name="nuevo" class="form-check-input" value="1" <?=($producto['nuevo']??0)?'checked':''?>></div></div>
                <div class="col-md-6"><label class="form-label">Imagen Principal</label><input type="file" name="imagen_principal" class="form-control" accept="image/*"><?php if($isEdit&&$producto['imagen_principal']):?><div class="mt-2"><img src="<?=BASE_URL.$producto['imagen_principal']?>" height="80"></div><?php endif;?></div>
                <div class="col-md-6"><label class="form-label">Video (URL)</label><input type="url" name="video" class="form-control" value="<?=htmlspecialchars($producto['video']??'')?>"></div>
                <div class="col-12"><label class="form-label">Galería de Imágenes</label><input type="file" name="galeria[]" class="form-control" multiple accept="image/*"></div>
                <?php if($isEdit && !empty($galeria)):?>
                <div class="col-12">
                    <div class="row g-2">
                        <?php foreach($galeria as $g):?>
                        <div class="col-2" id="gal-<?=$g['id']?>">
                            <div class="position-relative">
                                <img src="<?=BASE_URL.$g['imagen']?>" class="img-thumbnail" style="height:100px;object-fit:cover;width:100%">
                                <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0 delete-galeria" data-id="<?=$g['id']?>" data-url="ayf-admin/productos/eliminar-galeria/" style="border-radius:50%;padding:2px 6px;font-size:10px;"><i class="bi bi-x"></i></button>
                            </div>
                        </div>
                        <?php endforeach;?>
                    </div>
                </div>
                <?php endif;?>
                <div class="col-12"><label class="form-label">Estado</label><div class="form-check form-switch"><input type="checkbox" name="estado" class="form-check-input" value="1" <?=($producto['estado']??1)?'checked':''?>></div></div>
                <div class="col-12"><button type="submit" class="btn btn-primary"><?=$isEdit?'Actualizar':'Guardar'?></button></div>
            </div>
        </form>
    </div>
</div>
<?php $content = ob_get_clean(); $title = $isEdit ? 'Editar Producto' : 'Nuevo Producto'; require __DIR__.'/ayf_layout.php'; ?>
