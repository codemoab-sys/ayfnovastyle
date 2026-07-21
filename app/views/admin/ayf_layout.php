<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Admin' ?> - AYF Novastyle</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="<?= BASE_URL ?>public/css/sweetalert2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= BASE_URL ?>public/css/admin.css?v=<?= ASSET_VERSION ?>">
    <script src="<?= BASE_URL ?>public/js/sweetalert2.min.js"></script>
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
            <h5 class="fw-bold mb-0">AYF Novastyle</h5>
            <small class="text-muted d-block mt-1">Panel Admin</small>
            <button id="darkModeToggle" class="btn btn-sm btn-outline-light mt-2 w-100" title="Modo oscuro/claro">
                <i class="bi bi-moon-stars"></i> <span>Oscuro</span>
            </button>
        </div>
        <ul class="nav flex-column p-2">
            <?php $u = $_SERVER['REQUEST_URI']; ?>
            <li class="nav-item"><a href="<?= BASE_URL ?>ayf-admin" class="nav-link text-white <?= strpos($u,'/ayf-admin') === strlen(rtrim(BASE_URL,'/')) || $u == BASE_URL.'ayf-admin' ? 'active' : '' ?>"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a></li>
            <li class="nav-item"><a href="<?= BASE_URL ?>ayf-admin/productos" class="nav-link text-white <?= strpos($u,'/ayf-admin/productos') !== false ? 'active' : '' ?>"><i class="bi bi-box me-2"></i>Productos</a></li>
            <li class="nav-item"><a href="<?= BASE_URL ?>ayf-admin/categorias" class="nav-link text-white <?= strpos($u,'/ayf-admin/categorias') !== false ? 'active' : '' ?>"><i class="bi bi-folder me-2"></i>Categorías</a></li>
            <li class="nav-item"><a href="<?= BASE_URL ?>ayf-admin/marcas" class="nav-link text-white <?= strpos($u,'/ayf-admin/marcas') !== false ? 'active' : '' ?>"><i class="bi bi-tag me-2"></i>Marcas</a></li>
            <li class="nav-item"><a href="<?= BASE_URL ?>ayf-admin/banners" class="nav-link text-white <?= strpos($u,'/ayf-admin/banners') !== false ? 'active' : '' ?>"><i class="bi bi-images me-2"></i>Banners</a></li>
            <li class="nav-item"><a href="<?= BASE_URL ?>ayf-admin/usuarios" class="nav-link text-white <?= strpos($u,'/ayf-admin/usuarios') !== false ? 'active' : '' ?>"><i class="bi bi-people me-2"></i>Usuarios</a></li>
            <li class="nav-item"><a href="<?= BASE_URL ?>ayf-admin/configuracion" class="nav-link text-white <?= strpos($u,'/ayf-admin/configuracion') !== false ? 'active' : '' ?>"><i class="bi bi-gear me-2"></i>Configuración</a></li>
            <li class="nav-item mt-3"><a href="<?= BASE_URL ?>ayf" target="_blank" class="nav-link text-white"><i class="bi bi-eye me-2"></i>Ver Tienda</a></li>
            <li class="nav-item"><a href="<?= BASE_URL ?>ayf-admin/logout" class="nav-link text-danger"><i class="bi bi-box-arrow-right me-2"></i>Salir</a></li>
        </ul>
    </nav>
    <main class="main-content flex-grow-1">
        <div class="d-md-none" style="height:54px"></div>
        <div class="p-4">
        <?php
            $flashMsg = '';
            $flashType = '';
            if (!empty($_SESSION['_flash']['upload_error'])) { $flashMsg = $_SESSION['_flash']['upload_error']; $flashType = 'danger'; unset($_SESSION['_flash']['upload_error']); }
            elseif (!empty($_SESSION['_flash']['success'])) { $flashMsg = $_SESSION['_flash']['success']; $flashType = 'success'; unset($_SESSION['_flash']['success']); }
        ?>
        <?php if ($flashMsg): ?>
            <div class="alert alert-<?=$flashType?> alert-dismissible fade show" role="alert">
                <i class="bi bi-<?=$flashType==='danger'?'exclamation-triangle':'check-circle'?> me-2"></i> <?=htmlspecialchars($flashMsg)?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>
        <?= $content ?? '' ?>
        </div>
    </main>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<?php if (!empty($swalToast)): ?>
<script>
(function(){var m='<?=$swalToast['text']?>';if(typeof Swal!=='undefined'){Swal.fire({icon:'<?=$swalToast['icon']?>',title:'Éxito',text:m,timer:3000,showConfirmButton:false})}else{var d=document.createElement('div');d.style.cssText='position:fixed;top:20px;right:20px;z-index:9999;background:#198754;color:#fff;padding:16px 24px;border-radius:8px;box-shadow:0 4px 12px rgba(0,0,0,.2);font-size:15px;max-width:400px';d.textContent=m;document.body.appendChild(d);setTimeout(function(){d.style.transition='opacity .5s';d.style.opacity='0';setTimeout(function(){d.remove()},500)},3000)}})();
</script>
<?php endif; ?>
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
