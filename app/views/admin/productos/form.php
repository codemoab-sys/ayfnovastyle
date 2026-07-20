<?php
/** @var array|null $producto */
/** @var array $familias */
/** @var array $marcas */
ob_start();
$isEdit = isset($producto); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><?= $isEdit ? 'Editar' : 'Nuevo' ?> Producto</h2>
    <a href="<?= BASE_URL ?>admin/productos" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Volver</a>
</div>
<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form method="POST" enctype="multipart/form-data" action="<?= $isEdit ? BASE_URL.'admin/productos/editar/'.$producto['id'] : BASE_URL.'admin/productos/crear' ?>">
            <?= csrf_field() ?>
            <ul class="nav nav-tabs mb-4" id="productTabs">
                <li class="nav-item"><a class="nav-link active" href="#general" data-bs-toggle="tab"><i class="bi bi-info-circle me-1"></i>General</a></li>
                <li class="nav-item"><a class="nav-link" href="#info" data-bs-toggle="tab"><i class="bi bi-file-text me-1"></i>Información</a></li>
                <li class="nav-item"><a class="nav-link" href="#media" data-bs-toggle="tab"><i class="bi bi-images me-1"></i>Multimedia</a></li>
                <li class="nav-item"><a class="nav-link" href="#options" data-bs-toggle="tab"><i class="bi bi-gear me-1"></i>Opciones</a></li>
            </ul>
            <div class="tab-content">
                <!-- TAB GENERAL -->
                <div class="tab-pane fade show active" id="general">
                    <div class="row g-3">
                        <div class="col-md-6"><label class="form-label">Familia *</label>
                            <select name="familia_id" class="form-select" required>
                                <option value="">Seleccionar...</option>
                                <?php foreach ($familias as $f): ?>
                                    <option value="<?=$f['id']?>" <?=($producto['familia_id']??'')==$f['id']?'selected':''?>><?=htmlspecialchars($f['nombre'])?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6"><label class="form-label">Marca</label>
                            <select name="marca_id" class="form-select">
                                <option value="">N/A - Ninguna</option>
                                <?php foreach ($marcas as $m): ?>
                                    <option value="<?=$m['id']?>" <?=($producto['marca_id']??'')==$m['id']?'selected':''?>><?=htmlspecialchars($m['nombre'])?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-4"><label class="form-label">Código</label><input type="text" name="codigo" class="form-control" value="<?=htmlspecialchars($producto['codigo']??'')?>"></div>
                        <div class="col-md-4"><label class="form-label">SKU</label><input type="text" name="sku" class="form-control" value="<?=htmlspecialchars($producto['sku']??'')?>"></div>
                        <div class="col-md-4"><label class="form-label">Orden</label><input type="number" name="orden" class="form-control" value="<?=$producto['orden']??0?>"></div>
                        <div class="col-md-6"><label class="form-label">Nombre Comercial *</label><input type="text" name="nombre_comercial" class="form-control" value="<?=htmlspecialchars($producto['nombre_comercial']??'')?>" required></div>
                        <div class="col-md-6"><label class="form-label">Nombre del Producto *</label><input type="text" name="nombre_producto" class="form-control" value="<?=htmlspecialchars($producto['nombre_producto']??'')?>" required></div>
                    </div>
                </div>
                <!-- TAB INFORMACIÓN -->
                <div class="tab-pane fade" id="info">
                    <div class="row g-3">
                        <div class="col-12"><label class="form-label">Descripción</label><textarea name="descripcion" class="form-control" rows="3"><?=htmlspecialchars($producto['descripcion']??'')?></textarea></div>
                        <div class="col-md-6"><label class="form-label">Composición</label><textarea name="composicion" class="form-control" rows="2"><?=htmlspecialchars($producto['composicion']??'')?></textarea></div>
                        <div class="col-md-6"><label class="form-label">Materiales</label><textarea name="materiales" class="form-control" rows="2"><?=htmlspecialchars($producto['materiales']??'')?></textarea></div>
                        <div class="col-md-6"><label class="form-label">Presentación</label><input type="text" name="presentacion" class="form-control" value="<?=htmlspecialchars($producto['presentacion']??'')?>"></div>
                        <div class="col-md-6"><label class="form-label">Beneficios</label><textarea name="beneficios" class="form-control" rows="2"><?=htmlspecialchars($producto['beneficios']??'')?></textarea></div>
                        <div class="col-md-6"><label class="form-label">Modo de Uso</label><textarea name="modo_uso" class="form-control" rows="2"><?=htmlspecialchars($producto['modo_uso']??'')?></textarea></div>
                        <div class="col-md-6"><label class="form-label">Indicaciones</label><textarea name="indicaciones" class="form-control" rows="2"><?=htmlspecialchars($producto['indicaciones']??'')?></textarea></div>
                        <div class="col-md-6"><label class="form-label">Contraindicaciones</label><textarea name="contraindicaciones" class="form-control" rows="2"><?=htmlspecialchars($producto['contraindicaciones']??'')?></textarea></div>
                        <div class="col-md-4"><label class="form-label">Registro Sanitario</label><input type="text" name="registro_sanitario" class="form-control" value="<?=htmlspecialchars($producto['registro_sanitario']??'')?>"></div>
                        <div class="col-md-4"><label class="form-label">Laboratorio</label><input type="text" name="laboratorio" class="form-control" value="<?=htmlspecialchars($producto['laboratorio']??'')?>"></div>
                        <div class="col-md-4"><label class="form-label">País de Origen</label><input type="text" name="pais_origen" class="form-control" value="<?=htmlspecialchars($producto['pais_origen']??'')?>"></div>
                    </div>
                </div>
                <!-- TAB MULTIMEDIA -->
                <div class="tab-pane fade" id="media">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Imagen Principal</label>
                            <div class="dropzone"><i class="bi bi-cloud-arrow-up"></i><p class="mb-0 mt-2">Arrastra o selecciona</p><input type="file" name="imagen_principal" accept="image/*" style="display:none"></div>
                            <?php if ($isEdit && $producto['imagen_principal']): ?>
                                <div class="mt-2"><img src="<?=BASE_URL.$producto['imagen_principal']?>" height="60" class="rounded"></div>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Ficha Técnica (PDF)</label>
                            <input type="file" name="ficha_tecnica" class="form-control" accept=".pdf">
                            <?php if ($isEdit && $producto['ficha_tecnica']): ?>
                                <div class="mt-2"><a href="<?=BASE_URL.$producto['ficha_tecnica']?>" target="_blank" class="btn btn-sm btn-outline-danger"><i class="bi bi-file-pdf"></i> Ver PDF</a></div>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-6"><label class="form-label">Video Youtube (URL)</label><input type="text" name="video" class="form-control" value="<?=htmlspecialchars($producto['video']??'')?>" placeholder="https://www.youtube.com/watch?v=..."></div>
                        <div class="col-12">
                            <label class="form-label">Galería de Imágenes (subir múltiples)</label>
                            <div class="dropzone" id="galeriaDropzone">
                                <i class="bi bi-images"></i>
                                <p class="mb-0 mt-2">Arrastra imágenes o haz clic para seleccionar</p>
                                <small class="text-muted">Puedes seleccionar varias a la vez</small>
                                <input type="file" name="galeria[]" accept="image/*" multiple style="display:none">
                                <div class="dropzone-preview row g-2 mt-3"></div>
                            </div>
                            <?php if ($isEdit && !empty($galeria)): ?>
                                <div class="mt-3"><strong>Imágenes actuales:</strong>
                                    <div class="d-flex gap-2 flex-wrap mt-2">
                                        <?php foreach ($galeria as $g): ?>
                                            <div class="position-relative" style="width:100px;height:100px;">
                                                <img src="<?=BASE_URL.$g['imagen']?>" style="width:100%;height:100%;object-fit:cover;border-radius:8px;">
                                                <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0 del-galeria" data-id="<?=$g['id']?>" style="width:22px;height:22px;padding:0;font-size:10px;border-radius:50%;">&times;</button>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <!-- TAB OPCIONES -->
                <div class="tab-pane fade" id="options">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <div class="form-check form-switch mt-4">
                                <input class="form-check-input" type="checkbox" name="destacado" value="1" id="destacado" <?=($producto['destacado']??0)?'checked':''?>>
                                <label class="form-check-label" for="destacado">Producto Destacado</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check form-switch mt-4">
                                <input class="form-check-input" type="checkbox" name="nuevo" value="1" id="nuevo" <?=($producto['nuevo']??0)?'checked':''?>>
                                <label class="form-check-label" for="nuevo">Producto Nuevo</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check form-switch mt-4">
                                <input class="form-check-input" type="checkbox" name="estado" value="1" id="estado" <?=($producto['estado']??1)?'checked':''?>>
                                <label class="form-check-label" for="estado">Activo</label>
                            </div>
                        </div>
                        <div class="col-md-3"><label class="form-label">Peso (kg)</label><input type="number" step="0.01" name="peso" class="form-control" value="<?=$producto['peso']??''?>"></div>
                        <div class="col-md-3"><label class="form-label">Alto (cm)</label><input type="number" step="0.01" name="alto" class="form-control" value="<?=$producto['alto']??''?>"></div>
                        <div class="col-md-3"><label class="form-label">Ancho (cm)</label><input type="number" step="0.01" name="ancho" class="form-control" value="<?=$producto['ancho']??''?>"></div>
                        <div class="col-md-3"><label class="form-label">Largo (cm)</label><input type="number" step="0.01" name="largo" class="form-control" value="<?=$producto['largo']??''?>"></div>
                        <div class="col-12 mt-4">
                            <button type="submit" class="btn btn-primary btn-lg px-5"><?=$isEdit?'Actualizar':'Guardar'?> Producto</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<?php
$content = ob_get_clean();
$title = $isEdit ? 'Editar Producto' : 'Nuevo Producto';
require __DIR__ . '/../layout.php';
?>
