<?php $title = htmlspecialchars($categoria['nombre']); $c = $_AYF ?? []; ob_start(); ?>
<section class="page-header bg-light py-4">
    <div class="container">
        <nav aria-label="breadcrumb"><ol class="breadcrumb mb-0"><li class="breadcrumb-item"><a href="<?=BASE_URL?>ayf">Inicio</a></li><li class="breadcrumb-item active"><?=htmlspecialchars($categoria['nombre'])?></li></ol></nav>
    </div>
</section>
<section class="section-padding">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold"><?=htmlspecialchars($categoria['nombre'])?></h2>
            <?php if ($categoria['descripcion']): ?><p class="text-muted"><?=htmlspecialchars($categoria['descripcion'])?></p><?php endif; ?>
        </div>
        <div class="row mb-4">
            <div class="col-md-8 mx-auto">
                <form method="GET" class="row g-2">
                    <div class="col-md-6"><input type="text" name="s" class="form-control" placeholder="Buscar..." value="<?=htmlspecialchars($_GET['s']??'')?>"></div>
                    <div class="col-md-4"><select name="marca" class="form-select"><option value="">Todas las marcas</option><?php foreach($marcas as $m):?><option value="<?=$m['id']?>" <?=($_GET['marca']??'')==$m['id']?'selected':''?>><?=htmlspecialchars($m['nombre'])?></option><?php endforeach;?></select></div>
                    <div class="col-md-2"><button type="submit" class="btn btn-primary w-100">Filtrar</button></div>
                </form>
            </div>
        </div>
        <?php if (empty($productos)): ?>
        <div class="text-center py-5"><i class="bi bi-box display-1 text-muted"></i><h4 class="mt-3">No hay productos en esta categoría</h4></div>
        <?php else: ?>
        <div class="row g-3">
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
                        <small class="text-muted mb-2"><i class="bi bi-tag me-1"></i><?=htmlspecialchars($p['marca_nombre']??'')?></small>
                        <?php if ($p['precio']): ?><h5 class="text-danger fw-bold mt-auto">S/ <?=number_format($p['precio'],2)?><?php if ($p['precio_anterior'] > $p['precio']): ?> <small class="text-muted text-decoration-line-through fs-6">S/ <?=number_format($p['precio_anterior'],2)?></small><?php endif; ?></h5><?php endif; ?>
                        <a href="<?=BASE_URL?>ayf/producto/<?=$p['id']?>" class="btn btn-outline-primary btn-sm w-100 rounded-pill mt-2">Ver Detalle</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</section>
<?php $content = ob_get_clean(); require __DIR__.'/ayf_layout.php'; ?>
