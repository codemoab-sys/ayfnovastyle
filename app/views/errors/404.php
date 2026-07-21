<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 — Página no encontrada</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
    *{margin:0;padding:0;box-sizing:border-box}
    body{font-family:'Inter',sans-serif;min-height:100vh;display:flex;align-items:center;justify-content:center;background:#f8f9fa;color:#333}
    .error-container{text-align:center;padding:40px 20px;max-width:500px}
    .error-code{font-size:120px;font-weight:700;line-height:1;background:linear-gradient(135deg,#e63946,#ff6b81);-webkit-background-clip:text;-webkit-text-fill-color:transparent;margin-bottom:8px}
    .error-title{font-size:22px;font-weight:600;margin-bottom:8px;color:#1a1a2e}
    .error-text{font-size:15px;color:#666;margin-bottom:28px;line-height:1.6}
    .btn-home{padding:12px 32px;border-radius:50px;font-weight:500;background:#1a1a2e;color:#fff;text-decoration:none;display:inline-flex;align-items:center;gap:8px;transition:.2s}
    .btn-home:hover{background:#e63946;color:#fff}
    .icon-frown{font-size:48px;color:#e63946;margin-bottom:8px}
    </style>
</head>
<body>
    <div class="error-container">
        <i class="bi bi-emoji-frown icon-frown"></i>
        <div class="error-code">404</div>
        <div class="error-title">Página no encontrada</div>
        <div class="error-text">La página que buscas no existe o fue movida.<br>Revisá la URL o volvé al inicio.</div>
        <a href="<?= defined('BASE_URL') ? BASE_URL : '/' ?>" class="btn-home"><i class="bi bi-house-door"></i> Ir al inicio</a>
    </div>
</body>
</html>
