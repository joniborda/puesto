if (typeof model_location == 'undefined') {
    var model_location = 'Persona';
}
var prov_id = null;
var reg_id = null;

if (typeof mostrar_loading == 'undefined') {
    function mostrar_loading(sin_close, selector) {
        var options = {
            modal : true
        }

        if (!$('.loading').length) {
            if (sin_close) {
                options['closeOnEscape'] = false;
                options['open'] = function(event, ui) {
                    $(".ui-dialog-titlebar-close").hide();
                };
            }
            div_loading = 
            '<div class="loading">' +
            '<img src="' + base_url + 'img/loading.gif' + '" height="170px" />' +
            '</div>';

            if (typeof selector != 'undefined') {
                $(selector).append(div_loading);
            } else {
                var a = $(div_loading).dialog(options);
                a.closest('.ui-dialog').find('.ui-dialog-titlebar').remove();
                $('.progress-bar').attr('aria-valuenow', 100);
                $('.progress-bar').css('width', '100%');
            }
            setTimeout(function() {
                $('.progress-bar').attr('aria-valuenow', 100);
                $('.progress-bar').css('width', '100%');
            }, 100);

            $('.ui-widget-content').css('background', 'transparent');
        }
    }
}

/**
 * Carga la ubicacion para modelos particulares
 * 
 * @param model_location
 */
function cargar_ubicacion(model_location, selector_provincia, selector_departamento, selector_localidad) {

    var selector_provincia = selector_provincia || $('input[id="' + model_location + 'Provincia"]'),
        selector_departamento = selector_departamento || $('input[id="' + model_location + 'Departamento"]'),
        selector_localidad = selector_localidad || $('input[id="' + model_location + 'Localidad"]');
    
    $(selector_provincia).autocomplete({
        source : function(request, response) {
            $.ajax({
                url: base_url + 'admin/ubicaciones/auto_provincia',
                dataType: "json",
                data: {
                    q: request.term,
                    model: model_location
                },
                complete: function( data ) {
                    response( jQuery.parseJSON(data.responseText));
                }
            });
        },
        select: function(event, ui) {
            //$(selector_provincia).val(ui.item.id);
        },
        search: function(event, ui) {
            //$(selector_provincia).val('');
        },
        autoFocus: true
    }).focus(function() {
        $(this).autocomplete('search');
    });

    $(selector_departamento).autocomplete({
        source : function(request, response) {
            $.ajax({
                url: base_url + 'admin/ubicaciones/auto_departamento',
                dataType: "json",
                data: {
                    q: request.term,
                    model: model_location,
                    provincia: $(selector_provincia).val()
                },
                complete: function( data ) {
                    response( jQuery.parseJSON(data.responseText));
                }
            });
            
        },
        select: function(event, ui) {
            //$(selector_departamento).val(ui.item.id);
        },
        search: function(event, ui) {
            //$(selector_departamento).val('');
        },
        autoFocus: true
    }).focus(function() {
        $(this).autocomplete('search');
    });

    $(selector_localidad).autocomplete({
        source : function(request, response) {
            $.ajax({
                url: base_url + 'admin/ubicaciones/auto_localidad',
                dataType: "json",
                data: {
                    q: request.term,
                    model: model_location,
                    provincia: $(selector_provincia).val(),
                    departamento: $(selector_departamento).val()
                },
                complete: function( data ) {
                    response( jQuery.parseJSON(data.responseText));
                }
            });
            
        },
        select: function(event, ui) {
            //$(selector_localidad).val(ui.item.id);
        },
        search: function(event, ui) {
            //$(selector_localidad).val('');
        },
        autoFocus: true
    }).focus(function() {
        $(this).autocomplete('search');
    });
}
