<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../app/core/Database.php';

use App\Core\Database;

$db = Database::getInstance()->getConnection();
$rows = $db->query("SELECT id, titulo, imagen, orden, estado, link FROM ayf_banners ORDER BY id ASC")->fetchAll(PDO::FETCH_ASSOC);
if (!$rows) { echo "No banners found.\n"; exit; }
foreach ($rows as $r) {
    $id = $r['id'];
    $titulo = $r['titulo'] ?? '';
    $imagen = $r['imagen'] ?? '';
    $orden = $r['orden'] ?? '';
    $estado = $r['estado'] ?? '';
    $link = $r['link'] ?? '';
    echo "id={$id}\torden={$orden}\testado={$estado}\ttitulo={$titulo}\tlink={$link}\timagen={$imagen}\n";
}
