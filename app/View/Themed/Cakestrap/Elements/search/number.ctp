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
			<option value="<?php echo $model . $field; ?>_mayor">Mayor</option>
			<option value="<?php echo $model . $field; ?>_mayor_igual">Mayor igual</option>
			<option value="<?php echo $model . $field; ?>_menor">Menor</option>
			<option value="<?php echo $model . $field; ?>_menor_igual">Menor igual</option>
		</select>
		<script type="text/javascript">
			function buscar_<?php echo $field_underscore ?>(_this) {
				$(_this).closest('.form-group').remove();
			}
			function condition_<?php echo $field_underscore ?>(_this) {
				$(_this).closest('.form-group').find('[class*="<?php echo $model . $field; ?>"]').hide();
				$(_this).closest('.form-group').find('[class*="<?php echo $model . $field; ?>"]').val('');
				$(_this).closest('.form-group').find('[class*="<?php echo $model . $field; ?>"]').prop('disabled', true);

				switch($(_this).val()) {
					case '<?php echo $model . $field; ?>':
						$(_this).closest('.form-group').find('.<?php echo $model . $field; ?>').show();
						$(_this).closest('.form-group').find('.<?php echo $model . $field; ?>').prop('disabled', false);
						break;
					case '<?php echo $model . $field; ?>_igual':
						$(_this).closest('.form-group').find('.<?php echo $model . $field; ?>_igual').show();
						$(_this).closest('.form-group').find('.<?php echo $model . $field; ?>_igual').prop('disabled', false);
						break;
					case '<?php echo $model . $field; ?>_vacio':
						$(_this).closest('.form-group').find('.<?php echo $model . $field; ?>_vacio').val('1');
						$(_this).closest('.form-group').find('.<?php echo $model . $field; ?>_vacio').prop('disabled', false);
						break;
					case '<?php echo $model . $field; ?>_no_vacio':
						$(_this).closest('.form-group').find('.<?php echo $model . $field; ?>_no_vacio').val('1');
						$(_this).closest('.form-group').find('.<?php echo $model . $field; ?>_no_vacio').prop('disabled', false);
						break;
					case '<?php echo $model . $field; ?>_mayor':
						$(_this).closest('.form-group').find('.<?php echo $model . $field; ?>_mayor').show();
						$(_this).closest('.form-group').find('.<?php echo $model . $field; ?>_mayor').prop('disabled', false);
						break;
					case '<?php echo $model . $field; ?>_mayor_igual':
						$(_this).closest('.form-group').find('.<?php echo $model . $field; ?>_mayor_igual').show();
						$(_this).closest('.form-group').find('.<?php echo $model . $field; ?>_mayor_igual').prop('disabled', false);
						break;
					case '<?php echo $model . $field; ?>_menor':
						$(_this).closest('.form-group').find('.<?php echo $model . $field; ?>_menor').show();
						$(_this).closest('.form-group').find('.<?php echo $model . $field; ?>_menor').prop('disabled', false);
						break;
					case '<?php echo $model . $field; ?>_menor_igual':
						$(_this).closest('.form-group').find('.<?php echo $model . $field; ?>_menor_igual').show();
						$(_this).closest('.form-group').find('.<?php echo $model . $field; ?>_menor_igual').prop('disabled', false);
						break;
				}
			}
		</script>
	</div>
	<input name="data[<?php echo $model; ?>][<?php echo $field_underscore ?>][]" class="form-control <?php echo $model . $field; ?>" type="number" min="0"/>
	<input name="data[<?php echo $model; ?>][<?php echo $field_underscore ?>_igual][]" class="form-control <?php echo $model . $field; ?>_igual" type="number" min="0" style="display:none" disabled="disabled"/>
	<input name="data[<?php echo $model; ?>][<?php echo $field_underscore ?>_vacio][]" class="form-control <?php echo $model . $field; ?>_vacio" type="hidden" disabled="disabled"/>
	<input name="data[<?php echo $model; ?>][<?php echo $field_underscore ?>_no_vacio][]" class="form-control <?php echo $model . $field; ?>_no_vacio" type="hidden" disabled="disabled"/>
	<input name="data[<?php echo $model; ?>][<?php echo $field_underscore ?>_mayor][]" class="form-control <?php echo $model . $field; ?>_mayor" type="number" min="0" style="display:none" disabled="disabled"/>
	<input name="data[<?php echo $model; ?>][<?php echo $field_underscore ?>_mayor_igual][]" class="form-control <?php echo $model . $field; ?>_mayor_igual" type="number" min="0" style="display:none" disabled="disabled"/>
	<input name="data[<?php echo $model; ?>][<?php echo $field_underscore ?>_menor][]" class="form-control <?php echo $model . $field; ?>_menor" type="number" min="0" style="display:none" disabled="disabled"/>
	<input name="data[<?php echo $model; ?>][<?php echo $field_underscore ?>_menor_igual][]" class="form-control <?php echo $model . $field; ?>_menor_igual" type="number" min="0" style="display:none" disabled="disabled"/>


</div><!-- .form-group -->	
<?php endif;?>
