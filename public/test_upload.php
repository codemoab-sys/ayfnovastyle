<?php
// Simple upload tester. Upload an image to check if the server can write to public/uploads/ayf_banners
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_FILES['f']) || $_FILES['f']['error'] !== UPLOAD_ERR_OK) {
        echo 'Upload error: ' . ($_FILES['f']['error'] ?? 'no file');
        exit;
    }
    $targetDir = __DIR__ . '/uploads/ayf_banners/';
    if (!is_dir($targetDir)) mkdir($targetDir, 0755, true);
    $ext = strtolower(pathinfo($_FILES['f']['name'], PATHINFO_EXTENSION)) ?: 'jpg';
    try { $name = time() . '_' . bin2hex(random_bytes(6)) . '.' . $ext; } catch (Throwable $e) { $name = time() . '_' . uniqid() . '.' . $ext; }
    $full = $targetDir . $name;
    if (move_uploaded_file($_FILES['f']['tmp_name'], $full)) {
        echo "Saved OK: public/uploads/ayf_banners/" . $name . " (size=" . filesize($full) . ")";
    } else {
        echo 'Failed to move uploaded file.';
    }
    exit;
}
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Test Upload</title></head>
<body>
<h2>Upload test image</h2>
<form method="post" enctype="multipart/form-data">
  <input type="file" name="f" accept="image/*" required />
  <button type="submit">Upload test</button>
</form>
</body>
</html>
