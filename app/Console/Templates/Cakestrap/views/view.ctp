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

		<div id="page-content" class="col-sm-12">
		
		<div class="<?php echo $pluralVar; ?> view">

			<h2><?php echo "<?php  echo __('{$singularHumanName}'); ?>"; ?></h2>
			<hr />
			<div class="table-responsive">
				<table class="table table-striped table-bordered">
					<tbody>
						<?php
						$tiene_persona = false;
						foreach ($fields as $field) {
							if ($field == 'persona_id') {
								$tiene_persona = true;?>
							<tr>
								<td class="col-sm-2"><strong><?php echo __('Persona'); ?></strong></td>
								<td class="col-sm-4">
								<?php echo "<?php echo \$this->Html->link(
										\${$singularVar}['Persona']['virtual'], 
										array('controller' => 'personas', 'action' => 'view', \${$singularVar}['Persona']['id']), array('class' => '')); ?>
								&nbsp;
								</td>
							</tr>";?>
							<?php }
						}
						
						$count = 0;
						foreach ($fields as $field) {
							if (in_array($field, ['persona_id','usuario_id','fecha_carga', 'tabla', 'tabla_id'])) continue;
							$isKey = false;
														
							if (!empty($associations['belongsTo'])) {
								foreach ($associations['belongsTo'] as $alias => $details) {
									if ($field === $details['foreignKey']) {
										$isKey = true;
										
										if($count == 0) { 
											echo "<tr>\n";
										}
										
										echo "\t\t<td class=\"col-sm-2\"><strong><?php echo __('" . Inflector::humanize(Inflector::underscore($alias)) . "'); ?></strong></td>\n";
										echo "\t\t<td class=\"col-sm-4\">\n";
										
										echo "\t\t<?php if (isset(\${$singularVar}['{$alias}']['{$details['displayField']}'])):?>\n";
										echo "\t\t\t<?php echo \$this->Html->link(\${$singularVar}['{$alias}']['{$details['displayField']}'], array('controller' => '{$details['controller']}', 'action' => 'view', \${$singularVar}['{$alias}']['{$details['primaryKey']}']), array('class' => '')); ?>\n";
										echo "\t\t<?php endif; ?>\n";
										
										echo "\t\t\t&nbsp;\n\t\t</td>\n";
										if($count == 1) {
											 echo "</tr>\n";
											 $count = 0;
										} else {
											$count = 1;
										}
										break;
									}
								}
							}
							if ($isKey !== true) {
								if($count == 0) {
									echo "<tr>\n";
								}
								echo "\t\t<td class=\"col-sm-2\"><strong><?php echo __('" . Inflector::humanize($field) . "'); ?></strong></td>\n";
								echo "\t\t<td class=\"col-sm-4\">\n\t\t\t<?php echo h(\${$singularVar}['{$modelClass}']['{$field}']); ?>\n\t\t\t&nbsp;\n\t\t</td>\n";
								if($count == 1) {
									 echo "</tr>\n";
									 $count = 0;
								} else {
									$count = 1;
								}
							}
						}
						?>
					</tbody>
				</table><!-- /.table table-striped table-bordered -->
			</div><!-- /.table-responsive -->
			
		</div><!-- /.view -->

		<?php
		if (!empty($associations['hasOne'])) :
			foreach ($associations['hasOne'] as $alias => $details): ?>
				<div class="related">
					<h3><?php echo "<?php echo __('Relacionado " . Inflector::humanize($details['controller']) . "'); ?>"; ?></h3>
					<?php echo "<?php if (!empty(\${$singularVar}['{$alias}'])): ?>\n"; ?>
						<table class="table table-striped table-bordered">
							<?php
							foreach ($details['fields'] as $field) {
								echo "<tr>";
								echo "\t\t<td><strong><?php echo __('" . Inflector::humanize($field) . "'); ?></strong></td>\n";
								echo "\t\t<td><strong><?php echo \${$singularVar}['{$alias}']['{$field}']; ?>\n&nbsp;</strong></td>\n";
								echo "</tr>";
							}
							?>
						</table><!-- /.table table-striped table-bordered -->
					<?php echo "<?php endif; ?>\n"; ?>
					<div class="actions">
						<?php echo "<li><?php echo \$this->Html->link(__('<i class=\"icon-pencil icon-white\"></i> Edit " . Inflector::humanize(Inflector::underscore($alias)) . "'), array('controller' => '{$details['controller']}', 'action' => 'edit', \${$singularVar}['{$alias}']['{$details['primaryKey']}']), array('class' => 'btn btn-primary', 'escape' => false)); ?>\n"; ?>
					</div><!-- /.actions -->
				</div><!-- /.related -->
			<?php
			endforeach;
		endif;

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
			<?php
			if (!function_exists('reemplazar')) { 
			function reemplazar($string) {
				$skips = array('L24321');
				
				foreach ($skips as $skip) {
					$string = trim($string, $skip);
				}
				return $string;
			}}
			// SALTA EL CERTIFICADO
			if (reemplazar($otherPluralHumanName) == ' Certificados') continue;
			?>

				<h3><?php echo "<?php echo __('" . reemplazar($otherPluralHumanName) . "'); ?>"; ?></h3>
				
				<?php echo "<?php if (!empty(\${$singularVar}['{$alias}'])): ?>\n"; ?>
					
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
										foreach (\${$singularVar}['{$alias}'] as \${$otherSingularVar}): ?>\n";
										echo "\t\t<tr>\n";
											foreach ($details['fields'] as $field) {
												echo "\t\t\t<td><?php echo \${$otherSingularVar}['{$field}']; ?></td>\n";
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
					"array('controller' => '{$details['controller']}', 'action' => 'add',h(\${$singularVar}['{$modelClass}']['id'])),".
					"array('class' => 'btn btn-primary', 'escape' => false)); ?>"; ?>
				</div><!-- /.actions -->
				
			</div><!-- /.related -->

		<?php endforeach; ?>
	
	</div><!-- /#page-content .span9 -->

</div><!-- /#page-container .row-fluid -->
