<?php $title = 'Inicio'; ob_start(); ?>
<section class="hero-section">
    <div class="swiper heroSwiper">
        <div class="swiper-wrapper">
            <?php if (!empty($banners)): ?>
                <?php foreach ($banners as $b): ?>
                    <div class="swiper-slide">
                        <div class="hero-slide" style="<?=$b['imagen']?'background-image:url('.BASE_URL.$b['imagen'].')':'background:linear-gradient(135deg,#009933,#00b33c)'?>">
                            <div class="hero-overlay"></div>
                            <div class="container hero-content">
                                <h1 data-aos="fade-up" data-aos-duration="1000"><?=htmlspecialchars($b['titulo']??'')?></h1>
                                <p data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200"><?=htmlspecialchars($b['subtitulo']??SITE_DESC)?></p>
                                <div data-aos="fade-up" data-aos-duration="1000" data-aos-delay="400">
                                    <a href="<?=BASE_URL?>buscar" class="btn btn-primary btn-lg me-2">Ver Catálogo</a>
                                    <a href="https://wa.me/<?=WHATSAPP?>?text=<?=urlencode(WHATSAPP_MSG)?>" target="_blank" class="btn btn-outline-light btn-lg"><i class="bi bi-whatsapp me-2"></i>Cotizar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="swiper-slide">
                    <div class="hero-slide" style="background:linear-gradient(135deg,#009933,#00b33c)">
                        <div class="hero-overlay"></div>
                        <div class="container hero-content">
                            <h1 data-aos="fade-up">Al servicio de la salud</h1>
                            <p data-aos="fade-up" data-aos-delay="200"><?=SITE_DESC?></p>
                            <div data-aos="fade-up" data-aos-delay="400">
                                <a href="<?=BASE_URL?>buscar" class="btn btn-primary btn-lg me-2">Ver Catálogo</a>
                                <a href="https://wa.me/<?=WHATSAPP?>?text=<?=urlencode(WHATSAPP_MSG)?>" target="_blank" class="btn btn-outline-light btn-lg"><i class="bi bi-whatsapp me-2"></i>Cotizar</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <div class="swiper-pagination"></div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
</section>

<section class="section-padding" data-aos="fade-up">
    <div class="container">
        <div class="text-center mb-5">
            <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 mb-2 rounded-pill">Categorías</span>
            <h2 class="fw-bold">Familias de Productos</h2>
            <p class="text-muted">Explora nuestras categorías especializadas</p>
        </div>
        <div class="row mb-3">
            <div class="col-md-5 mx-auto">
                <div class="input-group">
                    <span class="input-group-text bg-white"><i class="bi bi-search text-muted"></i></span>
                    <input type="text" id="familiaSearch" class="form-control" placeholder="Buscar familia..." autocomplete="off">
                </div>
            </div>
        </div>
        <div class="row g-3" id="familiasGrid">
            <?php foreach ($familias as $i => $f): ?>
                <div class="col-6 col-md-4 col-lg-3 familia-item" data-nombre="<?=htmlspecialchars(mb_strtolower($f['nombre'], 'UTF-8'))?>" data-index="<?=$i?>" data-aos="fade-up" data-aos-delay="<?=($f['orden']%4)*50?>">
                    <a href="<?=BASE_URL?>categoria/<?=$f['slug']?>" class="text-decoration-none">
                        <div class="card familia-card border-0 shadow-sm h-100">
                            <div class="card-body text-center p-4">
                                <div class="familia-icon mb-3">
                                    <?php if ($f['icono']): ?><img src="<?=BASE_URL.$f['icono']?>" alt="<?=htmlspecialchars($f['nombre'])?>" height="55">
                                    <?php else: ?><i class="bi bi-box-seam"></i><?php endif; ?>
                                </div>
                                <h6 class="fw-bold mb-1"><?=htmlspecialchars($f['nombre'])?></h6>
                                <?php if ($f['descripcion']): ?><small class="text-muted"><?=htmlspecialchars(substr($f['descripcion'],0,60))?></small><?php endif; ?>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
        <?php $totalFamilias = count($familias); if ($totalFamilias > 12): ?>
        <div class="d-flex justify-content-center align-items-center gap-2 mt-4" id="familiasPagination">
            <button class="btn btn-outline-primary btn-sm rounded-circle px-2" id="famPrevPage" disabled><i class="bi bi-chevron-left"></i></button>
            <span class="small text-muted mx-2" id="famPageInfo">1 / <?=ceil($totalFamilias/12)?></span>
            <button class="btn btn-outline-primary btn-sm rounded-circle px-2" id="famNextPage"><i class="bi bi-chevron-right"></i></button>
        </div>
        <?php endif; ?>
    </div>
</section>

<?php if ($destacados): ?>
<section class="section-padding bg-light" data-aos="fade-up">
    <div class="container">
        <div class="text-center mb-5">
            <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 mb-2 rounded-pill">Destacados</span>
            <h2 class="fw-bold">Productos Destacados</h2>
            <p class="text-muted">Los productos más solicitados</p>
        </div>
        <div class="row g-3">
            <?php foreach ($destacados as $p): ?>
                <div class="col-6 col-md-4 col-lg-3" data-aos="fade-up" data-aos-delay="<?=($p['id']%4)*80?>">
                    <div class="card product-card border-0 shadow-sm h-100">
                        <div class="position-relative overflow-hidden">
                            <?php if ($p['nuevo']): ?><span class="badge bg-danger position-absolute top-0 end-0 m-2 z-1">Nuevo</span><?php endif; ?>
                            <a href="<?=BASE_URL?>producto/<?=$p['id']?>">
                                <?php if ($p['imagen_principal']): ?><img src="<?=BASE_URL.$p['imagen_principal']?>" class="card-img-top" alt="<?=htmlspecialchars($p['nombre_comercial'])?>" loading="lazy">
                                <?php else: ?><div class="bg-light d-flex align-items-center justify-content-center" style="height:220px"><i class="bi bi-image text-muted display-4"></i></div><?php endif; ?>
                            </a>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <small class="text-primary fw-bold"><?=htmlspecialchars($p['codigo']??'')?></small>
                            <h6 class="fw-bold mt-1"><?=htmlspecialchars($p['nombre_comercial'])?></h6>
                            <?php if ($p['marca_nombre']): ?><small class="text-muted mb-2"><i class="bi bi-tag me-1"></i><?=htmlspecialchars($p['marca_nombre'])?></small><?php endif; ?>
                            <p class="text-muted small flex-grow-1"><?=htmlspecialchars(substr($p['descripcion']??'',0,80))?></p>
                            <a href="<?=BASE_URL?>producto/<?=$p['id']?>" class="btn btn-outline-primary btn-sm w-100 rounded-pill">Ver Detalle</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="text-center mt-4">
            <a href="<?=BASE_URL?>buscar" class="btn btn-primary btn-lg rounded-pill px-5">Ver Todos</a>
        </div>
    </div>
</section>
<?php endif; ?>
<?php $content = ob_get_clean(); require __DIR__.'/layout.php'; ?>
