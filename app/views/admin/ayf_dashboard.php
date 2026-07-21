<?php ob_start(); ?>
<div class="d-flex justify-content-between align-items-center mb-4"><h2>Dashboard</h2></div>
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm bg-primary text-white">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div><h6 class="card-title mb-0">Productos</h6><h2 class="mt-2 mb-0 fw-bold"><?= $totalProductos ?></h2></div>
                <i class="bi bi-box display-4 opacity-50"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm bg-success text-white">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div><h6 class="card-title mb-0">Categorías</h6><h2 class="mt-2 mb-0 fw-bold"><?= $totalCategorias ?></h2></div>
                <i class="bi bi-folder display-4 opacity-50"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm bg-info text-white">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div><h6 class="card-title mb-0">Marcas</h6><h2 class="mt-2 mb-0 fw-bold"><?= $totalMarcas ?></h2></div>
                <i class="bi bi-tag display-4 opacity-50"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm bg-warning text-dark">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div><h6 class="card-title mb-0">Banners</h6><h2 class="mt-2 mb-0 fw-bold"><?= $totalBanners ?></h2></div>
                <i class="bi bi-images display-4 opacity-50"></i>
            </div>
        </div>
    </div>
</div>
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white"><h5 class="mb-0 fw-bold">Últimos Productos</h5></div>
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light"><tr><th>ID</th><th>Código</th><th>Producto</th><th>Categoría</th><th>Fecha</th></tr></thead>
            <tbody>
                <?php foreach ($productosRecientes as $p): ?>
                <tr><td><?= $p['id'] ?></td><td><?= htmlspecialchars($p['codigo']) ?></td><td><?= htmlspecialchars($p['nombre']) ?></td><td><?= htmlspecialchars($p['categoria_nombre'] ?? '') ?></td><td><?= $p['created_at'] ?></td></tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<div class="card border-0 shadow-sm mt-4">
    <div class="card-header bg-white"><h5 class="mb-0 fw-bold">Diagnóstico</h5></div>
    <div class="card-body small">
        <?php
            $uploadDir = __DIR__ . '/../../public/uploads/';
            $bannerDir = $uploadDir . 'ayf_banners/';
            $issues = [];
            $resolvedDir = realpath(__DIR__ . '/../../public/uploads/') ?: 'NO RESUELVE';
            echo "<p><strong>Directorio uploads:</strong> <code>$resolvedDir</code></p>";
            echo "<p><strong>Existe:</strong> " . (is_dir($resolvedDir) ? '✅ Sí' : '❌ No') . "</p>";
            if (is_dir($resolvedDir)) {
                echo "<p><strong>Escribible:</strong> " . (is_writable($resolvedDir) ? '✅ Sí' : '❌ No') . "</p>";
            }
            echo "<p><strong>Directorio banners:</strong> " . (is_dir($bannerDir) ? '✅ Existe' : '❌ No existe') . "</p>";
            if (is_dir($bannerDir)) {
                echo "<p><strong>Escribible:</strong> " . (is_writable($bannerDir) ? '✅ Sí' : '❌ No') . "</p>";
            }
            echo "<p><strong>upload_max_filesize:</strong> " . ini_get('upload_max_filesize') . "</p>";
            echo "<p><strong>post_max_size:</strong> " . ini_get('post_max_size') . "</p>";
            echo "<p><strong>max_execution_time:</strong> " . ini_get('max_execution_time') . "s</p>";
            echo "<p><strong>memory_limit:</strong> " . ini_get('memory_limit') . "</p>";
            echo "<p><strong>display_errors:</strong> " . ini_get('display_errors') . "</p>";
            echo "<p><strong>BASE_URL:</strong> <code>" . BASE_URL . "</code></p>";
        ?>
    </div>
</div>
<?php $content = ob_get_clean(); $title = 'Dashboard'; require __DIR__ . '/ayf_layout.php'; ?>
