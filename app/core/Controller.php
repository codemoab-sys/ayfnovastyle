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
        if (!isset($file['tmp_name']) || !is_uploaded_file($file['tmp_name'])) return null;
        if ($file['error'] !== UPLOAD_ERR_OK) return null;
        if (($file['size'] ?? 0) > 2 * 1024 * 1024) return null;

        $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'avif'];
        $allowedMimes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp', 'image/avif'];

        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if (!in_array($ext, $allowed, true)) return null;

        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = $finfo ? finfo_file($finfo, $file['tmp_name']) : false;
        if ($finfo) finfo_close($finfo);
        if ($mime === false || !in_array($mime, $allowedMimes, true)) return null;

        $baseName = preg_replace('/[^a-zA-Z0-9._-]/', '', pathinfo($file['name'], PATHINFO_FILENAME));
        $baseName = $baseName !== '' ? $baseName : 'upload';
        $filename = $baseName . '_' . uniqid('', true) . '_' . time() . '.' . $ext;
        $targetDir = __DIR__ . '/../../public/uploads/' . $folder . '/';

        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0755, true);
        }

        $tempPath = $targetDir . $filename;
        if (move_uploaded_file($file['tmp_name'], $tempPath)) {
            $storedName = $filename;
            $storedExt = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
            if (in_array($storedExt, ['avif', 'webp', 'png', 'gif', 'jpg', 'jpeg'], true) && function_exists('imagecreatefromstring') && function_exists('imagejpeg')) {
                $image = @imagecreatefromstring(file_get_contents($tempPath));
                if ($image !== false) {
                    $jpgName = preg_replace('/\.[^.]+$/', '.jpg', $filename);
                    $jpgPath = $targetDir . $jpgName;
                    $converted = imagecreatetruecolor(imagesx($image), imagesy($image));
                    if ($converted !== false) {
                        imagecopy($converted, $image, 0, 0, 0, 0, imagesx($image), imagesy($image));
                        imagejpeg($converted, $jpgPath, 90);
                        imagedestroy($image);
                        imagedestroy($converted);
                        @unlink($tempPath);
                        $storedName = $jpgName;
                    }
                }
            }
            return 'public/uploads/' . $folder . '/' . $storedName;
        }
        return null;
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
}
