<p class="text-muted mb-3"><?=$total?> resultado(s) — Página <?=$currentPage?> de <?=$totalPages?></p>

<?php if (empty($productos)): ?>
    <div class="text-center py-5">
        <i class="bi bi-search display-1 text-muted"></i>
        <h4 class="mt-3">No se encontraron productos</h4>
        <a href="<?=BASE_URL?>buscar" class="btn btn-primary mt-3 rounded-pill">Limpiar Filtros</a>
    </div>
<?php else: ?>
    <div class="row g-3">
        <?php foreach ($productos as $p): ?>
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card product-card border-0 shadow-sm h-100">
                    <div class="position-relative overflow-hidden">
                        <?php if($p['nuevo']):?><span class="badge bg-danger position-absolute top-0 end-0 m-2 z-1">Nuevo</span><?php endif;?>
                        <a href="<?=BASE_URL?>producto/<?=$p['id']?>">
                            <?php if($p['imagen_principal']):?><img src="<?=BASE_URL.$p['imagen_principal']?>" class="card-img-top" alt="<?=htmlspecialchars($p['nombre_comercial'])?>" loading="lazy">
                            <?php else:?><div class="bg-light d-flex align-items-center justify-content-center" style="height:200px"><i class="bi bi-image text-muted display-4"></i></div><?php endif;?>
                        </a>
                    </div>
                    <div class="card-body d-flex flex-column">
                        <small class="text-primary fw-bold"><?=htmlspecialchars($p['codigo']??'')?></small>
                        <h6 class="fw-bold mt-1"><?=htmlspecialchars($p['nombre_comercial'])?></h6>
                        <small class="text-muted mb-2"><?=htmlspecialchars($p['familia_nombre']??'')?><?=$p['marca_nombre']?' | '.htmlspecialchars($p['marca_nombre']):''?></small>
                        <p class="text-muted small flex-grow-1"><?=htmlspecialchars(substr($p['descripcion']??'',0,80))?></p>
                        <a href="<?=BASE_URL?>producto/<?=$p['id']?>" class="btn btn-outline-primary btn-sm w-100 rounded-pill">Ver Detalle</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <?php if ($totalPages > 1): ?>
    <div class="d-flex justify-content-center align-items-center gap-2 mt-4">
        <?php
        $buildUrl = function($p) use ($search, $selectedFamilia, $selectedMarca) {
            $params = ['page' => $p];
            if ($search) $params['q'] = $search;
            if ($selectedFamilia) $params['familia'] = $selectedFamilia;
            if ($selectedMarca) $params['marca'] = $selectedMarca;
            return BASE_URL . 'buscar?' . http_build_query($params);
        };
        ?>
        <a href="<?=$buildUrl($currentPage-1)?>" class="btn btn-outline-primary btn-sm rounded-circle px-2 search-page-link <?=$currentPage<=1?'disabled':''?>"><i class="bi bi-chevron-left"></i></a>
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <a href="<?=$buildUrl($i)?>" class="btn btn-sm rounded-circle px-2 search-page-link <?=$i==$currentPage?'btn-primary':'btn-outline-primary'?>"><?=$i?></a>
        <?php endfor; ?>
        <a href="<?=$buildUrl($currentPage+1)?>" class="btn btn-outline-primary btn-sm rounded-circle px-2 search-page-link <?=$currentPage>=$totalPages?'disabled':''?>"><i class="bi bi-chevron-right"></i></a>
    </div>
    <?php endif; ?>
<?php endif; ?>
