<div id="page-container" class="row">
	<div class="col-sm-12">
		<h2 style='display:inline;'>
			Usuarios
			</h2>
		<a href="<?php echo Router::url(array('controller' => 'Usuarios', 'action' => 'add'));?>" class='btn btn-large btn-primary' style='float:right'>Agregar nuevo</a>
	</div>
	<div class="form" id="search-form" style="display:none;">
	<?php echo $this->Form->create('Usuario', array(
			'inputDefaults' => array('label' => false), 
			'role' => 'form',
			'id' => 'form_search_fields'
		));?>		<div class="fields_search">
			<div class="col-sm-3">
				<select id="select_search" class="form-control">
					<option value="">SELECCIONE</option>
					<option value="UsuarioPedidoId">Pedido</option>
					<option value="UsuarioDescripcion">Descripcion</option>
					<option value="UsuarioUsuarioCarga">Usuario Carga</option>
					<option value="UsuarioFechaCarga">Fecha Carga</option>
				</select>
				<button class="finder_submit btn btn-large btn-primary glyphicon glyphicon-search">
				</button>
			</div>
		</div>
		<div style="clear:both;">			
<?php
			echo $this->Form->end();
?>
		</div>
		<div class="row search_hidden ocultar">
			<?php echo $this->element('search/text', array('model' => 'Usuario', 'field' => 'NombreCompleto','label' => 'NombreCompleto'));?>
			<?php echo $this->element('search/text', array('model' => 'Usuario', 'field' => 'UsuarioLogin','label' => 'UsuarioLogin'));?>
			<?php echo $this->element('search/text', array('model' => 'Usuario', 'field' => 'Contrasenia','label' => 'Contrasenia'));?>
			<?php echo $this->element('search/fecha', array('model' => 'Usuario', 'field' => 'Modified','label' => 'Modified'));?>
			<?php echo $this->element('search/fecha', array('model' => 'Usuario', 'field' => 'Created','label' => 'Created'));?>
		</div>
	</div><!-- form -->
	<div class="form form_finder">
		<?php
		echo $this->Form->create('Usuario', array(
			'inputDefaults' => array('label' => false), 
			'role' => 'form',
			'id' => 'form_search_general'
		));?>	

		<button class="finder_submit btn btn-large btn-primary glyphicon glyphicon-search">
		</button>
		<div class="contain">
			<?php echo $this->Form->input('busqueda_general', array('div' => false, 'placeholder' => 'Búsqueda General', 'class' => 'form-control input_mediano'));?>
		</div>
		<?php echo $this->Form->end();?>
	</div>
	<div class="show_search text-center">
	<a href="#" onclick="showSearch(this);return false;">
		<span class="glyphicon glyphicon-chevron-down"></span>
	</a>
	<script type="text/javascript">
		function showSearch(element) {
				if ($('#search-form').is(':visible')) {
					$(element).find('.glyphicon').removeClass('glyphicon-chevron-up');
					$(element).find('.glyphicon').addClass('glyphicon-chevron-down');
					$('#search-form').hide('slow');
					$('.form_finder').show('slow');
				} else {
					$(element).find('.glyphicon').removeClass('glyphicon-chevron-down');
					$(element).find('.glyphicon').addClass('glyphicon-chevron-up');
					$('#search-form').show('slow');
					$('.form_finder').hide('slow');
				}
			}
	</script>
	</div>

	<div id="page-content" class="col-sm-12">

		<div class="Usuarios index">
		
			<div id="rows_ajax">
			
			</div>
		</div><!-- /.index -->
	
	</div><!-- /#page-content .col-sm-9 -->

</div><!-- /#page-container .row-fluid -->

<script type="text/javascript">
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
	event.preventDefault();
   	var form = $(this).serialize();

	$.ajax({
		type: "POST",
		url: "<?php echo Router::url(array('controller' => 'Usuarios', 'action' => 'admin_find')) ?>",
		data: form,

		success: function(data){
		   $('#rows_ajax').html(data);
		   ocultar_loading();
		   //Unterminated String constant fixed
		}
	}).fail(function() {
		ocultar_loading();
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
	}).fail(function() {
		ocultar_loading();
	});
});

mostrar_loading();
$('#form_search_general').submit();

</script>