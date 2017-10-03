<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.Console.Templates.default.views
 * @since         CakePHP(tm) v 1.2.0.5234
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<div id="page-container" class="row">
	<div class="col-sm-12">
		<h2 style='display:inline;'>
			<?php echo "{$pluralHumanName}
	"; ?>
		</h2>
		<a href="<?php echo "<?php echo Router::url(array('controller' => '".$pluralVar."', 'action' => 'add'));?>"; ?>" class='btn btn-large btn-primary' style='float:right'>Agregar nuevo</a>
	</div>
<?php if ($search):?>
	<div class="form" id="search-form" style="display:none;">
	<?php echo '<?php echo $this->Form->create(\'' . $modelClass . '\', array(
			\'inputDefaults\' => array(\'label\' => false), 
			\'role\' => \'form\',
			\'id\' => \'form_search_fields\'
		));?>';?>
		<div class="fields_search">
			<div class="col-sm-3">
				<select id="select_search" class="form-control">
					<option value="">SELECCIONE</option>
<?php 
foreach($fields as $field): ?>
<?php if ($field != 'id'): ?>
					<option value="<?php echo $modelClass . Inflector::camelize($field);?>"><?php echo Inflector::humanize(str_replace('_id', '', $field)); ?></option>
<?php endif; ?>
<?php endforeach; ?>
				</select>
				<button class="finder_submit btn btn-large btn-primary glyphicon glyphicon-search">
				</button>
			</div>
		</div>
		<div style="clear:both;">			
<?php echo '<?php
			echo $this->Form->end();
?>
';?>
		</div>
		<?php $count = (int)count($fields);?>
<div class="row search_hidden ocultar">
		<?php for ($i = 0; $i < $count; $i++):		
				$field = $fields[$i];
				if (in_array($field, ['usuario_id','tabla', 'tabla_id'])) continue;

				if ($schema[$field]['type'] == 'datetime' || $schema[$field]['type'] == 'date'):

					echo '	<?php echo $this->element(\'search/fecha\', array(\'model\' => \''.  $modelClass .'\', \'field\' => \'' . Inflector::camelize($field) . '\',\'label\' => \'' . Inflector::humanize(str_replace('_id', '', $field)) . '\'));?>
';
				elseif ($schema[$field]['type'] == 'text'):
					echo '	<?php echo $this->element(\'search/text\', array(\'model\' => \''.  $modelClass .'\', \'field\' => \'' . Inflector::camelize($field) . '\',\'label\' => \'' . Inflector::humanize(str_replace('_id', '', $field)) . '\'));?>
';
				elseif ($schema[$field]['type'] == 'integer'):
					echo '	<?php echo $this->element(\'search/number\', array(\'model\' => \''.  $modelClass .'\', \'field\' => \'' . Inflector::camelize($field) . '\',\'label\' => \'' . Inflector::humanize(str_replace('_id', '', $field)) . '\'));?>
';
				else:
?>
			<div class="form-group col-sm-3">
				<div>
					<input type="checkbox" id="<?php echo $modelClass . Inflector::camelize($field)?>Check" onclick="buscar_<?php echo $field?>(this);" checked="checked"/>
					<script type="text/javascript">
						function buscar_<?php echo $field;?>() {
							$('#<?php echo $modelClass . Inflector::camelize($field);?>Check').closest('.form-group').remove();
						}
					</script>
					<?php echo '<?php echo $this->Form->label(\''.$field .'_check\',\''. Inflector::humanize(str_replace('_id', '', $field)) .'\');?>';?>

				</div>
				<?php if ($schema[$field]['type'] == 'boolean'): ?>
				<input name="data[<?php echo $modelClass; ?>][<?php echo $field;?>][]" class="form-control <?php echo $modelClass . Inflector::camelize($field);?>" type="checkbox">
				<?php else:
					$tiene_relacion = false;
					if (!empty($associations['belongsTo'])) :
						foreach ($associations['belongsTo'] as $assocName => $assocData) : 
							if ($assocData['foreignKey'] == $field) : 
								$tiene_relacion = true; ?>
							<select name="data[<?php echo $modelClass; ?>][<?php echo $field;?>][]" class="form-control <?php echo $modelClass . Inflector::camelize($field);?>">
								<?php echo '<?php foreach($' . lcfirst(Inflector::camelize($assocName)) . 's as $key => $value): ?>'?>
									<?php echo '<option value="<?php echo $key;?>"><?php echo $value?></option>' ?>
								<?php echo '<?php endforeach; ?>'?>
							</select>
					<?php	endif;
						endforeach;
					endif;
					if ($tiene_relacion == false): ?>
				<input name="data[<?php echo $modelClass; ?>][<?php echo $field;?>][]" class="form-control <?php echo $modelClass . Inflector::camelize($field);?>" type="text">
				<?php endif; 
				endif;?>
			</div><!-- .form-group -->
		<?php endif;?>
		<?php endfor;?>
</div>
	</div><!-- form -->
	<div class="form form_finder">
		<?php echo '<?php
		echo $this->Form->create(\'' . $modelClass . '\', array(
			\'inputDefaults\' => array(\'label\' => false), 
			\'role\' => \'form\',
			\'id\' => \'form_search_general\'
		));?>';?>	

		<button class="finder_submit btn btn-large btn-primary glyphicon glyphicon-search">
		</button>
		<div class="contain">
			<?php echo "<?php echo \$this->Form->input('busqueda_general', array('div' => false, 'placeholder' => 'Búsqueda General', 'class' => 'form-control input_mediano'));?>"; ?>

		</div>
		<?php echo '<?php echo $this->Form->end();?>
';?>
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
<?php endif; // search ?>

	<div id="page-content" class="col-sm-12">

		<div class="<?php echo $pluralVar; ?> index">
		
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
		url: "<?php echo '<?php echo Router::url(array(\'controller\' => \'' . $pluralVar . '\', \'action\' => \'admin_find\')) ?>'; ?>",
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