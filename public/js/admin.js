$(function() {

    // ============ SWEETALERT2 DELETE ============
    function del(selector, url, msg) {
        $(document).on('click', selector, function() {
            const btn = $(this);
            Swal.fire({
                title: '¿Confirmar eliminación?',
                text: msg || 'Esta acción no se puede deshacer',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then(result => {
                if (result.isConfirmed) {
                    $.post(BASE_URL + url + btn.data('id'), function() {
                        Swal.fire('Eliminado', '', 'success').then(() => location.reload());
                    }).fail(function() {
                        Swal.fire('Error', 'No se pudo eliminar', 'error');
                    });
                }
            });
        });
    }
    del('.delete-familia', 'admin/familias/eliminar/', 'Se eliminará la familia y todos sus productos');
    del('.delete-marca', 'admin/marcas/eliminar/', 'Se eliminará la marca y todos sus productos');
    del('.delete-producto', 'admin/productos/eliminar/', 'Se eliminará el producto permanentemente');
    del('.delete-banner', 'admin/banners/eliminar/', 'Se eliminará el banner');
    del('.delete-usuario', 'admin/usuarios/eliminar/', 'Se eliminará el usuario');
    del('.delete-bp', 'admin/buenas-practicas/eliminar/', 'Se eliminará esta buena práctica');
    // Generic delete for AYF system
    $(document).on('click', '.delete-item', function() {
        const btn = $(this);
        Swal.fire({
            title: '¿Confirmar eliminación?',
            text: 'Esta acción no se puede deshacer',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then(result => {
            if (result.isConfirmed) {
                $.post(BASE_URL + btn.data('url') + btn.data('id'), function() {
                    Swal.fire('Eliminado', '', 'success').then(() => location.reload());
                }).fail(function() {
                    Swal.fire('Error', 'No se pudo eliminar', 'error');
                });
            }
        });
    });

    // Gallery image delete
    $(document).on('click', '.del-galeria, .delete-galeria', function() {
        const btn = $(this);
        Swal.fire({
            title: '¿Eliminar esta imagen?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            confirmButtonText: 'Sí',
            cancelButtonText: 'No'
        }).then(result => {
            if (result.isConfirmed) {
                const url = btn.data('url') || 'admin/productos/eliminar-galeria/';
                $.post(BASE_URL + url + btn.data('id'), function() {
                    btn.closest('.position-relative').fadeOut(300, function() { $(this).remove(); });
                    Swal.fire('Eliminada', '', 'success');
                });
            }
        });
    });

    // ============ DROPZONE ============
    $('.dropzone').each(function() {
        const dz = $(this);
        const input = dz.find('input[type="file"]');
        const preview = dz.find('.dropzone-preview');

        dz.on('click', function(e) {
            if ($(e.target).closest('.del-galeria,.preview-item,.remove').length) return;
            if (input.length) input[0].click();
        });
        dz.on('dragover', function(e) { e.preventDefault(); dz.addClass('dragover'); });
        dz.on('dragleave', function() { dz.removeClass('dragover'); });
        dz.on('drop', function(e) {
            e.preventDefault(); dz.removeClass('dragover');
            if (e.originalEvent.dataTransfer.files.length && input.length) {
                input[0].files = e.originalEvent.dataTransfer.files;
                input.trigger('change');
            }
        });
        input.on('change', function() {
            preview.html('');
            $.each(this.files, function(i, file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.append('<div class="col-4 col-md-3"><div class="preview-item position-relative"><img src="'+e.target.result+'" class="img-fluid rounded" style="height:100px;object-fit:cover;width:100%"><button type="button" class="remove btn btn-sm btn-dark position-absolute top-0 end-0" style="width:24px;height:24px;padding:0;font-size:12px;border-radius:50%;">&times;</button></div></div>');
                };
                reader.readAsDataURL(file);
            });
        });
        preview.on('click', '.remove', function() { $(this).closest('.col-4,.col-3').remove(); });
    });

    // ============ TAB PERSISTENCE ============
    const hash = window.location.hash;
    if (hash) $('.nav-tabs a[href="' + hash + '"]').tab('show');
    $('.nav-tabs a').on('shown.bs.tab', function(e) {
        history.replaceState(null, null, e.target.hash);
    });

    // ============ MODAL CRUD FAMILIAS / MARCAS ============
    $(document).on('click', '.btn-modal-create', function() {
        const modal = $($(this).data('modal'));
        modal.find('form')[0].reset();
        modal.find('input[name="id"]').val('');
        modal.find('.modal-title').text($(this).data('title') || 'Nuevo');
        modal.find('input[type="color"]').val('#009933');
        modal.find('.current-file').hide();
        modal.modal('show');
    });

    $(document).on('click', '.btn-modal-edit', function() {
        const modal = $($(this).data('modal'));
        const id = $(this).data('id');
        modal.find('.modal-title').text('Editar');
        modal.find('input[name="id"]').val(id);
        // Load data via AJAX
        $.get(BASE_URL + $(this).data('url') + id, function(data) {
            const form = modal.find('form');
            $.each(data, function(key, val) {
                const input = form.find('[name="' + key + '"]');
                if (input.length) {
                    if (input.is('select')) input.val(val);
                    else if (input.is('textarea')) input.val(val);
                    else if (input.attr('type') === 'color') input.val(val || '#009933');
                    else input.val(val);
                }
            });
            // Show current images
            modal.find('.current-file').show();
            if (data.imagen) modal.find('.current-img').attr('src', BASE_URL + data.imagen);
            if (data.icono) modal.find('.current-icono').attr('src', BASE_URL + data.icono);
            if (data.logo) modal.find('.current-logo').attr('src', BASE_URL + data.logo);
            modal.modal('show');
        }).fail(function() {
            Swal.fire('Error', 'No se pudo cargar los datos', 'error');
        });
    });

    $(document).on('submit', '.modal-form', function(e) {
        e.preventDefault();
        const form = $(this);
        const btn = form.find('button[type="submit"]');
        btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm"></span>');

        $.ajax({
            url: form.attr('action'),
            method: 'POST',
            data: new FormData(this),
            processData: false,
            contentType: false,
            success: function(res) {
                Swal.fire('Guardado', '', 'success').then(() => location.reload());
            },
            error: function(xhr) {
                Swal.fire('Error', xhr.responseJSON?.error || 'Error al guardar', 'error');
                btn.prop('disabled', false).text('Guardar');
            }
        });
    });

    // ============ SEARCH & PAGINATION ============
    $('.table-search').on('keyup', function() {
        const value = this.value.toLowerCase();
        const table = $(this).closest('.card').find('table tbody');
        table.find('tr').each(function() {
            $(this).toggle($(this).text().toLowerCase().includes(value));
        });
    });

    $('.pagination .page-link').click(function(e) {
        if ($(this).data('page')) {
            e.preventDefault();
            const url = new URL(window.location);
            url.searchParams.set('page', $(this).data('page'));
            window.location = url.toString();
        }
    });

});
