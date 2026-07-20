<?php $title = 'Inicio'; $c = $_AYF ?? []; ob_start(); ?>
<section class="hero-section">
    <div class="swiper heroSwiper">
        <div class="swiper-wrapper">
            <?php if (!empty($banners)): ?>
                <?php foreach ($banners as $b): ?>
                    <div class="swiper-slide">
                        <?php
                            $imgUrl = $b['imagen'] ? BASE_URL . $b['imagen'] : '';
                            if ($imgUrl) {
                                $safe = str_replace("'", "\\'", $imgUrl);
                                $bgStyle = "background-image:url('" . $safe . "')";
                            } else {
                                $bgStyle = "background:linear-gradient(135deg,#e63946,#ff6b6b)";
                            }
                        ?>
                        <div class="hero-slide" style="<?=$bgStyle?>">
                            <div class="hero-overlay"></div>
                            <div class="container hero-content">
                                <h1><?=htmlspecialchars($b['titulo']??'')?></h1>
                                <p><?=htmlspecialchars($b['subtitulo']??'')?></p>
                                <div>
                                    <a href="<?=BASE_URL?>ayf/buscar" class="btn btn-primary btn-lg me-2">Ver Catálogo</a>
                                    <a href="https://wa.me/<?=htmlspecialchars($c['whatsapp']??'51995218178')?>?text=<?=urlencode($c['whatsapp_msg']??'Hola, quiero m\u00e1s informaci\u00f3n')?>" target="_blank" class="btn btn-outline-light btn-lg"><i class="bi bi-whatsapp me-2"></i>Consultar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="swiper-slide">
                    <div class="hero-slide" style="background:linear-gradient(135deg,#e63946,#ff6b6b)">
                        <div class="hero-overlay"></div>
                        <div class="container hero-content">
                            <h1 data-aos="fade-up">Nuevos Lanzamientos</h1>
                            <p data-aos="fade-up" data-aos-delay="200">Las mejores zapatillas de la temporada</p>
                            <div data-aos="fade-up" data-aos-delay="400">
                                <a href="<?=BASE_URL?>ayf/buscar" class="btn btn-primary btn-lg me-2">Ver Catálogo</a>
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
            <h2 class="fw-bold">Categorías</h2>
            <p class="text-muted">Explora nuestras categorías</p>
        </div>
        <div class="row g-3">
            <?php foreach ($categorias as $f): ?>
                <div class="col-6 col-md-4 col-lg-3" data-aos="fade-up" data-aos-delay="<?=($f['orden']%4)*50?>">
                    <a href="<?=BASE_URL?>ayf/categoria/<?=$f['slug']?>" class="text-decoration-none">
                        <div class="card familia-card border-0 shadow-sm h-100">
                            <div class="card-body text-center p-4">
                                <div class="familia-icon mb-3">
                                    <?php if ($f['icono']): ?><img src="<?=BASE_URL.$f['icono']?>" alt="<?=htmlspecialchars($f['nombre'])?>" height="55">
                                    <?php else: ?><i class="bi bi-box-seam"></i><?php endif; ?>
                                </div>
                                <h6 class="fw-bold mb-1"><?=htmlspecialchars($f['nombre'])?></h6>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php if ($destacados): ?>
<section class="section-padding bg-light" data-aos="fade-up">
    <div class="container">
        <div class="text-center mb-5">
            <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 mb-2 rounded-pill">Destacados</span>
            <h2 class="fw-bold">Productos Destacados</h2>
            <p class="text-muted">Lo más vendido</p>
        </div>
        <div class="row g-3">
            <?php foreach ($destacados as $p): ?>
                <div class="col-6 col-md-4 col-lg-3" data-aos="fade-up" data-aos-delay="<?=($p['id']%4)*80?>">
                    <div class="card product-card border-0 shadow-sm h-100">
                        <div class="position-relative overflow-hidden">
                            <?php if ($p['nuevo']): ?><span class="badge bg-danger position-absolute top-0 end-0 m-2 z-1">Nuevo</span><?php endif; ?>
                            <a href="<?=BASE_URL?>ayf/producto/<?=$p['id']?>">
                                <?php if ($p['imagen_principal']): ?><img src="<?=BASE_URL.$p['imagen_principal']?>" class="card-img-top" alt="<?=htmlspecialchars($p['nombre'])?>" loading="lazy">
                                <?php else: ?><div class="bg-light d-flex align-items-center justify-content-center" style="height:220px"><i class="bi bi-image text-muted display-4"></i></div><?php endif; ?>
                            </a>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <small class="text-primary fw-bold"><?=htmlspecialchars($p['codigo']??'')?></small>
                            <h6 class="fw-bold mt-1"><?=htmlspecialchars($p['nombre'])?></h6>
                            <?php if ($p['marca_nombre']): ?><small class="text-muted mb-2"><i class="bi bi-tag me-1"></i><?=htmlspecialchars($p['marca_nombre'])?></small><?php endif; ?>
                            <?php if ($p['precio']): ?><h5 class="text-danger fw-bold mt-auto">S/ <?=number_format($p['precio'],2)?><?php if ($p['precio_anterior'] > $p['precio']): ?> <small class="text-muted text-decoration-line-through fs-6">S/ <?=number_format($p['precio_anterior'],2)?></small><?php endif; ?></h5><?php endif; ?>
                            <a href="<?=BASE_URL?>ayf/producto/<?=$p['id']?>" class="btn btn-outline-primary btn-sm w-100 rounded-pill mt-2">Ver Detalle</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="text-center mt-4">
            <a href="<?=BASE_URL?>ayf/buscar" class="btn btn-primary btn-lg rounded-pill px-5">Ver Todos</a>
        </div>
    </div>
</section>
<?php endif; ?>
<?php $content = ob_get_clean(); require __DIR__.'/ayf_layout.php'; ?>
