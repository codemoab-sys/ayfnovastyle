<?php
$title = 'Contacto';
$c = $_AYF ?? [];
ob_start();
?>
<?php $bannerImg = !empty($c['banner_contacto']) ? BASE_URL . $c['banner_contacto'] : ''; ?>
<div>
    <div class="text-white py-5 position-relative overflow-hidden" style="background:<?= $bannerImg ? 'center/cover no-repeat' : 'linear-gradient(135deg, var(--primary), var(--primary-hover))' ?>;<?= $bannerImg ? 'background-image:url('.$bannerImg.')' : '' ?>">
        <?php if ($bannerImg): ?><div class="position-absolute top-0 start-0 w-100 h-100" style="background:rgba(0,0,0,0.55);"></div><?php endif; ?>
        <div class="container text-center position-relative" style="z-index:1;">
            <span class="badge bg-white text-primary px-3 py-2 mb-2 rounded-pill">Contacto</span>
            <h2 class="fw-bold mb-1">Contáctanos</h2>
            <p class="mb-0 opacity-75">Estamos aquí para ayudarte</p>
        </div>
    </div>
    <div class="container py-4">
        <div class="row g-4">
            <div class="col-lg-5">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-4">Información de Contacto</h5>

                        <div class="d-flex mb-3">
                            <div class="me-3 fs-5 text-primary"><i class="bi bi-whatsapp"></i></div>
                            <div>
                                <small class="text-muted d-block">WhatsApp</small>
                                <a href="https://wa.me/<?= htmlspecialchars($c['whatsapp'] ?? '51995218178') ?>" class="text-decoration-none fw-bold">+<?= htmlspecialchars($c['whatsapp'] ?? '51995218178') ?></a>
                            </div>
                        </div>

                        <div class="d-flex mb-3">
                            <div class="me-3 fs-5 text-primary"><i class="bi bi-telephone"></i></div>
                            <div>
                                <small class="text-muted d-block">Teléfono</small>
                                <span class="fw-bold"><?= htmlspecialchars($c['phone'] ?? '953571861') ?></span>
                            </div>
                        </div>

                        <div class="d-flex mb-3">
                            <div class="me-3 fs-5 text-primary"><i class="bi bi-envelope"></i></div>
                            <div>
                                <small class="text-muted d-block">Email</small>
                                <a href="mailto:<?= htmlspecialchars($c['email'] ?? 'ventas@ayfnovastyle.com') ?>" class="text-decoration-none fw-bold"><?= htmlspecialchars($c['email'] ?? 'ventas@ayfnovastyle.com') ?></a>
                            </div>
                        </div>

                        <div class="d-flex mb-4">
                            <div class="me-3 fs-5 text-primary"><i class="bi bi-geo-alt"></i></div>
                            <div>
                                <small class="text-muted d-block">Dirección</small>
                                <span class="fw-bold"><?= htmlspecialchars($c['address'] ?? 'Trujillo, Perú') ?></span>
                            </div>
                        </div>

                        <h6 class="fw-bold mb-3">Síguenos</h6>
                        <div class="d-flex gap-2">
                            <?php if (!empty($c['facebook'])): ?><a href="<?= $c['facebook'] ?>" target="_blank" class="btn btn-outline-primary btn-lg rounded-circle"><i class="bi bi-facebook"></i></a><?php endif; ?>
                            <?php if (!empty($c['instagram'])): ?><a href="<?= $c['instagram'] ?>" target="_blank" class="btn btn-outline-primary btn-lg rounded-circle"><i class="bi bi-instagram"></i></a><?php endif; ?>
                            <?php if (!empty($c['tiktok'])): ?><a href="<?= $c['tiktok'] ?>" target="_blank" class="btn btn-outline-primary btn-lg rounded-circle"><i class="bi bi-tiktok"></i></a><?php endif; ?>
                            <?php if (!empty($c['youtube'])): ?><a href="<?= $c['youtube'] ?>" target="_blank" class="btn btn-outline-primary btn-lg rounded-circle"><i class="bi bi-youtube"></i></a><?php endif; ?>
                            <?php if (!empty($c['linkedin'])): ?><a href="<?= $c['linkedin'] ?>" target="_blank" class="btn btn-outline-primary btn-lg rounded-circle"><i class="bi bi-linkedin"></i></a><?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-7">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-4">Envíanos un Mensaje</h5>

                        <?php if ($error): ?>
                            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                        <?php endif; ?>
                        <?php if ($success): ?>
                            <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
                        <?php endif; ?>

                        <form method="POST" action="<?= BASE_URL ?>ayf/contacto">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Nombre *</label>
                                    <input type="text" name="nombre" class="form-control form-control-lg" value="<?= htmlspecialchars($nombre) ?>" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Email *</label>
                                    <input type="email" name="email" class="form-control form-control-lg" value="<?= htmlspecialchars($email) ?>" required>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">Teléfono</label>
                                    <input type="text" name="telefono" class="form-control form-control-lg" value="<?= htmlspecialchars($telefono) ?>">
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">Mensaje *</label>
                                    <textarea name="mensaje" class="form-control form-control-lg" rows="6" required><?= htmlspecialchars($mensaje) ?></textarea>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary btn-lg px-5 rounded-pill"><i class="bi bi-send me-2"></i>Enviar Mensaje</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
$content = ob_get_clean();
require __DIR__ . '/ayf_layout.php';
