<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../app/core/Database.php';
use App\Core\Database;
$db = Database::getInstance()->getConnection();
$rows = $db->query("SELECT id, titulo, imagen, estado FROM ayf_banners ORDER BY id ASC")->fetchAll(PDO::FETCH_ASSOC);
foreach ($rows as $r) {
    $id = $r['id']; $img = $r['imagen']; $estado = $r['estado'];
    $full = __DIR__ . '/../' . $img;
    $exists = file_exists($full) ? 'YES' : 'NO';
    $size = $exists ? filesize($full) : 0;
    $perms = $exists ? substr(sprintf('%o', fileperms($full)), -4) : '----';
    echo "id={$id}\testado={$estado}\timagen={$img}\texists={$exists}\tsize={$size}\tperms={$perms}\n";
}
