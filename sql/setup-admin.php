<?php
/**
 * Run once to seed the admin user with a known password.
 * Usage: php sql/setup-admin.php
 * Or deploy and delete after use.
 */

require __DIR__ . '/../config/database.php';
require __DIR__ . '/../app/core/Database.php';

use App\Core\Database;

$db = Database::getInstance()->getConnection();

$email = 'admin@drofar.com';
$nombre = 'Administrador';
$password = password_hash('admin123', PASSWORD_DEFAULT);

$stmt = $db->prepare("SELECT id FROM usuarios WHERE email = ? LIMIT 1");
$stmt->execute([$email]);
$exists = $stmt->fetch();

if ($exists) {
    $stmt = $db->prepare("UPDATE usuarios SET password = ?, estado = 1 WHERE email = ?");
    $stmt->execute([$password, $email]);
    echo "Admin password updated.\n";
} else {
    $stmt = $db->prepare("INSERT INTO usuarios (nombre, email, password, rol, estado) VALUES (?, ?, ?, 'admin', 1)");
    $stmt->execute([$nombre, $email, $password]);
    echo "Admin user created.\n";
}

echo "Email: $email\nPassword: admin123\n";
