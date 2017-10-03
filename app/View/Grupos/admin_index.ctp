<div id="page-container" class="row">
	<div class="form" id="search-form" style="display:none;">
	<?php echo $this->Form->create('Grupo', array(
			'inputDefaults' => array('label' => false), 
			'role' => 'form',
			'id' => 'form_search_fields'
		));?>		<div class="fields_search">
		<div class="col-sm-3">
			<select id="select_search" class="form-control">
				<option value="">SELECCIONE</option>
				<option value="GrupoDescripcion">Descripcion</option>
			</select>
		</div>
	</div>
	<div style="clear:both;">			
<?php		echo $this->Form->submit('Buscar', array('class' => 'btn btn-large btn-primary'));
			echo $this->Form->end();
?>
	</div>
		<div class="row search_hidden ocultar">
			<?php echo $this->element('search/text', array('model' => 'Grupo', 'field' => 'Descripcion','label' => 'Descripcion'));?>
		</div>
		</div>
		<div class="form form_finder">
			<?php
			echo $this->Form->create('Grupo', array(
				'inputDefaults' => array('label' => false), 
				'role' => 'form',
				'id' => 'form_search_general'
			));?>	

			<div class="contain">
				<?php echo $this->Form->label('busqueda_general','Búsqueda general');?>
				<?php echo $this->Form->input('busqueda_general', array('div' => false, "class" => "form-control input_corto"));?>
				<?php echo $this->Form->submit('Buscar', array('div' => false,'class' => 'finder_submit btn btn-large btn-primary'));?>
			</div>
			<?php echo $this->Form->end();?>
		</div>
	<div class="show_search text-center">
	<a href="#" onclick="showSearch(this);return false;">
		<span class="glyphicon glyphicon-chevron-down"></span>
		<span>Búsqueda</span>
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
		<div class="grupo index">
			<h2 style='display:inline;'>
				<?php echo __('Grupos'); ?>
			</h2>
			<a href="<?php echo Router::url(array('controller' => 'grupos', 'action' => 'add'));?>" class='btn btn-large btn-primary' style='float:right'>Agregar nuevo</a>
			<hr />
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
		url: "<?php echo Router::url(array('controller' => 'grupos', 'action' => 'admin_find')) ?>",
		data: form,

		success: function(data){
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

</script>