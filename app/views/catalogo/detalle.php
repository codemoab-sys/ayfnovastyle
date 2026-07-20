<?php
/** @var array $producto */
/** @var array $galeria */
/** @var array $relacionados */
/** @var array $familias */
$title = htmlspecialchars($producto['nombre_comercial']); ob_start(); ?>
<section class="page-header bg-gradient-green text-white">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-2 justify-content-center text-center">
                <li class="breadcrumb-item"><a href="<?=BASE_URL?>" class="text-white-50">Inicio</a></li>
                <li class="breadcrumb-item"><a href="<?=BASE_URL?>categoria/<?=$producto['familia_slug']??$producto['familia_id']?>" class="text-white-50"><?=htmlspecialchars($producto['familia_nombre']??'')?></a></li>
                <li class="breadcrumb-item active text-white"><?=htmlspecialchars($producto['nombre_comercial'])?></li>
            </ol>
        </nav>
        <div class="text-center">
            <div class="d-flex align-items-center justify-content-center gap-2 flex-wrap">
                <h1 class="fw-bold mb-0" style="font-size:clamp(1.35rem, 4.5vw, 1.75rem)"><?=htmlspecialchars($producto['nombre_comercial'])?></h1>
                <?php if($producto['nuevo']):?><span class="badge bg-danger">Nuevo</span><?php endif;?>
                <?php if($producto['destacado']):?><span class="badge bg-warning text-dark">Destacado</span><?php endif;?>
            </div>
            <small class="opacity-75 d-block mt-1">Código: <strong><?=htmlspecialchars($producto['codigo']??'N/A')?></strong> <?=$producto['sku']?'| SKU: <strong>'.htmlspecialchars($producto['sku']).'</strong>':''?></small>
        </div>
    </div>
</section>

<section class="section-padding">
    <div class="container">
        <div class="row g-3 g-lg-4">
            <!-- Gallery -->
            <div class="col-12 col-lg-6">
                <div class="product-gallery" id="lightgallery">
                    <?php if ($producto['imagen_principal']): ?>
                        <a href="<?=BASE_URL.$producto['imagen_principal']?>" class="gallery-item main-image d-block">
                            <img src="<?=BASE_URL.$producto['imagen_principal']?>" class="img-fluid rounded-3 w-100" alt="<?=htmlspecialchars($producto['nombre_comercial'])?>" style="height:clamp(220px, 70vw, 300px);object-fit:contain;background:#f8f9fa;">
                        </a>
                    <?php else: ?>
                        <div class="bg-light d-flex align-items-center justify-content-center rounded-3" style="height:clamp(220px, 70vw, 300px)"><i class="bi bi-image text-muted display-1"></i></div>
                    <?php endif; ?>
                    <?php if (!empty($galeria) || $producto['imagen_principal']): ?>
                    <div class="gallery-thumbs mt-2 d-flex gap-2 flex-wrap justify-content-center">
                        <?php if($producto['imagen_principal']):?>
                            <a href="<?=BASE_URL.$producto['imagen_principal']?>" class="gallery-item thumb active"><img src="<?=BASE_URL.$producto['imagen_principal']?>" alt="" style="height:55px;width:70px;object-fit:cover;border-radius:8px;" class="img-fluid"></a>
                        <?php endif;?>
                        <?php foreach ($galeria as $g): ?>
                            <a href="<?=BASE_URL.$g['imagen']?>" class="gallery-item thumb"><img src="<?=BASE_URL.$g['imagen']?>" alt="" style="height:55px;width:70px;object-fit:cover;border-radius:8px;" class="img-fluid"></a>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Info -->
            <div class="col-12 col-lg-6">
                <div class="product-info text-center">
                    <div class="d-flex align-items-center justify-content-center gap-2 mb-2 flex-wrap">
                        <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill"><?=htmlspecialchars($producto['codigo']??'')?></span>
                        <?php $mn = $producto['marca_nombre'] ?? ''; if($mn && strtoupper($mn) !== 'NA' && strtoupper($mn) !== 'N/A'):?><span class="badge bg-secondary bg-opacity-10 text-secondary rounded-pill"><i class="bi bi-tag me-1"></i><?=htmlspecialchars($mn)?></span><?php endif;?>
                        <span class="badge bg-success bg-opacity-10 text-success rounded-pill"><?=htmlspecialchars($producto['familia_nombre']??'')?></span>
                    </div>

                    <h2 class="fw-bold mb-1 fs-4"><?=htmlspecialchars($producto['nombre_comercial'])?></h2>
                    <?php if($producto['nombre_producto'] && $producto['nombre_producto'] != $producto['nombre_comercial']):?>
                        <p class="text-muted small mb-3"><?=htmlspecialchars($producto['nombre_producto'])?></p>
                    <?php endif;?>

                    <?php if($producto['descripcion']):?>
                        <div class="mb-4"><h6 class="fw-bold small text-uppercase text-muted">Descripción</h6><p class="small"><?=nl2br(htmlspecialchars($producto['descripcion']))?></p></div>
                    <?php endif;?>

                    <div class="row g-2 mb-4">
                        <?php foreach ([
                            'composicion' => ['flask','Composición'], 'materiales' => ['box','Materiales'],
                            'presentacion' => ['box-seam','Presentación'], 'beneficios' => ['star','Beneficios'],
                            'modo_uso' => ['hand-index','Modo de Uso'], 'indicaciones' => ['heart-pulse','Indicaciones'],
                            'contraindicaciones' => ['exclamation-triangle','Contraindicaciones'],
                            'laboratorio' => ['biotech','Laboratorio'], 'registro_sanitario' => ['shield-check','Registro Sanitario'],
                            'pais_origen' => ['geo-alt','País de Origen']
                        ] as $campo => $info): ?>
                            <?php $val = $producto[$campo] ?? ''; if($val && strtoupper($val) !== 'NA' && strtoupper($val) !== 'N/A'):?>
                                <div class="col-12 col-sm-6">
                                    <div class="info-card p-3 bg-light rounded-3 h-100">
                                        <i class="bi bi-<?=$info[0]?> text-primary fs-4 mb-1 d-block"></i>
                                        <h6 class="fw-bold small text-uppercase mb-1"><?=$info[1]?></h6>
                                        <p class="small text-muted mb-0"><?=nl2br(htmlspecialchars($val))?></p>
                                    </div>
                                </div>
                            <?php endif;?>
                        <?php endforeach; ?>
                    </div>

                    <?php if($producto['video']):?>
                        <div class="mb-4">
                            <h6 class="fw-bold"><i class="bi bi-play-circle me-1"></i> Video</h6>
                            <div class="ratio ratio-16x9">
                                <iframe src="https://www.youtube.com/embed/<?=preg_replace('/^.*(?:youtu\.be\/|v\/|embed\/|watch\?v=)([a-zA-Z0-9_-]{11}).*$/', '$1', $producto['video'])?>" allowfullscreen></iframe>
                            </div>
                        </div>
                    <?php endif;?>

                    <div class="d-flex flex-column flex-sm-row gap-2 justify-content-center">
                        <a href="https://wa.me/<?=WHATSAPP?>?text=<?=urlencode('Hola, quisiera cotizar: '.$producto['nombre_comercial'].' ('.$producto['codigo'].')')?>" target="_blank" class="btn btn-success rounded-pill px-4 py-2 w-100 w-sm-auto"><i class="bi bi-whatsapp me-2"></i>Solicitar Cotización</a>
                        <?php if($producto['ficha_tecnica']):?>
                            <a href="<?=BASE_URL.$producto['ficha_tecnica']?>" target="_blank" class="btn btn-outline-danger rounded-pill px-4 py-2 w-100 w-sm-auto"><i class="bi bi-file-pdf me-2"></i>Ficha Técnica</a>
                        <?php endif;?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php if ($relacionados): ?>
<section class="section-padding bg-light">
    <div class="container">
        <div class="text-center mb-4 mb-md-5"><h3 class="fw-bold fs-4">Productos Relacionados</h3></div>
        <div class="row g-2 g-md-3">
            <?php foreach ($relacionados as $r): ?>
                <div class="col-6 col-md-4 col-lg-3" data-aos="fade-up">
                    <div class="card product-card border-0 shadow-sm h-100">
                        <a href="<?=BASE_URL?>producto/<?=$r['id']?>">
                            <?php if($r['imagen_principal']):?><img src="<?=BASE_URL.$r['imagen_principal']?>" class="card-img-top" alt="<?=htmlspecialchars($r['nombre_comercial'])?>" loading="lazy" style="height:140px;object-fit:cover;">
                            <?php else:?><div class="bg-light d-flex align-items-center justify-content-center" style="height:140px"><i class="bi bi-image text-muted display-5"></i></div><?php endif;?>
                        </a>
                        <div class="card-body p-2 p-md-3">
                            <small class="text-primary fw-bold"><?=htmlspecialchars($r['codigo']??'')?></small>
                            <h6 class="fw-bold mt-1 small"><?=htmlspecialchars($r['nombre_comercial'])?></h6>
                            <a href="<?=BASE_URL?>producto/<?=$r['id']?>" class="btn btn-outline-primary btn-sm w-100 rounded-pill">Ver</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>
<?php $content = ob_get_clean(); require __DIR__.'/layout.php'; ?>
