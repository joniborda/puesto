var debug = true;
$(document).ready(function() {

    datepicker();

    $('.jtooltip').tooltip();
    $('.jtooltip').attr('autocomplete', 'false');

    if ($('select[multiple]').multiselect) {

        $('select[multiple]').multiselect({
            enableFiltering : true,
            enableCaseInsensitiveFiltering : true
        });
    }
    
    $('form').submit(function(e) {
        if ($('.has-error').length) {
            e.preventDefault();
            $('.has-error').find('input:first').focus();
            
        } else {
            mostrar_loading();
        }
    });

    $(document).on('click', 'a.click_file', function(e) {
        e.stopImmediatePropagation();
        $(this).parent().find('input[type="file"]').click();
        return false;
    });
    /*
    $('input[type="file"]').change(function (){
        var fileName = $(this).val();
        $(this).closest('.col-sm-6').find(".div_image").html(
                '<div class="img_foto">' +
                '<span class="glyphicon glyphicon-upload" style="font-size: 110px;display: block;"></span>' +
                '<span style="display: block;margin-top: 15px;">Subir Archivo</span>' +
                '</div>'
        );
        
        $(this).closest('.col-sm-6').find(".div_image").click(function(e) {
            e.preventDefault();
            mostrar_loading(true);
            $(this).closest('form').submit();
        });
});*/

       // Ocultar o mostrar button
       /*
       $('#boton_ocultar_menu_top').click(function() {
        if($('#top_menu_div').is(':visible')) {
            $('#boton_ocultar_menu_top').removeClass('glyphicon-chevron-up');
            $('#boton_ocultar_menu_top').addClass('glyphicon-chevron-down');
            window.localStorage.setItem('menu_top','hide');
        } else {
            $('#boton_ocultar_menu_top').removeClass('glyphicon-chevron-down');
            $('#boton_ocultar_menu_top').addClass('glyphicon-chevron-up');
            window.localStorage.setItem('menu_top', 'show');
        }
        $('#top_menu_div').toggle();
    });

    // Ocultar si tiene que estar ocultado
    if (window.localStorage.getItem('menu_top') == 'hide') {
        $('#boton_ocultar_menu_top').removeClass('glyphicon-chevron-down');
        $('#boton_ocultar_menu_top').addClass('glyphicon-chevron-up');
        $('#top_menu_div').toggle();
    }*/

    $('#authMessage').fadeOut(10000);    

    $(document).on('blur', 'input[required]', function(){
        
        $(this).removeClass('has-error');
        if ($(this).val() == '') {
            $(this).addClass('has-error');
        }
    });
});

var input_hidden = $('<input>', {
    'type': 'hidden'
});

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

function ocultar_loading(selector) {
    if ($('.loading').length) {

        loading = '.loading';
        
        if (selector != undefined) {
            selector += ' .loading';
        }
        $(loading).remove();

        $('.ui-widget-content').css('background', 'white');
    }
}

function mostrar_mensaje(html, type) {

    if (typeof type == 'undefined') {
       type = 'success';
   }

   html = '<div class="' + type + '">' + html + '</div>';

    $(html).dialog({
        modal : true
    });
}
function datepicker() {
    $('.datepicker').removeClass('hasDatepicker');
    $('.datepicker').datepicker({
        dateFormat : "dd/mm/yy",
        showOptions : {
            direction : "down"
        },
        shortYearCutoff : 50,
        changeYear : true,
        yearRange : "1900:2050",
        changeMonth : true,
    });

    $('.datepicker').attr('autocomplete', 'off');
}

function dni(input) {
    $(input).keyup(function(e) {

        switch (e.keyCode) {
            case 40:
            case 39:
            case 38:
            case 37:
            case 36:
            case 35:
            case 20:
            case 18:
            case 17:
            case 16:
            case 8:
            case 9:
            return;
        }
        
        var text = $(input).val();
        text = text.replace(/\./g,'');
        
        var i = 0;
        var alreves = ''; 
        for ( var int = text.length-1; int >= 0; int--) {
            i++;
            alreves += text[int];
            
            if (text[int] != parseInt(text[int], 10) || typeof text[int-1] == 'undefined' || text[int-1] != parseInt(text[int-1], 10)) {
                i=0;
            }
            
            if (i == 3) {
                i = 0;
                alreves += '.';
            }
        }
        
        var ret = '';
        for ( var int = alreves.length-1; int >= 0; int--) {
            ret += alreves[int];
        }
        $(input).val(ret);
    });
}

function message_error(message) {
    var div = $('<div>', 
    {
        'class' : 'alert alert-danger navbar-fixed-top',
        'id' : 'flash_alert'
    }),
    button = $('<button>', {
        'type' : 'button',
        'class' : 'close',
        'data-dismiss' : "alert",
        'html' : '&times;'
    });

    if (message) {
        $('body').append(div.html(button).append(message));
        $('#flash_alert').fadeOut(10000);
    }

}

function leadingZero(value)
{
    if (value < 10)
    {
        return '0' + value;
    }
    return value;
}

var cambio_agregar = {};
function autocomplete(input, field, model, primary_key) {
    if (!$(input)) {
        return;
    }

    var feedback = $(input).closest('.has-feedback');
    var ultimas = [];

    $.ajax({
        url: base_url + 'admin/ubicaciones/autocompletar/' + field + '/' + model + '/' + primary_key,
        dataType: "json",
        data: {
            q: $(input).val(),
            model: model_location
        },
        complete: function( data ) {
            respuesta = jQuery.parseJSON(data.responseText);
            if (respuesta.length) {
                ultimas = respuesta;
                verSiValida(feedback, ultimas, input);
            }
        }
    });

    $(input).autocomplete({
        source : function(request, response) {
            $.ajax({
                url: base_url + 'admin/ubicaciones/autocompletar/' + field + '/' + model + '/' + primary_key,
                dataType: "json",
                data: {
                    q: request.term,
                    model: model_location
                },
                complete: function( data ) {
                    respuesta = jQuery.parseJSON(data.responseText);
                    response( respuesta);
                    if (respuesta.length) {
                        ultimas = respuesta;
                        verSiValida(feedback, ultimas, input);
                    }
                }
            });
        },
        select: function(event, ui) {
            setTimeout(function() {
                verSiValida(feedback, ultimas, input);
            }, 200);

        },
        search: function(event, ui) {
        },
        autoFocus: false
    });

    $(input).keyup(function(e) {
        verSiValida(feedback, ultimas, input);
    });

    $(input).blur(function(e) {
        verSiValida(feedback, ultimas, input);
    });

    feedback.find('input[type="checkbox"]').change(function() {
        if($(this).is(':checked')) {
            $(input).closest('.input-group').addClass('has-success').removeClass('has-error');
        } else {
            $(input).closest('.input-group').addClass('has-error').removeClass('has-success');
        }
    });
}


function verSiValida(feedback, ultimas, input) {

    var filtro = ultimas.filter(function(element) { 
        return element.value == $(input).val();
    });

    if ($(input).val().length == 0 || filtro.length) {
        $(input).closest('.input-group').addClass('block-100').addClass('has-success').removeClass('has-error');
        feedback.find('.input-group-addon').addClass('hide');
        feedback.find('input[type="checkbox"]').removeAttr('checked');
    } else {
        feedback.find('.input-group-addon').removeClass('hide');
        $(input).closest('.input-group').removeClass('block-100').addClass('has-error').removeClass('has-success');
    }
}

function unique(input, field, model, primary_key) {
    if (!$(input)) {
        return;
    }


    $(input).change(function(e) {
        unique_function(input, field, model, primary_key);
    });
    $(input).blur(function(e) {
        unique_function(input, field, model, primary_key);
    });
}

function unique_function(input, field, model, primary_key) {
    var div = $(input).closest('div');
    
    div.removeClass('has-error')
    .removeClass('has-success');

    $.ajax({
        url: base_url + 'admin/ubicaciones/unique/' + field + '/' + model + '/' + primary_key,
        dataType: "json",
        data: {
            q: $(input).val(),
            model: model
        },
        complete: function( data ) {
            respuesta = jQuery.parseJSON(data.responseText);
            if (respuesta.length) {
                div.addClass('has-error');
            } else {
                div.addClass('has-success');
            }
        }
    });
}

function fecha_argentina(fecha) {
    ret = '';
    if (fecha) {

        if (fecha.search('/') > 0) {
            return fecha;
        }
        var fecha = new Date(fecha);
        if (fecha) {
            if (fecha.getUTCDate() < 10) {
                ret += '0' + fecha.getUTCDate();
            } else {
                ret += fecha.getUTCDate();
            }

            if ((fecha.getUTCMonth() + 1) < 10) {
                ret += '/0' + (fecha.getUTCMonth() + 1);
            } else {
                ret += '/' + (fecha.getUTCMonth() + 1);
            }
            
            ret += '/' + fecha.getUTCFullYear();
        }
    }
    return ret;
}

function fv_argentina(boolean) {
    ret = '';
    if (boolean==true) {
        ret='SI'

    }
    else
    {
        ret='NO'
    }
    return ret;
}

/**
 ORDENA UNA TABLA
 n es el numero de columna empezando por 0
 selector_id es el nombre del attr id de la tabla
 */
 function sorting(n, table) {
    var rows, switching, i, x, y, shouldSwitch, switchcount = 0;

    switching = true;
    //Set the sorting direction to ascending:
    var dir = "asc";
    /*Make a loop that will continue until
    no switching has been done:*/
    while (switching) {
        //start by saying: no switching is done:
        switching = false;
        rows = table.getElementsByTagName("TR");
        for (i = 1; i < (rows.length - 1); i++) {
            //start by saying there should be no switching:
            shouldSwitch = false;
            /*Get the two elements you want to compare,
            one from current row and one from the next:*/
            x = rows[i].getElementsByTagName("TD")[n];
            y = rows[i + 1].getElementsByTagName("TD")[n];
            /*check if the two rows should switch place,
            based on the direction, asc or desc:*/
            if (dir == "asc") {
                if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                    //if so, mark as a switch and break the loop:
                    shouldSwitch= true;
                    break;
                }
            } else if (dir == "desc") {
                if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                    //if so, mark as a switch and break the loop:
                    shouldSwitch= true;
                    break;
                }
            }
        }
        if (shouldSwitch) {
            /*If a switch has been marked, make the switch
            and mark that a switch has been done:*/
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
            //Each time a switch is done, increase this count by 1:
            switchcount ++; 
        } else {
            /*If no switching has been done AND the direction is "asc",
            set the direction to "desc" and run the while loop again.*/
            if (switchcount == 0 && dir == "asc") {
                dir = "desc";
                switching = true;
            }
        }
    }
}

function alert(message) {

    $('#modal_error').modal('show');
    $('#modal_error').find('.modal-title').html('Error');
    var div_container = $('<div>');
    var div_text = $('<div>', {
        'text': message
    });

    div_container
    .append(div_text)
    .append(
        '<div class="modal-footer">' +
        '<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>' +
        '</div>'
        );
    $('#modal_error').find('.modal-body').html(div_container);
}

function to_document(text) {
    var text = text.toString();
    text = text.replace(/\./g,'');

    var i = 0;
    var alreves = ''; 
    for ( var int = text.length-1; int >= 0; int--) {
        i++;
        alreves += text[int];

        if (text[int] != parseInt(text[int], 10) || typeof text[int-1] == 'undefined' || text[int-1] != parseInt(text[int-1], 10)) {
            i=0;
        }

        if (i == 3) {
            i = 0;
            alreves += '.';
        }
    }

    var ret = '';
    for ( var int = alreves.length-1; int >= 0; int--) {
        ret += alreves[int];
    }
    return ret;
}
