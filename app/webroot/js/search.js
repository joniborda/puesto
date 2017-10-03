var exportar = false;
if (typeof tipo == "undefined") {
	var tipo = '';
}

$(document).on('click', '#exportar', function(event) {
	event.preventDefault();

	exportar = true;
	if ($('#form_search_general').is(':visible')) {
		$('#form_search_general').submit();
	} else {
		$('#form_search_fields').submit();
	}

	 setTimeout(
	 	function() {
	 		ocultar_loading();
	 	},
	  	3000
  	);
});

$(document).on('change', '#select_search', function(event) {

	event.preventDefault();
	var value = $(this).val();

	var clone = $('.search_hidden').find('.' + value + ':first').closest('.form-group').clone();
	$(clone).show();
	$('.fields_search').append(clone);
	$('.' + value).show();
	$(this).val($(this).find('option:first').val());
	datepicker();
});

$('#form_search_general, #form_search_fields').submit(function(event) {

   	if (exportar) {
   		$('#' + Controller + 'ExportarField').val(1);
   		$('#' + Controller + 'Exportar').val(1);
   		
   		exportar = false;
   		return true;
   	} else {
   		$('#' + Controller + 'ExportarField').val(0);
   		$('#' + Controller + 'Exportar').val(0);
   	}

   	var form = $(this).serialize();

	event.preventDefault();

	$.ajax({
		type: "POST",
		url: base_url + 'admin/' + controller + '/find/' + tipo,
		data: form,

		success: function(data) {
		   $('#rows_ajax').html(data);
		   ocultar_loading();
		   //Unterminated String constant fixed
		}
	});
	return false;  //stop the actual form post !important!
});
$(document).on('click', '.pagination a, .table-responsive thead a', function(event) {
	event.preventDefault();
	mostrar_loading();
	$.ajax({
		type: "GET",
		url: $(this).attr('href'),
		success: function(data) {
		   $('#rows_ajax').html(data);
		   ocultar_loading();
		}
	});
});

mostrar_loading(true, '#rows_ajax');
$('#form_search_general').submit();
