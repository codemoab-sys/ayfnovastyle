<?php
// Usage: php normalize_uploads.php [--apply] [--folders=ayf_productos,ayf_banners]
// Default: dry-run (no changes). Use --apply to perform renames and DB updates.

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../app/core/Database.php';

use App\Core\Database;

// Simple helper to convert images to JPG and return new filepath (or null on failure)
function convert_to_jpg($path, $targetPath)
{
    if (!file_exists($path)) return null;
    $data = @file_get_contents($path);
    if ($data === false) return null;
    $img = @imagecreatefromstring($data);
    if ($img === false) return null;
    $w = imagesx($img);
    $h = imagesy($img);
    $dst = imagecreatetruecolor($w, $h);
    if ($dst === false) { imagedestroy($img); return null; }
    imagecopy($dst, $img, 0, 0, 0, 0, $w, $h);
    $ok = imagejpeg($dst, $targetPath, 90);
    imagedestroy($img);
    imagedestroy($dst);
    return $ok ? $targetPath : null;
}

function shortname($ext)
{
    try { $random = bin2hex(random_bytes(6)); } catch (Throwable $e) { $random = substr(str_replace('.', '', uniqid('', true)), -12); }
    return time() . '_' . $random . '.' . $ext;
}

$apply = in_array('--apply', $argv, true);
$folderArg = null;
foreach ($argv as $a) { if (strpos($a, '--folders=') === 0) $folderArg = substr($a, strlen('--folders=')); }
$foldersFilter = $folderArg ? explode(',', $folderArg) : null;

$root = realpath(__DIR__ . '/../public/uploads');
if (!$root || !is_dir($root)) {
    echo "public/uploads directory not found: {__DIR__}/../public/uploads\n";
    exit(1);
}

$map = [
    ['table' => 'ayf_productos', 'column' => 'imagen_principal', 'folder' => 'ayf_productos'],
    ['table' => 'ayf_producto_imagenes', 'column' => 'imagen', 'folder' => 'ayf_productos'],
    ['table' => 'ayf_banners', 'column' => 'imagen', 'folder' => 'ayf_banners'],
    ['table' => 'ayf_categorias', 'column' => 'imagen', 'folder' => 'ayf_categorias'],
    ['table' => 'ayf_categorias', 'column' => 'icono', 'folder' => 'ayf_categorias'],
    ['table' => 'ayf_marcas', 'column' => 'logo', 'folder' => 'ayf_marcas'],
    // ayf_configuracion stores values in 'valor' keyed by 'clave'
];

echo ($apply ? "Running in APPLY mode\n" : "Dry-run mode (no changes). Use --apply to make changes)\n");

$db = Database::getInstance()->getConnection();

$changes = [];

foreach ($map as $m) {
    if ($foldersFilter && !in_array($m['folder'], $foldersFilter, true)) continue;
    $table = $m['table'];
    $col = $m['column'];
    $folder = $m['folder'];
    $sql = "SELECT id, {$col} FROM {$table} WHERE {$col} IS NOT NULL AND {$col} != ''";
    $rows = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    foreach ($rows as $r) {
        $id = $r['id'];
        $val = $r[$col];
        if (strpos($val, 'public/uploads/') === false) continue;
        $full = realpath(__DIR__ . '/../' . $val) ?: (__DIR__ . '/../' . $val);
        if (!file_exists($full)) { echo "MISSING: {$val} (table {$table} id={$id})\n"; continue; }
        $ext = strtolower(pathinfo($full, PATHINFO_EXTENSION));
        $newExt = in_array($ext, ['jpg','jpeg']) ? 'jpg' : 'jpg';
        $newName = shortname($newExt);
        $newRel = 'public/uploads/' . $folder . '/' . $newName;
        $newFull = __DIR__ . '/../' . $newRel;
        if (file_exists($newFull)) { echo "Collision: {$newRel} exists, skipping\n"; continue; }

        $willConvert = !in_array($ext, ['jpg','jpeg']);
        $action = [];
        if ($willConvert) {
            $converted = convert_to_jpg($full, $newFull);
            if ($converted) {
                $action[] = "convert {$val} -> {$newRel}";
                // Remove original
                if ($apply) @unlink($full);
            } else {
                echo "FAILED_CONVERT: {$val}\n";
                continue;
            }
        } else {
            // simple rename
            if ($apply) {
                if (!is_dir(dirname($newFull))) mkdir(dirname($newFull), 0755, true);
                $moved = @rename($full, $newFull);
                if (!$moved) { echo "FAILED_RENAME: {$val} -> {$newRel}\n"; continue; }
            }
            $action[] = "rename {$val} -> {$newRel}";
        }

        // Update DB
        if ($apply) {
            $upd = $db->prepare("UPDATE {$table} SET {$col} = ? WHERE id = ?");
            $upd->execute([$newRel, $id]);
            echo "UPDATED DB: {$table}.{$col} id={$id} => {$newRel}\n";
        } else {
            echo "PROPOSE: {$table}.{$col} id={$id} => {$newRel} (" . implode(', ', $action) . ")\n";
        }
        $changes[] = [$table, $col, $id, $val, $newRel];
    }
}

// Handle ayf_configuracion special keys
$cfgKeys = ['logo','banner_contacto'];
if (!$foldersFilter || in_array('ayf_config', $foldersFilter, true)) {
    $stmt = $db->prepare("SELECT id, clave, valor FROM ayf_configuracion WHERE clave IN ('logo','banner_contacto')");
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($rows as $r) {
        $id = $r['id']; $clave = $r['clave']; $val = $r['valor'];
        if (strpos($val, 'public/uploads/') === false) continue;
        $full = realpath(__DIR__ . '/../' . $val) ?: (__DIR__ . '/../' . $val);
        if (!file_exists($full)) { echo "MISSING CONFIG: {$val} (clave={$clave})\n"; continue; }
        $ext = strtolower(pathinfo($full, PATHINFO_EXTENSION));
        $newExt = 'jpg';
        $newName = shortname($newExt);
        $newRel = 'public/uploads/ayf_config/' . $newName;
        $newFull = __DIR__ . '/../' . $newRel;
        if (file_exists($newFull)) { echo "Collision: {$newRel} exists, skipping\n"; continue; }
        $converted = convert_to_jpg($full, $newFull);
        if ($converted) {
            if ($apply) @unlink($full);
            if ($apply) {
                $upd = $db->prepare("UPDATE ayf_configuracion SET valor = ? WHERE id = ?");
                $upd->execute([$newRel, $id]);
                echo "UPDATED CONFIG id={$id} clave={$clave} => {$newRel}\n";
            } else {
                echo "PROPOSE CONFIG update id={$id} clave={$clave} => {$newRel}\n";
            }
            $changes[] = ['ayf_configuracion', 'valor', $id, $val, $newRel];
        } else {
            echo "FAILED_CONVERT_CONFIG: {$val}\n";
        }
    }
}

echo "\nSummary: " . count($changes) . " items processed (dry-run=" . ($apply ? 'no' : 'yes') . ")\n";

