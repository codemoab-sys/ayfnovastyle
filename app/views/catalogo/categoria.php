<?php
/** @var array $categoria */
/** @var array $marcas */
/** @var array $productos */
/** @var array $familias */
$title = htmlspecialchars($categoria['nombre']); ob_start(); ?>
<section class="page-header bg-gradient-green text-white">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-2">
                <li class="breadcrumb-item"><a href="<?=BASE_URL?>" class="text-white-50">Inicio</a></li>
                <li class="breadcrumb-item active text-white"><?=htmlspecialchars($categoria['nombre'])?></li>
            </ol>
        </nav>
        <div class="text-center">
            <h1 class="fw-bold mb-1"><?=htmlspecialchars($categoria['nombre'])?></h1>
            <?php if($categoria['descripcion']):?><p class="mb-0 opacity-75"><?=htmlspecialchars($categoria['descripcion'])?></p><?php endif;?>
        </div>
    </div>
</section>

<section class="section-padding">
    <div class="container">
        <form method="GET" class="row g-2 mb-4">
            <div class="col-md-6">
                <div class="input-group">
                    <span class="input-group-text bg-white"><i class="bi bi-search text-muted"></i></span>
                    <input type="text" name="s" class="form-control" placeholder="Buscar en esta categoría..." value="<?=htmlspecialchars($_GET['s']??'')?>">
                    <button class="btn btn-primary">Buscar</button>
                </div>
            </div>
            <div class="col-md-4">
                <select name="marca" class="form-select" onchange="this.form.submit()">
                    <option value="">Todas las marcas</option>
                    <?php foreach ($marcas as $m): ?>
                        <option value="<?=$m['id']?>" <?=($_GET['marca']??'')==$m['id']?'selected':''?>><?=htmlspecialchars($m['nombre'])?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-2">
                <a href="<?=BASE_URL?>categoria/<?=$categoria['slug']?>" class="btn btn-outline-secondary w-100"><i class="bi bi-x-lg"></i> Limpiar</a>
            </div>
        </form>

        <?php if (empty($productos)): ?>
            <div class="text-center py-5" data-aos="fade-up">
                <i class="bi bi-inbox display-1 text-muted"></i>
                <h4 class="mt-3">No hay productos en esta categoría</h4>
                <a href="<?=BASE_URL?>" class="btn btn-primary mt-3 rounded-pill">Volver al Inicio</a>
            </div>
        <?php else: ?>
            <div class="row g-3">
                <?php foreach ($productos as $p): ?>
                    <div class="col-6 col-md-4 col-lg-3" data-aos="fade-up" data-aos-delay="<?=($p['id']%4)*60?>">
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
                                <?php if($p['marca_nombre']):?><small class="text-muted mb-2"><i class="bi bi-tag me-1"></i><?=htmlspecialchars($p['marca_nombre'])?></small><?php endif;?>
                                <p class="text-muted small flex-grow-1"><?=htmlspecialchars(substr($p['descripcion']??'',0,80))?></p>
                                <a href="<?=BASE_URL?>producto/<?=$p['id']?>" class="btn btn-outline-primary btn-sm w-100 rounded-pill">Ver Detalle</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>
<?php $content = ob_get_clean(); require __DIR__.'/layout.php'; ?>
