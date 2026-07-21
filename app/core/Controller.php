<?php
namespace App\Core;

class Controller
{
    protected function startSecureSession()
    {
        if (session_status() === PHP_SESSION_NONE) {
            $isHttps = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || (!empty($_SERVER['SERVER_PORT']) && (int)$_SERVER['SERVER_PORT'] === 443);
            session_set_cookie_params([
                'lifetime' => 0,
                'path' => '/',
                'domain' => '',
                'secure' => $isHttps,
                'httponly' => true,
                'samesite' => 'Lax',
            ]);
            session_name('AYFSESSID');
            session_start();
        }
    }

    protected function regenerateSession()
    {
        if (session_status() === PHP_SESSION_ACTIVE) {
            session_regenerate_id(true);
        }
    }

    protected function generateCsrfToken()
    {
        if (empty($_SESSION['_csrf_token'])) {
            $_SESSION['_csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['_csrf_token'];
    }

    protected function checkRateLimit($key = 'login', $maxAttempts = 5, $window = 60)
    {
        $ip = str_replace([':', '.'], '_', $_SERVER['REMOTE_ADDR'] ?? 'unknown');
        $file = sys_get_temp_dir() . "/ratelimit_{$key}_{$ip}";
        $now = time();
        $attempts = [];
        if (file_exists($file)) {
            $attempts = json_decode(file_get_contents($file), true) ?? [];
            $attempts = array_filter($attempts, fn($t) => $t > $now - $window);
        }
        if (count($attempts) >= $maxAttempts) {
            if (function_exists('error_log')) {
                error_log("[RateLimit] {$key} bloqueado para {$ip}");
            }
            http_response_code(429);
            die('Demasiados intentos. Espera un minuto e intenta de nuevo.');
        }
        $attempts[] = $now;
        file_put_contents($file, json_encode($attempts), LOCK_EX);
    }

    protected function resetRateLimit($key = 'login')
    {
        $ip = str_replace([':', '.'], '_', $_SERVER['REMOTE_ADDR'] ?? 'unknown');
        $file = sys_get_temp_dir() . "/ratelimit_{$key}_{$ip}";
        if (file_exists($file)) unlink($file);
    }

    protected function validateCsrfToken()
    {
        $token = $_POST['_token'] ?? '';
        if (empty($_SESSION['_csrf_token']) || !hash_equals($_SESSION['_csrf_token'], $token)) {
            if (function_exists('error_log')) {
                error_log('[CSRF] Token inválido desde ' . ($_SERVER['REMOTE_ADDR'] ?? 'unknown'));
            }
            http_response_code(419);
            die('Sesión expirada o token inválido. Recarga la página e intenta de nuevo.');
        }
    }

    protected function render($view, $data = [])
    {
        if (!headers_sent()) {
            header('X-Content-Type-Options: nosniff');
            header('X-Frame-Options: SAMEORIGIN');
            header('Referrer-Policy: strict-origin-when-cross-origin');
        }

        extract($data);
        $viewPath = __DIR__ . '/../views/' . $view . '.php';
        if (file_exists($viewPath)) {
            require $viewPath;
        } else {
            if (function_exists('error_log')) {
                error_log("[Controller] Vista no encontrada: {$viewPath}");
            }
            http_response_code(500);
            echo 'Error interno del servidor.';
        }
    }

    protected function handleError($severity, $message, $file, $line)
    {
        if (function_exists('error_log')) {
            error_log("Fatal error: {$message} in {$file} on line {$line}");
        }
        http_response_code(500);
        echo 'Error interno del servidor.';
        exit;
    }

    protected function json($data, $code = 200)
    {
        http_response_code($code);
        header('Content-Type: application/json');
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        exit;
    }

    protected function redirect($url)
    {
        if (session_status() === PHP_SESSION_ACTIVE) {
            session_write_close();
        }
        header('Location: ' . BASE_URL . $url);
        exit;
    }

    protected function model($name)
    {
        $class = "App\\Models\\{$name}";
        return new $class();
    }

    protected function uploadFile($file, $folder = 'productos')
    {
        $this->lastUploadError = '';
        if (!isset($file['tmp_name']) || !is_uploaded_file($file['tmp_name'])) { $this->lastUploadError = 'No se recibió el archivo.'; return null; }
        if ($file['error'] !== UPLOAD_ERR_OK) {
            $errors = [1=>'El archivo excede upload_max_filesize (PHP).', 2=>'El archivo excede el tamaño máximo permitido.', 3=>'El archivo se subió parcialmente.', 4=>'No se seleccionó ningún archivo.', 6=>'Falta carpeta temporal.', 7=>'Error al escribir el archivo.', 8=>'Extensión rechazada.'];
            $this->lastUploadError = $errors[$file['error']] ?? 'Error de subida desconocido.';
            return null;
        }
        if (($file['size'] ?? 0) > 2 * 1024 * 1024) { $this->lastUploadError = 'El archivo supera los 2MB permitidos.'; return null; }

        $allowed = ['jpg', 'jpeg', 'png', 'webp'];
        $allowedMimes = ['image/jpeg', 'image/png', 'image/webp'];

        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if (!in_array($ext, $allowed, true)) { $this->lastUploadError = 'Formato de archivo no permitido (solo JPG, PNG, WebP).'; return null; }

        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = $finfo ? finfo_file($finfo, $file['tmp_name']) : false;
        if ($finfo) finfo_close($finfo);
        if ($mime === false || !in_array($mime, $allowedMimes, true)) { $this->lastUploadError = 'El tipo MIME del archivo no coincide con una imagen válida (recibido: ' . ($mime ?: 'desconocido') . ').'; return null; }

        try {
            $random = bin2hex(random_bytes(6));
        } catch (\Throwable $e) {
            $random = substr(str_replace('.', '', uniqid('', true)), -12);
        }
        $filename = time() . '_' . $random . '.' . $ext;
        $targetDir = __DIR__ . '/../../public/uploads/' . $folder . '/';

        if (!is_dir($targetDir)) {
            if (!mkdir($targetDir, 0755, true) && !is_dir($targetDir)) { $this->lastUploadError = 'No se pudo crear el directorio de subida.'; return null; }
        }
        if (!is_writable($targetDir)) { $this->lastUploadError = 'El directorio de subida no tiene permisos de escritura.'; return null; }

        $tempPath = $targetDir . $filename;
        if (move_uploaded_file($file['tmp_name'], $tempPath)) {
            $storedName = $filename;
            $storedExt = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
            if ($storedExt !== 'webp' && in_array($storedExt, ['avif', 'webp', 'png', 'gif', 'jpg', 'jpeg'], true) && function_exists('imagecreatefromstring') && function_exists('imagejpeg')) {
                $image = @imagecreatefromstring(file_get_contents($tempPath));
                if ($image !== false) {
                    $jpgName = preg_replace('/\.[^.]+$/', '.jpg', $filename);
                    $jpgPath = $targetDir . $jpgName;
                    $converted = imagecreatetruecolor(imagesx($image), imagesy($image));
                    if ($converted !== false) {
                        $copyOk = imagecopy($converted, $image, 0, 0, 0, 0, imagesx($image), imagesy($image));
                        $jpegOk = $copyOk && imagejpeg($converted, $jpgPath, 90);
                        imagedestroy($image);
                        imagedestroy($converted);
                        if ($jpegOk) {
                            @unlink($tempPath);
                            $storedName = $jpgName;
                        } else {
                            $this->lastUploadError = 'La conversión a JPG falló (posible memoria insuficiente).';
                        }
                    }
                }
            }
            return 'public/uploads/' . $folder . '/' . $storedName;
        }
        $this->lastUploadError = 'Error al mover el archivo subido (comprobar permisos del directorio).';
        return null;
    }

    protected $lastUploadError = '';

    protected function setFlash($key, $value)
    {
        if (!isset($_SESSION)) return;
        $_SESSION['_flash'][$key] = $value;
    }

    protected function getFlash($key = null)
    {
        if (!isset($_SESSION)) return $key ? null : [];
        if ($key === null) {
            $all = $_SESSION['_flash'] ?? [];
            unset($_SESSION['_flash']);
            return $all;
        }
        $val = $_SESSION['_flash'][$key] ?? null;
        unset($_SESSION['_flash'][$key]);
        return $val;
    }

    protected function getLastUploadError()
    {
        return $this->lastUploadError;
    }

    protected function deleteFile($path)
    {
        if ($path) {
            $fullPath = __DIR__ . '/../../' . $path;
            if (file_exists($fullPath)) {
                unlink($fullPath);
            }
        }
    }

    protected function normalizeExistingUpload($relPath)
    {
        if (!$relPath) return $relPath;
        if (strpos($relPath, 'public/uploads/') !== 0) return $relPath;
        $full = __DIR__ . '/../../' . $relPath;
        if (!file_exists($full)) return $relPath;
        $folder = basename(dirname($full));
        $name = basename($full);
        $base = pathinfo($name, PATHINFO_FILENAME);
        $ext = pathinfo($name, PATHINFO_EXTENSION);
        // If base name is already short (< 25 chars) keep it
        if (strlen($base) <= 25) return $relPath;
        try { $random = bin2hex(random_bytes(6)); } catch (\Throwable $e) { $random = substr(str_replace('.', '', uniqid('', true)), -12); }
        $newName = time() . '_' . $random . '.' . ($ext ?: 'jpg');
        $newRel = 'public/uploads/' . $folder . '/' . $newName;
        $newFull = __DIR__ . '/../../' . $newRel;
        if (!is_dir(dirname($newFull))) mkdir(dirname($newFull), 0755, true);
        if (@rename($full, $newFull)) {
            return $newRel;
        }
        return $relPath;
    }
}
