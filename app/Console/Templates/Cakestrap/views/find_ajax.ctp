<div class="table-responsive">
				<table cellpadding="0" cellspacing="0" class="table table-striped table-bordered">
					<thead>
						<tr>
<?php  						foreach ($fields as $field): ?>
<?php 							if (in_array($field, ['usuario_id', 'tabla', 'tabla_id'])) continue;?>
							<th><?php echo "<?php echo \$this->Paginator->sort('{$field}'); ?>"; ?></th>
<?php 						endforeach; ?>
							<th class="actions"><?php echo "<?php echo __('Opciones'); ?>"; ?></th>
						</tr>
					</thead>
					<tbody>
						<?php
						echo "<?php
						foreach (\${$pluralVar} as \${$singularVar}): ?>\n";
						echo "\t<tr>\n";
							foreach ($fields as $field) {
								if (in_array($field, ['usuario_id', 'tabla', 'tabla_id'])) continue;
								$isKey = false;
								if (!empty($associations['belongsTo'])) {
									foreach ($associations['belongsTo'] as $alias => $details) {
										if ($field === $details['foreignKey']) {
											$isKey = true;
											echo "\t\t<td>";
											echo "<?php if (\${$singularVar}['{$alias}']):?>";
											echo "\n\t\t\t<?php echo \$this->Html->link(\${$singularVar}['{$alias}']['{$details['displayField']}'], array('controller' => '{$details['controller']}', 'action' => 'view', \${$singularVar}['{$alias}']['{$details['primaryKey']}'])); ?>\n\t\t";
											echo "<?php endif;?>";
											echo "</td>\n";
											break;
										}
									}
								}
								if ($isKey !== true) {
									echo "\t\t<td><?php echo h(\${$singularVar}['{$modelClass}']['{$field}']); ?>";
									if ($singularVar == 'persona' && $modelClass == 'Persona' && $field == 'id') {
									echo "<?php if (\$persona['Persona']['sdh'])
										echo \$this->Html->link('',
												array('controller' => 'l24321Certificados', 'action' => 'menu', \$persona['Persona']['id']),
												array('class' => 'glyphicon glyphicon-book')
										); ?>";
									}
									echo "</td>\n";
								}
							}

							echo "\t\t<td class=\"actions\">\n";
							echo "\t\t\t<?php echo \$this->Html->link('<span class=\"glyphicon glyphicon-list-alt\" title=\"Ver\"></span>', array('action' => 'view', \${$singularVar}['{$modelClass}']['{$primaryKey}']), array('escape'=>false)); ?>\n";
							echo "\t\t\t<?php echo \$this->Html->link('<span class=\"glyphicon glyphicon-wrench\" title=\"Editar\"></span>', array('action' => 'edit', \${$singularVar}['{$modelClass}']['{$primaryKey}']), array('escape'=>false)); ?>\n";
							echo "\t\t\t<?php echo \$this->Form->postLink('<span class=\"glyphicon glyphicon-trash\" title=\"Borrar\"></span>', array('action' => 'delete', \${$singularVar}['{$modelClass}']['{$primaryKey}']), array('escape'=>false), __('¿Estas seguro que desea borrar # %s?', \${$singularVar}['{$modelClass}']['{$primaryKey}'])); ?>\n";
							echo "\t\t</td>\n";
						echo "\t</tr>\n";

						echo "<?php endforeach; ?>\n";
						?>
					</tbody>
				</table>
			</div><!-- /.table-responsive -->
			<center>
				<p><small>
					<?php echo "<?php
					echo \$this->Paginator->counter(array(
					'format' => __('Página {:page} de {:pages}, mostrando {:current} registros de {:count} total, comenzando por el {:start}, y terminando en el {:end}')
					));
					?>"; ?>
				</small></p>
	
				<ul class="pagination">
					<?php
						echo "<?php\n";
						echo "\t\techo \$this->Paginator->prev('< ' . __('Anterior'), array('tag' => 'li'), null, array('class' => 'disabled', 'tag' => 'li', 'disabledTag' => 'a'));\n";
						echo "\t\techo \$this->Paginator->numbers(array('separator' => '', 'currentTag' => 'a', 'tag' => 'li', 'currentClass' => 'disabled'));\n";
						echo "\t\techo \$this->Paginator->next(__('Siguiente') . ' >', array('tag' => 'li'), null, array('class' => 'disabled', 'tag' => 'li', 'disabledTag' => 'a'));\n";
						echo "\t?>\n";
					?>
				</ul><!-- /.pagination -->
			
			</center>