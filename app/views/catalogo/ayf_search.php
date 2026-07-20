<?php $title = 'Buscar Productos'; $c = $_AYF ?? []; ob_start(); ?>
<section class="page-header bg-light py-4">
    <div class="container">
        <nav aria-label="breadcrumb"><ol class="breadcrumb mb-0"><li class="breadcrumb-item"><a href="<?=BASE_URL?>ayf">Inicio</a></li><li class="breadcrumb-item active">Productos</li></ol></nav>
    </div>
</section>
<section class="section-padding" style="padding-top:40px;">
    <div class="container">
        <div class="text-center mb-5"><h2 class="fw-bold">Productos</h2></div>
        <div class="row mb-4">
            <div class="col-lg-10 mx-auto">
                <form method="GET" action="<?=BASE_URL?>ayf/buscar" class="row g-2">
                    <div class="col-md-4"><input type="text" name="q" class="form-control form-control-lg" placeholder="Buscar producto..." value="<?=htmlspecialchars($search)?>"></div>
                    <div class="col-md-3"><select name="categoria" class="form-select form-select-lg"><option value="">Todas las categorías</option><?php foreach($categorias as $c):?><option value="<?=$c['id']?>" <?=$selectedCategoria==$c['id']?'selected':''?>><?=htmlspecialchars($c['nombre'])?></option><?php endforeach;?></select></div>
                    <div class="col-md-3"><select name="marca" class="form-select form-select-lg"><option value="">Todas las marcas</option><?php foreach($marcas as $m):?><option value="<?=$m['id']?>" <?=$selectedMarca==$m['id']?'selected':''?>><?=htmlspecialchars($m['nombre'])?></option><?php endforeach;?></select></div>
                    <div class="col-md-2"><button type="submit" class="btn btn-primary btn-lg w-100"><i class="bi bi-search"></i></button></div>
                </form>
            </div>
        </div>
        <?php if ($total > 0): ?><p class="text-muted text-center"><?=$total?> producto(s) encontrado(s)</p><?php endif; ?>
        <div class="row g-3" id="productGrid">
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
        </div>
        <?php if ($totalPages > 1): ?>
        <div class="d-flex justify-content-center mt-4">
            <nav><ul class="pagination">
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <li class="page-item <?=$i==$currentPage?'active':''?>"><a class="page-link" href="?q=<?=urlencode($search)?>&categoria=<?=$selectedCategoria?>&marca=<?=$selectedMarca?>&page=<?=$i?>"><?=$i?></a></li>
                <?php endfor; ?>
            </ul></nav>
        </div>
        <?php endif; ?>
    </div>
</section>
<?php $content = ob_get_clean(); require __DIR__.'/ayf_layout.php'; ?>
