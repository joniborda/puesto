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

if (!function_exists('traductor')) {
	function traductor($string) {
		
		if($string == 'admin_add')
			$string = 'Agregar';
		if($string == 'admin_edit')
			$string = 'Editar';
		
		return $string;
	}
}

if (!function_exists('getButtonName')) {
function getButtonName($string) {

	if($string == 'admin_add')
		$string = 'Agregar';
	if($string == 'admin_edit')
		$string = 'Editar';
	
	if(!isset($string))
		$string = 'Enviar';
	
	return $string;
}
}

$imprimir[0] = false;
$imprimir[1] = false;
$imprimir[2] = false;
?>
<div id="page-container" class="row">
	<div id="page-content" class="col-sm-12">
		<div class="<?php echo $pluralVar; ?> form p_form">		
			<?php echo "<?php echo \$this->Form->create('{$modelClass}', array('inputDefaults' => array('label' => false), 'role' => 'form')); ?>\n"; ?>
			<fieldset>
				<h2>
				<?php printf("%s %s", traductor($action), $singularHumanName); ?>
				<?php if (isset($select) && strpos($action, 'add')):?>
					para <?php echo $select['model_name']?> <?php echo '<?php echo $this->data[\'' . $modelClass . '\'][\''. $select['association_foreign_key'] . '\']?>';?>
				<?php endif;?>

				</h2>
				<hr />
<?php
			$tiene_persona = false;
			foreach ($fields as $field):
				if ($field == 'persona_id') {
					$tiene_persona = true;?>
					<div class="row">
						<div class="form-group col-sm-2" style="font-weight: bold;">
							Persona
						</div>
						<div class="form-group col-sm-4" style="font-weight: bold;">
						<?php if (strpos($action, 'add')):?>
							<?php echo "\t\t<?php echo \$persona['Persona']['virtual']?>"?>
							<?php echo "\t\t<?php echo \$this->Form->input('persona_id', array('div' => false,'type' => 'hidden', 'value'=> \$persona['Persona']['id'])); ?>"?>	
						<?php else:?>
							<?php echo "<?php echo \$this->data['Persona']['virtual']?>"?>
						<?php endif;?>
						</div>
					</div>
				<?php }
			if (in_array($field, ['usuario','fecha_carga', 'tabla', 'tabla_id', 'persona_id'])) continue;
			
			if ($field == 'provincia_id') {
				$imprimir[0] = true;
			}
			
			if ($field == 'departamento_id') {
				$imprimir[1] = true;
			}
			
			if ($field == 'localidad_id') {
				$imprimir[2] = true;
			}
			if (strpos($action, 'add') == true && $primaryKey == 'id' && $field == $primaryKey) {
				continue;
			} elseif (!in_array($field, array('created', 'modified', 'updated'))) {
				echo "\t\t\t\t<?php echo \$this->Form->label('{$field}', '".Inflector::humanize(str_replace('_id', '', $field))."'); ?>\n";
				echo "\t\t\t\t<?php echo \$this->Form->input('{$field}', array(";
				if ($field == 'provincia_id') {
					echo '\'empty\' => \'Seleccione\',';
				}
				echo ($schema[$field]['type'] == 'datetime' || $schema[$field]['type'] == 'date' || $schema[$field]['type'] == 'text')? '\'type\'=>\'text\',' : ''; 
				echo '\'div\' => false, "class" => \'form-control';
				echo $schema[$field]['type'] == 'boolean' ? ' f_checkbox' : '';
				echo ($schema[$field]['type'] == 'datetime' || $schema[$field]['type'] == 'date')? ' datepicker' : '';
				echo "'));?>\n";
			}
			endforeach;
				if (!empty($associations['hasAndBelongsToMany'])) {
					foreach ($associations['hasAndBelongsToMany'] as $assocName => $assocData) {
						echo "\t\t<?php echo \$this->Form->label('{$assocName}'); ?>\n";
						echo "\t\t<?php echo \$this->Form->input('{$assocName}');?>\n";
					}
				}
				if (strpos($action, 'add') == true):
					if (isset($select)):
						echo '<?php echo $this->Form->input(\'' . $select['association_foreign_key'] . '\', array(\'type\' => \'hidden\', \'div\' => false, "class" => \'form-control\'));?>';
					endif;
				endif;
			// AGREGO TABLAS DE LOS ASOCIADOS
if (strpos($action, 'add') === false): 
			if (empty($associations['hasMany'])) {
			$associations['hasMany'] = array();
		}
		if (empty($associations['hasAndBelongsToMany'])) {
			$associations['hasAndBelongsToMany'] = array();
		}
		$relations = array_merge($associations['hasMany'], $associations['hasAndBelongsToMany']);
		$i = 0;
		foreach ($relations as $alias => $details):
			$otherSingularVar = Inflector::variable($alias);
			$otherPluralHumanName = Inflector::humanize($details['controller']);
			?>
			
			<div class="related">
				<h3><?php echo "<?php echo __('" . $otherPluralHumanName . "'); ?>"; ?></h3>
				
				<?php echo "<?php if (!empty(\$this->data['{$alias}'])): ?>\n"; ?>
					
					<div class="table-responsive">
						<table class="table table-striped table-bordered">
							<thead>
								<tr>
									<?php
										foreach ($details['fields'] as $field) {
											echo "\t\t<th><?php echo __('" . Inflector::humanize($field) . "'); ?></th>\n";
										}
									?>
									<th class="actions"><?php echo "<?php echo __('Actions'); ?>"; ?></th>
								</tr>
							</thead>
							<tbody>
								<?php
								echo "\t<?php
										\$i = 0;
										foreach (\$this->data['{$alias}'] as \${$otherSingularVar}): ?>\n";
										echo "\t\t<tr>\n";
											foreach ($details['fields'] as $field) {
												echo "\t\t\t<td><?php echo h(\${$otherSingularVar}['{$field}']); ?></td>\n";
											}

											echo "\t\t<td class=\"actions\">\n";
											echo "\t\t\t<?php echo \$this->Html->link('<span class=\"glyphicon glyphicon-list-alt\" title=\"Ver\"></span>', array('controller' => '{$details['controller']}', 'action' => 'view', \${$otherSingularVar}['{$details['primaryKey']}']), array('escape'=>false)); ?>\n";
											echo "\t\t\t<?php echo \$this->Html->link('<span class=\"glyphicon glyphicon-wrench\" title=\"Editar\"></span>', array('controller' => '{$details['controller']}', 'action' => 'edit', \${$otherSingularVar}['{$details['primaryKey']}']), array('escape'=>false)); ?>\n";
											echo "\t\t\t<?php echo \$this->Form->postLink('<span class=\"glyphicon glyphicon-trash\" title=\"Borrar\"></span>', array('controller' => '{$details['controller']}', 'action' => 'delete', \${$otherSingularVar}['{$details['primaryKey']}']), array('escape'=>false), __('¿Estas seguro que desea borrar # %s?', \${$otherSingularVar}['{$details['primaryKey']}'])); ?>\n";
											echo "\t\t</td>\n";
										echo "\t\t</tr>\n";

								echo "\t<?php endforeach; ?>\n";
								?>
							</tbody>
						</table><!-- /.table table-striped table-bordered -->
					</div><!-- /.table-responsive -->
					
				<?php echo "<?php endif; ?>\n\n"; ?>
				<div class="actions">
					<?php echo "<?php echo \$this->Html->link('<i class=\"icon-plus icon-white\">".
					"</i> '.__('Nuevo " . Inflector::humanize(Inflector::underscore($alias)) . "'), ".
					"array('controller' => '{$details['controller']}', 'action' => 'add',h(\$this->data['{$modelClass}']['{$primaryKey}'])),".
					"array('class' => 'btn btn-primary', 'escape' => false)); ?>"; ?>
				</div><!-- /.actions -->
			</div><!-- /.related -->
		<?php endforeach; ?>
<?php endif;?>	
			</fieldset>
			<?php
				echo "<?php echo \$this->Form->submit('".getButtonName($action)."', array('class' => 'btn btn-large btn-primary')); ?>\n";
				echo "\t\t\t<?php echo \$this->Form->end(); ?>\n";
			?>
		</div><!-- /.form -->
	</div><!-- /#page-content .col-sm-9 -->
</div><!-- /#page-container .row-fluid -->

<?php if($imprimir[0] == true && $imprimir[1] == true && $imprimir[2] == true) {
	echo '<script>
	
	$(document).ready(function() {
		$(function() {
		
		
			var prov_id = null;
		    var reg_id = null;
		    
			  $("#PersonaProvinciaId").change(function(event){
			        prov_id = $("#PersonaProvinciaId").find(":selected").val();
			        $("#PersonaDepartamentoId").load(<?php echo ROUTER::url("/"); ?> + "admin/personas/update_select/"+prov_id);
					//borra localidad
			        $("#PersonaLocalidadId").html("<option value=\'\'>Seleccione</option>");
			    });
	
			    $("#PersonaDepartamentoId").change(function(event){
			    	prov_id = $("#PersonaProvinciaId").find(":selected").val();
			    	reg_id = $("#PersonaDepartamentoId").find(":selected").val();
			    	$("#PersonaLocalidadId").load(<?php echo ROUTER::url("/"); ?> + "admin/personas/update_select/" + prov_id + "/" +reg_id);
			            
			        });
		});
		
		
	});	
	</script>';


	echo "<?php echo \$this->Js->writeBuffer(); ?>\n";
}
?>
