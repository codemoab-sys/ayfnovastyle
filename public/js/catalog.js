// ===== SLIDER (se ejecuta inmediatamente, no espera jQuery) =====
(function() {
    try {
        var s = document.querySelector('.heroSwiper');
        if (!s) return;
        var sl = s.querySelectorAll('.swiper-slide');
        if (sl.length < 1) return;
        if (sl.length === 1) {
            s.querySelector('.swiper-pagination') && (s.querySelector('.swiper-pagination').style.display = 'none');
            s.querySelector('.swiper-button-next') && (s.querySelector('.swiper-button-next').style.display = 'none');
            s.querySelector('.swiper-button-prev') && (s.querySelector('.swiper-button-prev').style.display = 'none');
            return;
        }
        var cur = 0;
        for (var i = 1; i < sl.length; i++) { sl[i].style.opacity = '0'; sl[i].style.pointerEvents = 'none'; }
        function go(n) {
            for (var i = 0; i < sl.length; i++) { sl[i].style.opacity = '0'; sl[i].style.pointerEvents = 'none'; }
            cur = (n + sl.length) % sl.length;
            sl[cur].style.opacity = '1'; sl[cur].style.pointerEvents = 'auto';
        }
        var nb = s.querySelector('.swiper-button-next');
        var pb = s.querySelector('.swiper-button-prev');
        if (nb) nb.onclick = function() { go(cur + 1); };
        if (pb) pb.onclick = function() { go(cur - 1); };
        setInterval(function() { go(cur + 1); }, 4000);
    } catch(e) {}
})();

var BASE_URL = typeof CATALOGO_BASE_URL !== 'undefined' ? CATALOGO_BASE_URL : '/';
var WHATSAPP_NUM = '51999000000';
var AYF_MODE = typeof AYF_MODE !== 'undefined' ? AYF_MODE : false;
var API_SEARCH_URL = AYF_MODE ? BASE_URL + 'ayf/api/buscar' : BASE_URL + 'api/buscar';
var PRODUCT_URL_PREFIX = AYF_MODE ? BASE_URL + 'ayf/producto/' : BASE_URL + 'producto/';
var SEARCH_URL_PREFIX = AYF_MODE ? BASE_URL + 'ayf/buscar' : BASE_URL + 'buscar';

$(function() {
    // ===== AOS INIT =====
    try {
        if (typeof AOS !== 'undefined') {
            AOS.init({ duration: 800, once: true, offset: 50 });
        }
    } catch(e) {}

    // ===== LIGHTGALLERY =====
    if (document.getElementById('lightgallery')) {
        lightGallery(document.getElementById('lightgallery'), {
            selector: '.gallery-item',
            download: false,
            zoom: true,
            actualSize: false,
            closable: true,
            escKey: true,
            showCloseIcon: true,
            plugins: [lgZoom]
        });
    }

    // ===== BACK TO TOP =====
    const backBtn = $('#backToTop');
    $(window).scroll(function() {
        if ($(this).scrollTop() > 400) backBtn.addClass('show');
        else backBtn.removeClass('show');
    });
    backBtn.click(function() {
        $('html, body').animate({ scrollTop: 0 }, 500);
    });

    // ===== DARK MODE =====
    const darkToggle = $('#darkModeToggle');
    const html = $('html');
    if (localStorage.getItem('darkMode') === 'true') {
        html.attr('data-bs-theme', 'dark');
        darkToggle.find('i').removeClass('bi-moon-stars').addClass('bi-sun');
    }
    darkToggle.click(function() {
        const isDark = html.attr('data-bs-theme') === 'dark';
        html.attr('data-bs-theme', isDark ? 'light' : 'dark');
        localStorage.setItem('darkMode', !isDark);
        darkToggle.find('i').toggleClass('bi-moon-stars bi-sun');
    });

    // ===== REAL-TIME SEARCH =====
    let searchTimeout;
    const searchInput = $('#searchInput');
    const searchResults = $('#searchResults');

    searchInput.on('input', function() {
        clearTimeout(searchTimeout);
        const q = $(this).val().trim();
        if (q.length < 2) { searchResults.removeClass('show'); return; }

        searchTimeout = setTimeout(function() {
            $.getJSON(API_SEARCH_URL, { q: q }, function(data) {
                if (!data || !data.length) {
                    searchResults.html('<div class="p-3 text-muted text-center small">No se encontraron resultados</div>').addClass('show');
                    return;
                }
                let html = '';
                data.slice(0, 8).forEach(function(p) {
                    const img = p.imagen_principal ? BASE_URL + p.imagen_principal : '';
                    const name = p.nombre_comercial || p.nombre;
                    const catName = p.familia_nombre || p.categoria_nombre || '';
                    html += '<a href="' + PRODUCT_URL_PREFIX + p.id + '" class="result-item">';
                    if (img) html += '<img src="' + img + '" alt="' + name + '">';
                    else html += '<div style="width:45px;height:45px;border-radius:8px;background:#f0f0f0;display:flex;align-items:center;justify-content:center"><i class="bi bi-image text-muted"></i></div>';
                    html += '<div><strong class="small">' + name + '</strong><small>' + (p.codigo || '') + (catName ? ' | ' + catName : '') + '</small></div>';
                    html += '</a>';
                });
                if (data.length > 8) html += '<div class="p-2 text-center"><a href="' + SEARCH_URL_PREFIX + '?q=' + encodeURIComponent(q) + '" class="small text-primary">Ver todos los resultados</a></div>';
                searchResults.html(html).addClass('show');
            }).fail(function() { searchResults.removeClass('show'); });
        }, 300);
    });

    $(document).on('click', function(e) {
        if (!$(e.target).closest('.search-box').length) searchResults.removeClass('show');
        var $navbar = $('#navbarMain');
        if ($navbar.hasClass('show') && !$(e.target).closest('.navbar').length) {
            $navbar.collapse('hide');
        }
    });

    // ===== SMOOTH SCROLL =====
    $('a[href^="#"]').on('click', function(e) {
        const target = $(this.getAttribute('href'));
        if (target.length) { e.preventDefault(); $('html, body').animate({ scrollTop: target.offset().top - 80 }, 500); }
    });

    // ===== STICKY HEADER SHADOW =====
    $(window).scroll(function() {
        if ($(this).scrollTop() > 50) $('.header').addClass('shadow-sm');
        else $('.header').removeClass('shadow-sm');
    });

    // ===== GALLERY THUMBS =====
    $('.gallery-thumbs .thumb').on('click', function(e) {
        e.preventDefault();
        $('.gallery-thumbs .thumb').removeClass('active');
        $(this).addClass('active');
        const src = $(this).find('img').attr('src');
        $('.product-gallery .main-image img').attr('src', src);
        $('.product-gallery .main-image').attr('href', src);
    });

    // ===== CATEGORIA DROPDOWN SEARCH =====
    const $catSearch = $('#categoriaSearch');
    if ($catSearch.length) {
        $catSearch.on('input', function() {
            const q = $(this).val().toLowerCase().trim();
            $('#categoriaList .categoria-item').each(function() {
                const name = $(this).data('nombre') || '';
                $(this).toggle(name.indexOf(q) !== -1);
            });
        });
        $catSearch.on('click', function(e) { e.stopPropagation(); });
    }

    // ===== FAMILIAS SEARCH + PAGINATION =====
    const $famItems = $('.familia-item');
    const perPage = 12;
    let famPage = 1;
    let famFiltered = $famItems;

    function getFilteredItems() {
        const q = $('#familiaSearch').val().toLowerCase().trim();
        if (!q) return $famItems;
        return $famItems.filter(function() {
            return $(this).data('nombre').indexOf(q) !== -1;
        });
    }

    function showFamPage(page, filtered) {
        famFiltered = filtered;
        const total = filtered.length;
        const totalPages = Math.ceil(total / perPage) || 1;
        $famItems.hide();
        filtered.each(function(i) {
            const start = (page - 1) * perPage;
            const end = start + perPage;
            if (i >= start && i < end) $(this).show();
        });
        const showPagination = totalPages > 1;
        $('#familiasPagination').toggle(showPagination);
        if (showPagination) {
            $('#famPageInfo').text(page + ' / ' + totalPages);
            $('#famPrevPage').prop('disabled', page === 1);
            $('#famNextPage').prop('disabled', page === totalPages);
        }
    }

    const initialTotal = $famItems.length;
    if (initialTotal > 1) {
        showFamPage(1, $famItems);
        $('#famPrevPage').on('click', function() {
            if (famPage > 1) { famPage--; showFamPage(famPage, famFiltered); }
        });
        $('#famNextPage').on('click', function() {
            const totalPages = Math.ceil(famFiltered.length / perPage) || 1;
            if (famPage < totalPages) { famPage++; showFamPage(famPage, famFiltered); }
        });
        $('#familiaSearch').on('input', function() {
            famPage = 1;
            showFamPage(1, getFilteredItems());
        });
    }
});
