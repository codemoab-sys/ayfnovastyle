<?php if (empty($productos)): ?>
<div class="col-12 text-center py-5"><i class="bi bi-search display-1 text-muted"></i><h4 class="mt-3">No se encontraron productos</h4></div>
<?php else: ?>
<?php foreach ($productos as $p): ?>
<div class="col-6 col-md-4 col-lg-3">
    <div class="card product-card border-0 shadow-sm h-100">
        <div class="position-relative">
            <?php if ($p['nuevo']): ?><span class="badge bg-danger position-absolute top-0 end-0 m-2 z-1">Nuevo</span><?php endif; ?>
            <a href="<?=BASE_URL?>ayf/producto/<?=$p['id']?>">
                <?php if ($p['imagen_principal']): ?><img src="<?=BASE_URL.$p['imagen_principal']?>" class="card-img-top" alt="<?=htmlspecialchars($p['nombre'])?>" loading="lazy">
                <?php else: ?><div class="bg-light d-flex align-items-center justify-content-center" style="height:200px"><i class="bi bi-image text-muted display-4"></i></div><?php endif; ?>
            </a>
        </div>
        <div class="card-body d-flex flex-column">
            <h6 class="fw-bold"><?=htmlspecialchars($p['nombre'])?></h6>
            <small class="text-muted"><?=htmlspecialchars($p['categoria_nombre']??'')?> <?=$p['marca_nombre']?'| '.htmlspecialchars($p['marca_nombre']):''?></small>
            <?php if ($p['precio']): ?><h5 class="text-danger fw-bold mt-auto">S/ <?=number_format($p['precio'],2)?></h5><?php endif; ?>
            <a href="<?=BASE_URL?>ayf/producto/<?=$p['id']?>" class="btn btn-outline-primary btn-sm w-100 rounded-pill mt-2">Ver Detalle</a>
        </div>
    </div>
</div>
<?php endforeach; ?>
<?php endif; ?>
