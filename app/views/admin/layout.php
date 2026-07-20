<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Admin' ?> - <?= SITE_NAME ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= BASE_URL ?>public/css/admin.css?v=<?= ASSET_VERSION ?>">
</head>
<body>
<div class="d-flex" style="min-height:100vh">
    <button id="sidebarToggle" class="btn btn-dark d-md-none position-fixed" style="top:10px;left:10px;z-index:200;border-radius:10px;padding:6px 12px;" aria-label="Abrir menú">
        <i class="bi bi-list fs-4"></i>
    </button>
    <div id="sidebarOverlay" class="d-md-none" style="position:fixed;inset:0;background:rgba(0,0,0,0.5);z-index:99;display:none"></div>
    <nav class="sidebar bg-dark text-white" id="adminSidebar">
        <div class="sidebar-header p-3 text-center position-relative">
            <button id="sidebarClose" class="btn btn-sm btn-outline-light d-md-none position-absolute" style="top:8px;right:8px;border-radius:50%;padding:2px 6px;" aria-label="Cerrar menú">
                <i class="bi bi-x-lg"></i>
            </button>
            <img src="<?= BASE_URL ?>DROFARSAC-LOGO.png" alt="DROFAR" height="40" style="filter:brightness(0)invert(1)">
            <small class="text-muted d-block mt-1">Panel Admin</small>
            <button id="darkModeToggle" class="btn btn-sm btn-outline-light mt-2 w-100" title="Modo oscuro/claro">
                <i class="bi bi-moon-stars"></i> <span>Oscuro</span>
            </button>
        </div>
        <ul class="nav flex-column p-2">
            <?php $u = $_SERVER['REQUEST_URI']; ?>
            <li class="nav-item"><a href="<?= BASE_URL ?>admin" class="nav-link text-white <?= $u == BASE_URL.'admin' || preg_match('#^'.preg_quote(BASE_URL,'#').'admin$#', $u) ? 'active' : '' ?>"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a></li>
            <li class="nav-item"><a href="<?= BASE_URL ?>admin/productos" class="nav-link text-white <?= strpos($u,'/admin/productos') !== false ? 'active' : '' ?>"><i class="bi bi-box me-2"></i>Productos</a></li>
            <li class="nav-item"><a href="<?= BASE_URL ?>admin/familias" class="nav-link text-white <?= strpos($u,'/admin/familias') !== false ? 'active' : '' ?>"><i class="bi bi-folder me-2"></i>Familias</a></li>
            <li class="nav-item"><a href="<?= BASE_URL ?>admin/marcas" class="nav-link text-white <?= strpos($u,'/admin/marcas') !== false ? 'active' : '' ?>"><i class="bi bi-tag me-2"></i>Marcas</a></li>
            <li class="nav-item"><a href="<?= BASE_URL ?>admin/banners" class="nav-link text-white <?= strpos($u,'/admin/banners') !== false ? 'active' : '' ?>"><i class="bi bi-images me-2"></i>Banners</a></li>
            <li class="nav-item"><a href="<?= BASE_URL ?>admin/usuarios" class="nav-link text-white <?= strpos($u,'/admin/usuarios') !== false ? 'active' : '' ?>"><i class="bi bi-people me-2"></i>Usuarios</a></li>
            <li class="nav-item mt-3"><a href="<?= BASE_URL ?>" target="_blank" class="nav-link text-white"><i class="bi bi-eye me-2"></i>Ver Catálogo</a></li>
            <li class="nav-item"><a href="<?= BASE_URL ?>admin/logout" class="nav-link text-danger"><i class="bi bi-box-arrow-right me-2"></i>Salir</a></li>
        </ul>
    </nav>
    <main class="main-content flex-grow-1">
        <div class="d-md-none" style="height:54px"></div>
        <div class="p-4">
        <?= $content ?? '' ?>
        </div>
    </main>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>const BASE_URL = '<?= BASE_URL ?>';</script>
<script>
(function() {
    const html = document.documentElement;
    const toggle = document.getElementById('darkModeToggle');
    if (localStorage.getItem('adminDarkMode') === 'true') {
        html.setAttribute('data-bs-theme', 'dark');
        toggle.innerHTML = '<i class="bi bi-sun"></i> <span>Claro</span>';
    }
    toggle.addEventListener('click', function() {
        const isDark = html.getAttribute('data-bs-theme') === 'dark';
        html.setAttribute('data-bs-theme', isDark ? 'light' : 'dark');
        localStorage.setItem('adminDarkMode', !isDark);
        toggle.innerHTML = isDark ? '<i class="bi bi-moon-stars"></i> <span>Oscuro</span>' : '<i class="bi bi-sun"></i> <span>Claro</span>';
    });
})();
</script>
<script>
(function() {
    var toggle = document.getElementById('sidebarToggle');
    var sidebar = document.getElementById('adminSidebar');
    var overlay = document.getElementById('sidebarOverlay');
    if (toggle && sidebar) {
        function closeSidebar() { sidebar.classList.remove('show'); if (overlay) overlay.style.display = 'none'; toggle.style.display = ''; }
        function openSidebar() { sidebar.classList.add('show'); if (overlay) overlay.style.display = 'block'; toggle.style.display = 'none'; }
        toggle.addEventListener('click', function() {
            if (sidebar.classList.contains('show')) closeSidebar();
            else openSidebar();
        });
        if (overlay) overlay.addEventListener('click', closeSidebar);
        var closeBtn = document.getElementById('sidebarClose');
        if (closeBtn) closeBtn.addEventListener('click', closeSidebar);
        sidebar.querySelectorAll('.nav-link').forEach(function(link) {
            link.addEventListener('click', closeSidebar);
        });
    }
})();
</script>
<script src="<?= BASE_URL ?>public/js/admin.js?v=<?= ASSET_VERSION ?>"></script>
</body>
</html>
