<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - AYF Novastyle</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>public/css/admin.css?v=<?= ASSET_VERSION ?>">
</head>
<body class="bg-light">
    <div class="login-container">
        <div class="login-card">
            <div class="text-center mb-4">
                <i class="bi bi-shop display-1 text-primary"></i>
                <h2 class="mt-2">AYF Novastyle</h2>
                <p class="text-muted">Panel de Administración</p>
            </div>
            <?php if (isset($error)): ?>
                <div class="alert alert-danger"><?= $error ?></div>
            <?php endif; ?>
            <form method="POST" action="<?= BASE_URL ?>ayf-admin/login">
                <input type="hidden" name="_token" value="<?= htmlspecialchars($_SESSION['_csrf_token'] ?? '') ?>">
                <div class="mb-3">
                    <label class="form-label">Usuario</label>
                    <input type="text" name="user" class="form-control form-control-lg" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Contraseña</label>
                    <input type="password" name="pass" class="form-control form-control-lg" required>
                </div>
                <button type="submit" class="btn btn-primary btn-lg w-100">Ingresar</button>
            </form>
        </div>
    </div>
<script>
if (localStorage.getItem('adminDarkMode') === 'true') {
    document.documentElement.setAttribute('data-bs-theme', 'dark');
}
</script>
</body>
</html>
