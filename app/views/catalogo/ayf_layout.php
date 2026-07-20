<?php
$c = $_AYF ?? [];
$AYF_SITE_NAME = $c['site_name'] ?? 'AYF Novastyle';
$AYF_SITE_DESC = $c['site_desc'] ?? 'Novedades en zapatillas y calzado';
$AYF_LOGO = $c['logo'] ?? '';
$AYF_WHATSAPP = $c['whatsapp'] ?? '51995218178';
$AYF_WHATSAPP_MSG = $c['whatsapp_msg'] ?? 'Hola, quiero más información';
$AYF_EMAIL = $c['email'] ?? 'ventas@ayfnovastyle.com';
$AYF_PHONE = $c['phone'] ?? '953571861';
$AYF_ADDRESS = $c['address'] ?? 'Trujillo, Perú';
$AYF_FACEBOOK = $c['facebook'] ?? '#';
$AYF_INSTAGRAM = $c['instagram'] ?? '#';
$AYF_TIKTOK = $c['tiktok'] ?? '';
$AYF_YOUTUBE = $c['youtube'] ?? '';
?>
<!DOCTYPE html>
<html lang="es" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Inicio' ?> | <?= $AYF_SITE_NAME ?></title>
    <meta name="description" content="<?= $AYF_SITE_DESC ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= BASE_URL ?>public/css/swiper-bundle.min.css?v=<?= ASSET_VERSION ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>public/css/aos.css?v=<?= ASSET_VERSION ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/lightgallery@2.7.2/css/lightgallery-bundle.min.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>public/css/catalog.css?v=<?= ASSET_VERSION ?>">
    <style>
        :root {
            --primary: <?= htmlspecialchars($c['theme_primary'] ?? '#e63946') ?>;
            --primary-hover: <?= htmlspecialchars($c['theme_primary_hover'] ?? '#d62839') ?>;
            --primary-dark: <?= htmlspecialchars($c['theme_primary_hover'] ?? '#c1121f') ?>;
            --primary-light: <?= htmlspecialchars($c['theme_primary'] ?? '#e63946') ?>88;
            --secondary: <?= htmlspecialchars($c['theme_secondary'] ?? '#1a1a2e') ?>;
            --accent: <?= htmlspecialchars($c['theme_accent'] ?? '#e63946') ?>;
        }
    </style>
</head>
<body>
    <?php
    header('X-Frame-Options: SAMEORIGIN');
    header('X-Content-Type-Options: nosniff');
    header('X-XSS-Protection: 1; mode=block');
    header('Referrer-Policy: no-referrer-when-downgrade');
    header('Strict-Transport-Security: max-age=31536000; includeSubDomains');
    // Content-Security-Policy: restrict to self
    $csp = "default-src 'self'; script-src 'self' https://cdn.jsdelivr.net/npm; style-src 'self' https://cdn.jsdelivr.net/npm; img-src 'self' data: https:; font-src 'self'; connect-src 'self'; frame-ancestors 'self'; object-src 'none';";
    header('Content-Security-Policy: ' . $csp);
    ?> 

<a href="https://wa.me/<?= $AYF_WHATSAPP ?>?text=<?= urlencode($AYF_WHATSAPP_MSG) ?>" target="_blank" class="whatsapp-float" aria-label="WhatsApp">
    <i class="bi bi-whatsapp"></i>
</a>

<button id="backToTop" class="back-to-top" aria-label="Volver arriba">
    <i class="bi bi-chevron-up"></i>
</button>

<header class="header">
    <div class="header-top d-none d-md-block">
        <div class="container d-flex justify-content-between align-items-center py-1">
            <small class="text-muted"><i class="bi bi-telephone me-1"></i> <?= $AYF_PHONE ?> | <i class="bi bi-envelope ms-2 me-1"></i> <?= $AYF_EMAIL ?></small>
            <div class="social-top">
                <a href="<?= $AYF_FACEBOOK ?>" target="_blank" class="text-muted me-2"><i class="bi bi-facebook"></i></a>
                <a href="<?= $AYF_INSTAGRAM ?>" target="_blank" class="text-muted me-2"><i class="bi bi-instagram"></i></a>
                <?php if ($AYF_TIKTOK): ?><a href="<?= $AYF_TIKTOK ?>" target="_blank" class="text-muted me-2"><i class="bi bi-tiktok"></i></a><?php endif; ?>
                <?php if ($AYF_YOUTUBE): ?><a href="<?= $AYF_YOUTUBE ?>" target="_blank" class="text-muted"><i class="bi bi-youtube"></i></a><?php endif; ?>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg navbar-light bg-white main-nav">
        <div class="container">
            <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="<?= BASE_URL ?>ayf">
                <?php if ($AYF_LOGO): ?><img src="<?= BASE_URL . $AYF_LOGO ?>" alt="<?= $AYF_SITE_NAME ?>" height="45"><?php endif; ?>
                <span class="fs-4 fw-black"><?= $AYF_SITE_NAME ?></span>
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarAyf" aria-controls="navbarAyf" aria-expanded="false" aria-label="Abrir menú">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarAyf">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>ayf">Inicio</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Categorías</a>
                        <ul class="dropdown-menu shadow-sm border-0 rounded-3" id="categoriaMenu">
                            <div id="categoriaList">
                            <?php if (isset($categorias)): ?>
                                <?php foreach ($categorias as $f): ?>
                                    <li><a class="dropdown-item py-2" href="<?= BASE_URL ?>ayf/categoria/<?= $f['slug'] ?>">
                                        <i class="bi bi-dot text-primary me-1"></i> <?= htmlspecialchars($f['nombre']) ?>
                                    </a></li>
                                <?php endforeach; ?>
                            <?php endif; ?>
                            </div>
                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>ayf/buscar">Productos</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>ayf/contacto">Contacto</a></li>
                </ul>
                <div class="d-flex align-items-center gap-2">
                    <div class="search-box">
                        <input type="text" id="searchInput" class="form-control" placeholder="Buscar producto..." autocomplete="off">
                        <i class="bi bi-search search-icon"></i>
                        <div id="searchResults" class="search-results shadow-lg"></div>
                    </div>
                    <a href="https://wa.me/<?= $AYF_WHATSAPP ?>?text=<?= urlencode($AYF_WHATSAPP_MSG) ?>" target="_blank" class="btn btn-whatsapp-header">
                        <i class="bi bi-whatsapp"></i>
                    </a>
                </div>
            </div>
        </div>
    </nav>
</header>

<?= $content ?? '' ?>

<footer class="footer bg-dark text-white py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4">
                <h5 class="fw-bold mb-3"><?= $AYF_SITE_NAME ?></h5>
                <p class="text-white-50 small"><?= $AYF_SITE_DESC ?></p>
                <div class="social-links mt-3">
                    <a href="<?= $AYF_FACEBOOK ?>" target="_blank" class="btn btn-outline-light btn-sm rounded-circle me-1"><i class="bi bi-facebook"></i></a>
                    <a href="<?= $AYF_INSTAGRAM ?>" target="_blank" class="btn btn-outline-light btn-sm rounded-circle me-1"><i class="bi bi-instagram"></i></a>
                    <?php if ($AYF_TIKTOK): ?><a href="<?= $AYF_TIKTOK ?>" target="_blank" class="btn btn-outline-light btn-sm rounded-circle me-1"><i class="bi bi-tiktok"></i></a><?php endif; ?>
                    <?php if ($AYF_YOUTUBE): ?><a href="<?= $AYF_YOUTUBE ?>" target="_blank" class="btn btn-outline-light btn-sm rounded-circle"><i class="bi bi-youtube"></i></a><?php endif; ?>
                </div>
            </div>
            <div class="col-lg-4">
                <h6 class="fw-bold mb-3">Contacto</h6>
                <ul class="list-unstyled text-white-50 small">
                    <li class="mb-2"><i class="bi bi-geo-alt me-2"></i><?= $AYF_ADDRESS ?></li>
                    <li class="mb-2"><i class="bi bi-telephone me-2"></i><?= $AYF_PHONE ?></li>
                    <li class="mb-2"><i class="bi bi-envelope me-2"></i><?= $AYF_EMAIL ?></li>
                    <li><i class="bi bi-whatsapp me-2"></i><a href="https://wa.me/<?= $AYF_WHATSAPP ?>" target="_blank" class="text-white-50">+<?= $AYF_WHATSAPP ?></a></li>
                </ul>
            </div>
            <div class="col-lg-4">
                <h6 class="fw-bold mb-3">Enlaces</h6>
                <ul class="list-unstyled text-white-50 small">
                    <li class="mb-2"><a href="<?= BASE_URL ?>ayf" class="text-white-50 text-decoration-none">Inicio</a></li>
                    <li class="mb-2"><a href="<?= BASE_URL ?>ayf/buscar" class="text-white-50 text-decoration-none">Productos</a></li>
                    <li class="mb-2"><a href="<?= BASE_URL ?>ayf/contacto" class="text-white-50 text-decoration-none">Contacto</a></li>
                </ul>
            </div>
        </div>
        <hr class="border-secondary my-4">
        <div class="text-center text-white-50 small">
            &copy; <?= date('Y') ?> <?= $AYF_SITE_NAME ?>. Todos los derechos reservados.
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?= BASE_URL ?>public/js/jquery-3.7.1.min.js?v=<?= ASSET_VERSION ?>"></script>
<!-- Swiper JS removed, using manual slider -->
<script src="<?= BASE_URL ?>public/js/aos.js?v=<?= ASSET_VERSION ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/lightgallery@2.7.2/lightgallery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/lightgallery@2.7.2/plugins/zoom/lg-zoom.min.js"></script>
<script>var CATALOGO_BASE_URL = '<?= BASE_URL ?>'; var AYF_MODE = true;</script>
<script src="<?= BASE_URL ?>public/js/catalog.js?v=<?= ASSET_VERSION ?>"></script>
</body>
</html>
