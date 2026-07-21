<?php
$c = $_AYF ?? [];
$AYF_SITE_NAME = $c['site_name'] ?? 'AYF Novastyle';
$AYF_SITE_DESC = $c['site_desc'] ?? 'Novedades en zapatillas y calzado';
$AYF_LOGO = $c['logo'] ?? '';
header('X-Frame-Options: SAMEORIGIN');
header('X-Content-Type-Options: nosniff');
header('Referrer-Policy: no-referrer-when-downgrade');
header('Strict-Transport-Security: max-age=31536000; includeSubDomains');
$csp = "default-src 'self'; base-uri 'self'; object-src 'none'; script-src 'self' 'unsafe-inline' https://cdn.jsdelivr.net; style-src 'self' 'unsafe-inline' https://cdn.jsdelivr.net https://fonts.googleapis.com; img-src 'self' data: https:; font-src 'self' data: https://cdn.jsdelivr.net https://fonts.gstatic.com https://fonts.googleapis.com; connect-src 'self'; frame-ancestors 'self'; form-action 'self' https:; upgrade-insecure-requests";
header('Content-Security-Policy: ' . $csp);
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
        body { font-family: Inter, system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif; }
        .header { position: sticky; top: 0; z-index: 1000; background: white; border-bottom: 1px solid #e5e7eb; }
        .hero-section { position: relative; min-height: 70vh; background: linear-gradient(135deg, #111827, #ef4444); color: white; }
        .hero-slide { min-height: 70vh; display: flex; align-items: center; padding: 4rem 0; }
        .hero-content { max-width: 700px; }
        .section-padding { padding: 4rem 0; }
        .card { border-radius: 16px; }
        .btn-primary { background: #e63946; border-color: #e63946; }
        .footer { background: #111827; color: white; padding: 3rem 0; }
        .social-icon-link svg, .whatsapp-float svg { width: 18px; height: 18px; display: block; }
        .social-icon-link, .whatsapp-float { display: inline-flex; align-items: center; justify-content: center; }
    </style>
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
    // Headers already set earlier in the template.
    ?> 

<a href="https://wa.me/<?= $AYF_WHATSAPP ?>?text=<?= urlencode($AYF_WHATSAPP_MSG) ?>" target="_blank" class="whatsapp-float" aria-label="WhatsApp">
    <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.149-.67.149-.198.297-.767.966-.94 1.164-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.149-.173.198-.297.297-.495.099-.198.05-.372-.025-.521-.074-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.273.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.123-.273-.198-.57-.347zM12.001 2C6.478 2 2 6.478 2 12c0 2.117.6 4.071 1.64 5.686L2 22l4.445-1.166A9.94 9.94 0 0 0 12 22c5.523 0 10-4.477 10-10S17.523 2 12.001 2z"/></svg>
</a>

<button id="backToTop" class="back-to-top" aria-label="Volver arriba">
    <i class="bi bi-chevron-up"></i>
</button>

<header class="header">
    <div class="header-top d-none d-md-block">
        <div class="container d-flex justify-content-between align-items-center py-1">
            <small class="text-muted"><i class="bi bi-telephone me-1"></i> <?= $AYF_PHONE ?> | <i class="bi bi-envelope ms-2 me-1"></i> <?= $AYF_EMAIL ?></small>
            <div class="social-top">
                <a href="<?= $AYF_FACEBOOK ?>" target="_blank" class="text-muted me-2 social-icon-link" aria-label="Facebook"><svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M13.397 20.997v-8.196h2.765l.411-3.209h-3.176V4.549c0-.926.257-1.558 1.587-1.558h1.698V.126A22.82 22.82 0 0 0 14.201 0c-2.444 0-4.122 1.492-4.122 4.231v2.361H7.332v3.209h2.747v8.196h3.318z"/></svg></a>
                <a href="<?= $AYF_INSTAGRAM ?>" target="_blank" class="text-muted me-2 social-icon-link" aria-label="Instagram"><svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M7.03.02A7.03 7.03 0 0 0 0 7.05v9.9A7.03 7.03 0 0 0 7.03 24h9.94A7.03 7.03 0 0 0 24 16.95V7.05A7.03 7.03 0 0 0 16.97.02H7.03Zm0 2h9.94a5.03 5.03 0 0 1 5.03 5.03v9.9A5.03 5.03 0 0 1 16.97 22H7.03A5.03 5.03 0 0 1 2 16.97V7.05A5.03 5.03 0 0 1 7.03 2Zm9.24 2.18a1.17 1.17 0 0 0-.93.3 1.17 1.17 0 0 0 0 1.66 1.17 1.17 0 0 0 1.66 0 1.17 1.17 0 0 0 0-1.66 1.17 1.17 0 0 0-.73-.3ZM12 5.56A6.44 6.44 0 1 0 18.44 12 6.44 6.44 0 0 0 12 5.56Zm0 2A4.44 4.44 0 1 1 7.56 12 4.44 4.44 0 0 1 12 7.56Z"/></svg></a>
                <?php if ($AYF_TIKTOK): ?><a href="<?= $AYF_TIKTOK ?>" target="_blank" class="text-muted me-2 social-icon-link" aria-label="TikTok"><svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12.35 0c.2 1.44.65 2.54 1.42 3.3.6.6 1.47 1.05 2.41 1.22v2.84c-.35-.05-.73-.12-1.1-.22-.4-.1-.74-.25-1.08-.46-.6-.38-1.03-.82-1.3-1.45-.17-.45-.25-.91-.25-1.41V0h-.2zM18.45 5.6c-.22.44-.5.83-.83 1.17-.52.53-1.02.87-1.68 1.1v2.57c-.19-.03-.41-.07-.64-.13-.59-.16-1.13-.46-1.64-.92-.34-.3-.69-.71-1.04-1.3-.35-.67-.47-1.22-.47-1.93 0-.34.04-.67.11-.99.05-.22.13-.44.24-.64.11-.2.25-.39.42-.58.88-1.09 2.04-1.77 3.63-2.1v2.53c-.41.1-.79.27-1.15.5-.35.22-.62.5-.8.84-.2.39-.3.78-.3 1.2 0 .37.08.74.24 1.08.14.3.33.56.59.78.34.3.76.5 1.24.57.51.08 1.02.08 1.53 0v2.42c-.4.1-.83.16-1.29.16-.54 0-1.04-.07-1.54-.22-1.09-.29-1.96-.86-2.65-1.66-.75-.89-1.15-1.93-1.27-3.05v-.28c0-.32.03-.63.1-.95.14-.57.37-1.09.7-1.56.24-.35.53-.69.86-1.02.63-.62 1.38-1.1 2.24-1.42.75-.28 1.54-.44 2.33-.48V5.6z"/></svg></a><?php endif; ?>
                <?php if ($AYF_YOUTUBE): ?><a href="<?= $AYF_YOUTUBE ?>" target="_blank" class="text-muted social-icon-link" aria-label="YouTube"><svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M23.498 6.186a3.017 3.017 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.017 3.017 0 0 0 2.122 2.136C4.495 20.455 12 20.455 12 20.455s7.505 0 9.377-.505a3.017 3.017 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg></a><?php endif; ?>
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
                    <a href="<?= $AYF_FACEBOOK ?>" target="_blank" class="btn btn-outline-light btn-sm rounded-circle me-1 social-icon-link"><svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M13.397 20.997v-8.196h2.765l.411-3.209h-3.176V4.549c0-.926.257-1.558 1.587-1.558h1.698V.126A22.82 22.82 0 0 0 14.201 0c-2.444 0-4.122 1.492-4.122 4.231v2.361H7.332v3.209h2.747v8.196h3.318z"/></svg></a>
                    <a href="<?= $AYF_INSTAGRAM ?>" target="_blank" class="btn btn-outline-light btn-sm rounded-circle me-1 social-icon-link"><svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M7.03.02A7.03 7.03 0 0 0 0 7.05v9.9A7.03 7.03 0 0 0 7.03 24h9.94A7.03 7.03 0 0 0 24 16.95V7.05A7.03 7.03 0 0 0 16.97.02H7.03Zm0 2h9.94a5.03 5.03 0 0 1 5.03 5.03v9.9A5.03 5.03 0 0 1 16.97 22H7.03A5.03 5.03 0 0 1 2 16.97V7.05A5.03 5.03 0 0 1 7.03 2Zm9.24 2.18a1.17 1.17 0 0 0-.93.3 1.17 1.17 0 0 0 0 1.66 1.17 1.17 0 0 0 1.66 0 1.17 1.17 0 0 0 0-1.66 1.17 1.17 0 0 0-.73-.3ZM12 5.56A6.44 6.44 0 1 0 18.44 12 6.44 6.44 0 0 0 12 5.56Zm0 2A4.44 4.44 0 1 1 7.56 12 4.44 4.44 0 0 1 12 7.56Z"/></svg></a>
                    <?php if ($AYF_TIKTOK): ?><a href="<?= $AYF_TIKTOK ?>" target="_blank" class="btn btn-outline-light btn-sm rounded-circle me-1 social-icon-link"><svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12.35 0c.2 1.44.65 2.54 1.42 3.3.6.6 1.47 1.05 2.41 1.22v2.84c-.35-.05-.73-.12-1.1-.22-.4-.1-.74-.25-1.08-.46-.6-.38-1.03-.82-1.3-1.45-.17-.45-.25-.91-.25-1.41V0h-.2zM18.45 5.6c-.22.44-.5.83-.83 1.17-.52.53-1.02.87-1.68 1.1v2.57c-.19-.03-.41-.07-.64-.13-.59-.16-1.13-.46-1.64-.92-.34-.3-.69-.71-1.04-1.3-.35-.67-.47-1.22-.47-1.93 0-.34.04-.67.11-.99.05-.22.13-.44.24-.64.11-.2.25-.39.42-.58.88-1.09 2.04-1.77 3.63-2.1v2.53c-.41.1-.79.27-1.15.5-.35.22-.62.5-.8.84-.2.39-.3.78-.3 1.2 0 .37.08.74.24 1.08.14.3.33.56.59.78.34.3.76.5 1.24.57.51.08 1.02.08 1.53 0v2.42c-.4.1-.83.16-1.29.16-.54 0-1.04-.07-1.54-.22-1.09-.29-1.96-.86-2.65-1.66-.75-.89-1.15-1.93-1.27-3.05v-.28c0-.32.03-.63.1-.95.14-.57.37-1.09.7-1.56.24-.35.53-.69.86-1.02.63-.62 1.38-1.1 2.24-1.42.75-.28 1.54-.44 2.33-.48V5.6z"/></svg></a><?php endif; ?>
                    <?php if ($AYF_YOUTUBE): ?><a href="<?= $AYF_YOUTUBE ?>" target="_blank" class="btn btn-outline-light btn-sm rounded-circle social-icon-link"><svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M23.498 6.186a3.017 3.017 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.017 3.017 0 0 0 2.122 2.136C4.495 20.455 12 20.455 12 20.455s7.505 0 9.377-.505a3.017 3.017 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg></a><?php endif; ?>
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
            <br>Desarrollada por <a href="https://www.moabcode.com" target="_blank" class="text-white-50">MOABCODE</a>
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
