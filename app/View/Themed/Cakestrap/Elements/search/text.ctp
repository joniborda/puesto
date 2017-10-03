<?php if (isset($field)):?>
<?php $field_underscore = Inflector::underscore($field); ?>
<div class="form-group col-sm-3">
	<div>
		<input type="checkbox" id="<?php echo $model . $field; ?>Check" onclick="buscar_<?php echo $field_underscore ?>(this);" checked="checked"/>
		<?php echo $this->Form->label('<?php echo $field_underscore ?>_check',$label);?>
		<select onchange="condition_<?php echo $field_underscore ?>(this);" class="form-control">
			<option value="<?php echo $model . $field; ?>">Contiene</option>
			<option value="<?php echo $model . $field; ?>_igual">Igual</option>
			<option value="<?php echo $model . $field; ?>_vacio">Vacío</option>
			<option value="<?php echo $model . $field; ?>_no_vacio">No está vacío</option>
		</select>
		<script type="text/javascript">
			function buscar_<?php echo $field_underscore ?>(_this) {
				$(_this).closest('.form-group').remove();
			}
			function condition_<?php echo $field_underscore ?>(_this) {
				$(_this).closest('.form-group').find('[class*="<?php echo $model . $field; ?>"]').hide();
				$(_this).closest('.form-group').find('[class*="<?php echo $model . $field; ?>"]').val('');
				switch($(_this).val()) {
					case '<?php echo $model . $field; ?>':
						$(_this).closest('.form-group').find('.<?php echo $model . $field; ?>').show();
						break;
					case '<?php echo $model . $field; ?>_igual':
						$(_this).closest('.form-group').find('.<?php echo $model . $field; ?>_igual').show();
						break;
					case '<?php echo $model . $field; ?>_vacio':
						$(_this).closest('.form-group').find('.<?php echo $model . $field; ?>_vacio').val('1');
						break;
					case '<?php echo $model . $field; ?>_no_vacio':
						$(_this).closest('.form-group').find('.<?php echo $model . $field; ?>_no_vacio').val('1');
						break;
				}
			}
		</script>
	</div>
	<input name="data[<?php echo $model; ?>][<?php echo $field_underscore ?>][]" class="form-control <?php echo $model . $field; ?>" type="text">
	<input name="data[<?php echo $model; ?>][<?php echo $field_underscore ?>_igual][]" class="form-control <?php echo $model . $field; ?>_igual" type="text" style="display:none">
	<input name="data[<?php echo $model; ?>][<?php echo $field_underscore ?>_vacio][]" class="form-control <?php echo $model . $field; ?>_vacio" type="hidden">
	<input name="data[<?php echo $model; ?>][<?php echo $field_underscore ?>_no_vacio][]" class="form-control <?php echo $model . $field; ?>_no_vacio" type="hidden">

</div><!-- .form-group -->	
<?php endif;?>