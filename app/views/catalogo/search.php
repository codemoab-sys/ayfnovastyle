<?php $title = 'Buscar Productos'; ob_start(); ?>
<section class="page-header bg-gradient-green text-white">
    <div class="container text-center">
        <h1 class="fw-bold mb-1">Productos</h1>
        <p class="mb-0 opacity-75">Explora todos nuestros productos</p>
    </div>
</section>

<section class="section-padding">
    <div class="container">
        <form method="GET" class="row g-2 mb-4" id="searchForm">
            <div class="col-md-5">
                <div class="input-group">
                    <span class="input-group-text bg-white"><i class="bi bi-search text-muted"></i></span>
                    <input type="text" name="q" class="form-control form-control-lg" placeholder="Buscar por nombre, código..." value="<?=htmlspecialchars($search)?>">
                </div>
            </div>
            <div class="col-md-3">
                <select name="familia" class="form-select form-select-lg">
                    <option value="">Todas las familias</option>
                    <?php foreach ($familias as $f): ?>
                        <option value="<?=$f['id']?>" <?=$selectedFamilia==$f['id']?'selected':''?>><?=htmlspecialchars($f['nombre'])?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-2">
                <select name="marca" class="form-select form-select-lg">
                    <option value="">Todas las marcas</option>
                    <?php foreach ($marcas as $m): ?>
                        <option value="<?=$m['id']?>" <?=$selectedMarca==$m['id']?'selected':''?>><?=htmlspecialchars($m['nombre'])?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-2 d-flex gap-1">
                <button type="submit" class="btn btn-primary btn-lg rounded-pill flex-fill d-none"><i class="bi bi-search me-1"></i> Buscar</button>
                <a href="<?=BASE_URL?>buscar" class="btn btn-outline-secondary btn-lg rounded-pill flex-fill <?=($search||$selectedFamilia||$selectedMarca)?'':'d-none'?>" id="clearSearchBtn"><i class="bi bi-x-lg"></i></a>
            </div>
        </form>

        <div id="searchResultsContainer"><?php require __DIR__.'/search-results.php'; ?></div>
    </div>
</section>
<script>
(function() {
    var pending = setInterval(function() {
        if (typeof jQuery === 'undefined' || typeof BASE_URL === 'undefined') return;
        clearInterval(pending);
        $(function() {
            var searchTimeout;
            var $form = $('#searchForm');
            var $q = $form.find('[name=q]');
            var $familia = $form.find('[name=familia]');
            var $marca = $form.find('[name=marca]');
            var $container = $('#searchResultsContainer');

            function doSearch() {
                var params = {};
                var q = $q.val().trim();
                if (q) params.q = q;
                if ($familia.val()) params.familia = $familia.val();
                if ($marca.val()) params.marca = $marca.val();
                var hasFilters = q || $familia.val() || $marca.val();
                var qs = $.param(params);
                history.replaceState(null, '', BASE_URL + 'buscar' + (qs ? '?' + qs : ''));
                $('#clearSearchBtn').toggleClass('d-none', !hasFilters);
                $.ajax({
                    url: BASE_URL + 'buscar' + (qs ? '?' + qs : ''),
                    beforeSend: function(xhr) { xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest'); },
                    success: function(html) { $container.html(html); }
                });
            }

            $q.on('input', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(doSearch, 300);
            });
            $familia.on('change', doSearch);
            $marca.on('change', doSearch);
            $form.on('submit', function(e) { e.preventDefault(); doSearch(); });
            $container.on('click', '.search-page-link', function(e) {
                e.preventDefault();
                var url = $(this).attr('href');
                history.replaceState(null, '', url);
                $.ajax({
                    url: url,
                    beforeSend: function(xhr) { xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest'); },
                    success: function(html) { $container.html(html); }
                });
            });
        });
    }, 50);
})();
</script>
<?php
$content = ob_get_clean();
require __DIR__.'/layout.php';
