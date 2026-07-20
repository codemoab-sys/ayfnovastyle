<?php ob_start(); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Configuración</h2>
</div>
<div class="card">
    <div class="card-body">
        <form method="POST" enctype="multipart/form-data" action="<?= BASE_URL ?>ayf-admin/configuracion">
            <?= csrf_field() ?>
            <ul class="nav nav-tabs mb-4" id="configTabs">
                <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#tab-general">General</a></li>
                <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#tab-contacto">Contacto</a></li>
                <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#tab-social">Redes Sociales</a></li>
                <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#tab-apariencia">Apariencia</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="tab-general">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Logo</label>
                            <input type="file" name="logo" class="form-control" accept="image/*">
                            <?php if (!empty($config['logo']['valor'])): ?>
                            <div class="mt-2"><img src="<?=BASE_URL.$config['logo']['valor']?>" height="60"></div>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-6"><label class="form-label">Nombre del Sitio</label><input type="text" name="site_name" class="form-control" value="<?=htmlspecialchars($config['site_name']['valor']??'')?>"></div>
                        <div class="col-12"><label class="form-label">Descripción</label><textarea name="site_desc" class="form-control" rows="3"><?=htmlspecialchars($config['site_desc']['valor']??'')?></textarea></div>
                    </div>
                </div>
                <div class="tab-pane fade" id="tab-contacto">
                    <div class="row g-3">
                        <div class="col-md-6"><label class="form-label">WhatsApp (número)</label><input type="text" name="whatsapp" class="form-control" value="<?=htmlspecialchars($config['whatsapp']['valor']??'')?>"></div>
                        <div class="col-md-6"><label class="form-label">Mensaje WhatsApp</label><input type="text" name="whatsapp_msg" class="form-control" value="<?=htmlspecialchars($config['whatsapp_msg']['valor']??'')?>"></div>
                        <div class="col-md-6"><label class="form-label">Email</label><input type="email" name="email" class="form-control" value="<?=htmlspecialchars($config['email']['valor']??'')?>"></div>
                        <div class="col-md-6"><label class="form-label">Teléfono</label><input type="text" name="phone" class="form-control" value="<?=htmlspecialchars($config['phone']['valor']??'')?>"></div>
                        <div class="col-12"><label class="form-label">Dirección</label><input type="text" name="address" class="form-control" value="<?=htmlspecialchars($config['address']['valor']??'')?>"></div>
                    </div>
                </div>
                <div class="tab-pane fade" id="tab-social">
                    <div class="row g-3">
                        <div class="col-md-6"><label class="form-label">Facebook</label><input type="url" name="facebook" class="form-control" value="<?=htmlspecialchars($config['facebook']['valor']??'')?>"></div>
                        <div class="col-md-6"><label class="form-label">Instagram</label><input type="url" name="instagram" class="form-control" value="<?=htmlspecialchars($config['instagram']['valor']??'')?>"></div>
                        <div class="col-md-6"><label class="form-label">LinkedIn</label><input type="url" name="linkedin" class="form-control" value="<?=htmlspecialchars($config['linkedin']['valor']??'')?>"></div>
                        <div class="col-md-6"><label class="form-label">TikTok</label><input type="url" name="tiktok" class="form-control" value="<?=htmlspecialchars($config['tiktok']['valor']??'')?>"></div>
                        <div class="col-md-6"><label class="form-label">YouTube</label><input type="url" name="youtube" class="form-control" value="<?=htmlspecialchars($config['youtube']['valor']??'')?>"></div>
                    </div>
                </div>
                <div class="tab-pane fade" id="tab-apariencia">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label">Color Primario</label>
                            <input type="color" name="theme_primary" class="form-control form-control-color" value="<?=htmlspecialchars($config['theme_primary']['valor']??'#e63946')?>">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Primario (Hover)</label>
                            <input type="color" name="theme_primary_hover" class="form-control form-control-color" value="<?=htmlspecialchars($config['theme_primary_hover']['valor']??'#d62839')?>">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Color Secundario</label>
                            <input type="color" name="theme_secondary" class="form-control form-control-color" value="<?=htmlspecialchars($config['theme_secondary']['valor']??'#1a1a2e')?>">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Color Acento</label>
                            <input type="color" name="theme_accent" class="form-control form-control-color" value="<?=htmlspecialchars($config['theme_accent']['valor']??'#e63946')?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Banner de Contacto (imagen)</label>
                            <input type="file" name="banner_contacto" class="form-control" accept="image/*">
                            <?php if (!empty($config['banner_contacto']['valor'])): ?>
                            <div class="mt-2"><img src="<?=BASE_URL.$config['banner_contacto']['valor']?>" height="80" class="rounded"></div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Guardar Configuración</button>
            </div>
        </form>
    </div>
</div>
<?php $content = ob_get_clean(); $title = 'Configuración'; require __DIR__.'/ayf_layout.php'; ?>
