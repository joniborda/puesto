<?php if (isset($field)):?>
<?php $field_underscore = Inflector::underscore($field); ?>
<div class="form-group col-sm-3">
	<div>
		<input type="checkbox" id="<?php echo $model . $field ?>Check"
			onclick="buscar_<?php echo $field_underscore; ?>(this);"
			<?php echo (
					(isset($this->passedArgs[$field_underscore]) && $this->passedArgs[$field_underscore] != null) ||
					(isset($this->passedArgs[$field_underscore . '_desde']) && $this->passedArgs[$field_underscore . '_desde'] != null)
				)? 'checked="checked"' : '';?> />
		<script type="text/javascript">
			function buscar_<?php echo $field_underscore ?>(input) {
				$(input).closest('.form-group').remove();
			}
		</script>
		<?php echo $this->Form->label($field_underscore .'_check',$label);?>
		<select class="form-control input_corto tipo_<?php echo $field_underscore ?>" onchange="cambiar_tipo_<?php echo $field_underscore ?>(this);">
			<option value="exacta">Exacta</option>
			<option value="entre" 
				<?php echo (isset($this->passedArgs[ $field_underscore .'_desde'])  && $this->passedArgs[$field_underscore . '_desde'] != null)? 'selected="selected"' : ''?>>
				Entre
			</option>
		</select>
		<script type="text/javascript">
		function cambiar_tipo_<?php echo $field_underscore ?>(input) {
			var parent = $(input).closest('.form-group');
			if (parent.find('.tipo_<?php echo $field_underscore ?>').val() == 'exacta') {
				parent.find('.<?php echo $field_underscore ?>_exacta_input').show();
				parent.find('.<?php echo $model . $field ?>').removeAttr('disabled');
				parent.find('.<?php echo $model . $field ?>_').removeAttr('disabled');
				parent.find('.<?php echo $field_underscore ?>_entre_input').hide();
				parent.find('.<?php echo $model . $field ?>Desde').attr('disabled', 'disabled');
				parent.find('.<?php echo $model . $field ?>Hasta').attr('disabled', 'disabled');
			} else {
				parent.find('.<?php echo $field_underscore ?>_entre_input').show();
				parent.find('.<?php echo $model . $field ?>Desde').removeAttr('disabled');
				parent.find('.<?php echo $model . $field ?>Hasta').removeAttr('disabled');
				parent.find('.<?php echo $field_underscore ?>_exacta_input').hide();
				parent.find('.<?php echo $model . $field ?>').val('');
				parent.find('.<?php echo $model . $field ?>').attr('disabled', 'disabled');
				parent.find('.<?php echo $model . $field ?>_').attr('disabled', 'disabled');
			}
		}
		</script>
	</div>
	<div id="<?php echo $field_underscore ?>_exacta_input" class="<?php echo $field_underscore ?>_exacta_input">
		<input name="data[<?php echo $model;?>][<?php echo $field_underscore; ?>][]" class="form-control datepicker hasDatepicker <?php echo $model . $field; ?>" type="text" value="" autocomplete="off">
	</div>
	<div id="<?php echo $field_underscore ?>_entre_input"
		<?php echo (isset($this->passedArgs[$field_underscore . '_desde'])  && $this->passedArgs[$field_underscore . '_desde'] != null)? '' : 'style="display:none;"' ?>
		class="<?php echo $field_underscore ?>_entre_input"
	>
		<div>
			<label for="<?php echo $model . $field; ?>Desde">Desde</label>
			<input autocomplete="off" name="data[<?php echo $model;?>][<?php echo $field_underscore; ?>_desde][]" class="form-control datepicker input_corto <?php echo $model . $field; ?>Desde" type="text">
		</div>
		<div>
			<label for="<?php echo $model . $field; ?>Hasta">Hasta</label>
			<input autocomplete="off" name="data[<?php echo $model;?>][<?php echo $field_underscore; ?>_hasta][]" class="form-control datepicker input_corto <?php echo $model . $field; ?>Hasta" type="text">
		</div>
	</div>
</div>
<?php endif;?>