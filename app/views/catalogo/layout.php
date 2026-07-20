<!DOCTYPE html>
<html lang="es" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? SITE_NAME ?> | <?= SITE_NAME ?></title>
    <meta name="description" content="<?= SITE_DESC ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/lightgallery@2.7.2/css/lightgallery-bundle.min.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>public/css/catalog.css?v=<?= ASSET_VERSION ?>">
</head>
<body>

<!-- Whatsapp Float -->
<a href="https://wa.me/<?= WHATSAPP ?>?text=<?= urlencode(WHATSAPP_MSG) ?>" target="_blank" class="whatsapp-float" aria-label="WhatsApp">
    <i class="bi bi-whatsapp"></i>
</a>

<!-- Back to Top -->
<button id="backToTop" class="back-to-top" aria-label="Volver arriba">
    <i class="bi bi-chevron-up"></i>
</button>

<!-- Dark Mode Toggle -->
<button id="darkModeToggle" class="dark-mode-toggle" aria-label="Modo oscuro" hidden>
    <i class="bi bi-moon-stars"></i>
</button>

<!-- Header / Navbar -->
<header class="header">
    <div class="header-top d-none d-md-block">
        <div class="container d-flex justify-content-between align-items-center py-1">
            <small class="text-muted"><i class="bi bi-telephone me-1"></i> <?= PHONE ?> | <i class="bi bi-envelope ms-2 me-1"></i> <?= EMAIL ?></small>
            <div class="social-top">
                <a href="<?= FACEBOOK ?>" target="_blank" class="text-muted me-2"><i class="bi bi-facebook"></i></a>
                <a href="<?= INSTAGRAM ?>" target="_blank" class="text-muted me-2"><i class="bi bi-instagram"></i></a>
                <a href="<?= LINKEDIN ?>" target="_blank" class="text-muted"><i class="bi bi-linkedin"></i></a>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg navbar-light bg-white main-nav">
        <div class="container">
            <a class="navbar-brand fw-bold" href="<?= BASE_URL ?>">
                <img src="<?= BASE_URL ?>DROFARSAC-LOGO.png" alt="<?= SITE_NAME ?>" height="45" class="me-2">
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain" aria-controls="navbarMain" aria-expanded="false" aria-label="Abrir menú">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarMain">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>">Inicio</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Categorías</a>
                        <ul class="dropdown-menu shadow-sm border-0 rounded-3" id="categoriaMenu">
                            <li class="px-3 py-2" style="min-width:240px">
                                <input type="text" id="categoriaSearch" class="form-control form-control-sm" placeholder="Buscar categoría..." autocomplete="off">
                            </li>
                            <li><hr class="dropdown-divider my-1"></li>
                            <div id="categoriaList">
                            <?php if (isset($familias)): ?>
                                <?php foreach ($familias as $f): ?>
                                    <li class="categoria-item" data-nombre="<?=htmlspecialchars(mb_strtolower($f['nombre'],'UTF-8'))?>"><a class="dropdown-item py-2" href="<?= BASE_URL ?>categoria/<?= $f['slug'] ?>">
                                        <i class="bi bi-dot text-primary me-1"></i> <?= htmlspecialchars($f['nombre']) ?>
                                    </a></li>
                                <?php endforeach; ?>
                            <?php endif; ?>
                            </div>
                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>buscar">Productos</a></li>
                </ul>
                <div class="d-flex align-items-center gap-2">
                    <div class="search-box">
                        <input type="text" id="searchInput" class="form-control" placeholder="Buscar producto..." autocomplete="off">
                        <i class="bi bi-search search-icon"></i>
                        <div id="searchResults" class="search-results shadow-lg"></div>
                    </div>
                    <a href="https://wa.me/<?= WHATSAPP ?>?text=<?= urlencode(WHATSAPP_MSG) ?>" target="_blank" class="btn btn-whatsapp-header">
                        <i class="bi bi-whatsapp"></i>
                    </a>
                </div>
            </div>
        </div>
    </nav>
</header>

<?= $content ?? '' ?>

<!-- Footer -->
<footer class="footer bg-dark text-white py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4">
                <img src="<?= BASE_URL ?>DROFARSAC-LOGO.png" alt="<?= SITE_NAME ?>" height="50" class="mb-3" style="filter: brightness(0) invert(1);">
                <p class="text-white-50 small"><?= SITE_DESC ?></p>
                <div class="social-links mt-3">
                    <a href="<?= FACEBOOK ?>" target="_blank" class="btn btn-outline-light btn-sm rounded-circle me-1"><i class="bi bi-facebook"></i></a>
                    <a href="<?= INSTAGRAM ?>" target="_blank" class="btn btn-outline-light btn-sm rounded-circle me-1"><i class="bi bi-instagram"></i></a>
                    <a href="<?= LINKEDIN ?>" target="_blank" class="btn btn-outline-light btn-sm rounded-circle"><i class="bi bi-linkedin"></i></a>
                </div>
            </div>
            <div class="col-lg-4">
                <h6 class="fw-bold mb-3">Contacto</h6>
                <ul class="list-unstyled text-white-50 small">
                    <li class="mb-2"><i class="bi bi-geo-alt me-2"></i><?= ADDRESS ?></li>
                    <li class="mb-2"><i class="bi bi-telephone me-2"></i><?= PHONE ?></li>
                    <li class="mb-2"><i class="bi bi-envelope me-2"></i><?= EMAIL ?></li>
                    <li><i class="bi bi-whatsapp me-2"></i><a href="https://wa.me/<?= WHATSAPP ?>" target="_blank" class="text-white-50">+<?= WHATSAPP ?></a></li>
                </ul>
            </div>
            <div class="col-lg-4">
                <h6 class="fw-bold mb-3">Enlaces</h6>
                <ul class="list-unstyled text-white-50 small">
                    <li class="mb-2"><a href="<?= BASE_URL ?>" class="text-white-50 text-decoration-none">Inicio</a></li>
                    <li class="mb-2"><a href="<?= BASE_URL ?>buscar" class="text-white-50 text-decoration-none">Productos</a></li>
                    <?php if (isset($familias)): ?>
                        <?php foreach (array_slice($familias, 0, 4) as $f): ?>
                            <li class="mb-2"><a href="<?= BASE_URL ?>categoria/<?= $f['slug'] ?>" class="text-white-50 text-decoration-none"><?= htmlspecialchars($f['nombre']) ?></a></li>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
        <hr class="border-secondary my-4">
        <div class="text-center text-white-50 small">
            &copy; <?= date('Y') ?> <?= SITE_NAME ?>. Todos los derechos reservados.
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="https://cdn.jsdelivr.net/npm/lightgallery@2.7.2/lightgallery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/lightgallery@2.7.2/plugins/zoom/lg-zoom.min.js"></script>
<script>var CATALOGO_BASE_URL = '<?= BASE_URL ?>';</script>
<script src="<?= BASE_URL ?>public/js/catalog.js?v=<?= ASSET_VERSION ?>"></script>
</body>
</html>
