<style>
.lg-close { background:rgba(0,0,0,0.5) !important; border-radius:50% !important; width:44px !important; height:44px !important; display:flex !important; align-items:center !important; justify-content:center !important; margin:10px !important; }
.lg-close::after { content:'\\2715'; font-size:22px; color:#fff; line-height:1; }
.lg-toolbar .lg-icon { background:rgba(0,0,0,0.5) !important; border-radius:50% !important; margin:5px !important; width:40px !important; height:40px !important; display:inline-flex !important; align-items:center !important; justify-content:center !important; }
</style>
<?php $title = htmlspecialchars($producto['nombre']); $c = $_AYF ?? []; ob_start(); ?>
<section class="page-header bg-light py-4">
    <div class="container">
        <nav aria-label="breadcrumb"><ol class="breadcrumb mb-0"><li class="breadcrumb-item"><a href="<?=BASE_URL?>ayf">Inicio</a></li><li class="breadcrumb-item"><a href="<?=BASE_URL?>ayf/categoria/<?=$producto['categoria_slug']?>"><?=htmlspecialchars($producto['categoria_nombre'])?></a></li><li class="breadcrumb-item active"><?=htmlspecialchars($producto['nombre'])?></li></ol></nav>
    </div>
</section>
<section class="section-padding">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-6">
                <div id="lightgallery">
                    <div class="position-relative">
                        <?php if ($producto['nuevo']): ?><span class="badge bg-danger position-absolute top-0 end-0 m-3 z-1 fs-6">Nuevo</span><?php endif; ?>
                        <?php if ($producto['imagen_principal']): ?>
                            <a href="<?=BASE_URL.$producto['imagen_principal']?>" class="gallery-item" data-sub-html="<?=htmlspecialchars($producto['nombre'])?>">
                                <img src="<?=BASE_URL.$producto['imagen_principal']?>" class="img-fluid rounded-3 w-100" alt="<?=htmlspecialchars($producto['nombre'])?>" style="max-height:500px;object-fit:cover;">
                            </a>
                        <?php else: ?><div class="bg-light d-flex align-items-center justify-content-center rounded-3" style="height:400px"><i class="bi bi-image text-muted display-1"></i></div><?php endif; ?>
                    </div>
                    <?php if (!empty($galeria)): ?>
                    <div class="row g-2 mt-3">
                        <?php foreach ($galeria as $g): ?>
                        <div class="col-3"><a href="<?=BASE_URL.$g['imagen']?>" class="gallery-item" data-sub-html="<?=htmlspecialchars($producto['nombre'])?>"><img src="<?=BASE_URL.$g['imagen']?>" class="img-fluid rounded-2" style="height:100px;width:100%;object-fit:cover;cursor:pointer"></a></div>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-lg-6">
                <small class="text-primary fw-bold"><?=htmlspecialchars($producto['codigo']??'')?></small>
                <h2 class="fw-bold display-6"><?=htmlspecialchars($producto['nombre'])?></h2>
                <?php if ($producto['marca_nombre']): ?><p class="text-muted"><i class="bi bi-tag me-1"></i>Marca: <strong><?=htmlspecialchars($producto['marca_nombre'])?></strong></p><?php endif; ?>
                <?php if ($producto['precio']): ?><h2 class="text-danger fw-bold mb-3">S/ <?=number_format($producto['precio'],2)?><?php if ($producto['precio_anterior'] > $producto['precio']): ?> <small class="text-muted text-decoration-line-through fs-4">S/ <?=number_format($producto['precio_anterior'],2)?></small><?php endif; ?></h2><?php endif; ?>
                <?php if ($producto['descripcion']): ?><p class="text-muted"><?=nl2br(htmlspecialchars($producto['descripcion']))?></p><?php endif; ?>
                <div class="row g-3 mt-3">
                    <?php if ($producto['material']): ?><div class="col-6"><strong>Material:</strong> <?=htmlspecialchars($producto['material'])?></div><?php endif; ?>
                    <?php if ($producto['genero']): ?><div class="col-6"><strong>Género:</strong> <?=htmlspecialchars($producto['genero'])?></div><?php endif; ?>
                    <?php if ($producto['tallas']): ?><div class="col-12"><strong>Tallas:</strong> <?=htmlspecialchars($producto['tallas'])?></div><?php endif; ?>
                    <?php if ($producto['colores']): ?><div class="col-12"><strong>Colores:</strong> <?=htmlspecialchars($producto['colores'])?></div><?php endif; ?>
                    <?php if ($producto['stock'] !== null): ?><div class="col-6"><strong>Stock:</strong> <?=$producto['stock']?> unidades</div><?php endif; ?>
                </div>
                <div class="mt-4 d-flex gap-2">
                    <a href="https://wa.me/<?= htmlspecialchars($c['whatsapp']??'51995218178') ?>?text=<?= urlencode('Hola, quiero información sobre '.$producto['nombre']) ?>" target="_blank" class="btn btn-success btn-lg flex-fill"><i class="bi bi-whatsapp me-2"></i>Consultar por WhatsApp</a>
                </div>
            </div>
        </div>
    </div>
</section>
<?php if (!empty($relacionados)): ?>
<section class="section-padding bg-light">
    <div class="container">
        <div class="text-center mb-5"><h3 class="fw-bold">Productos Relacionados</h3></div>
        <div class="row g-3">
            <?php foreach ($relacionados as $p): ?>
            <div class="col-6 col-md-3">
                <div class="card product-card border-0 shadow-sm h-100">
                    <a href="<?=BASE_URL?>ayf/producto/<?=$p['id']?>">
                        <?php if ($p['imagen_principal']): ?><img src="<?=BASE_URL.$p['imagen_principal']?>" class="card-img-top" alt="<?=htmlspecialchars($p['nombre'])?>">
                        <?php else: ?><div class="bg-light d-flex align-items-center justify-content-center" style="height:180px"><i class="bi bi-image text-muted display-4"></i></div><?php endif; ?>
                    </a>
                    <div class="card-body">
                        <h6 class="fw-bold"><?=htmlspecialchars($p['nombre'])?></h6>
                        <?php if ($p['precio']): ?><h6 class="text-danger fw-bold">S/ <?=number_format($p['precio'],2)?></h6><?php endif; ?>
                        <a href="<?=BASE_URL?>ayf/producto/<?=$p['id']?>" class="btn btn-outline-primary btn-sm w-100 rounded-pill">Ver</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>
<?php $content = ob_get_clean(); require __DIR__.'/ayf_layout.php'; ?>
