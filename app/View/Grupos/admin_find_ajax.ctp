<div class="table-responsive">
	<table cellpadding="0" cellspacing="0" class="table table-striped table-bordered">
		<thead>
			<tr>
				<th><?php echo $this->Paginator->sort('descripcion'); ?></th>
				<th class="actions"><?php echo __('Opciones'); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach ($grupos as $grupo): ?>
			<tr>
				<td><?php echo h($grupo['Grupo']['descripcion']); ?></td>
				<td class="actions">
					<?php echo $this->Html->link('<span class="glyphicon glyphicon-list-alt" title="Ver"></span>', array('action' => 'view', $grupo['Grupo']['descripcion']), array('escape'=>false)); ?>
					&nbsp;
					<?php echo $this->Html->link('<span class="glyphicon glyphicon-wrench" title="Editar"></span>', array('action' => 'edit', $grupo['Grupo']['descripcion']), array('escape'=>false)); ?>
					&nbsp;
					<?php echo $this->Form->postLink('<span class="glyphicon glyphicon-trash" title="Borrar"></span>', array('action' => 'delete', $grupo['Grupo']['descripcion']), array('escape'=>false), __('¿Estas seguro que desea borrar # %s?', $grupo['Grupo']['descripcion'])); ?>
				</td>
			</tr>
<?php endforeach; ?>
					</tbody>
				</table>
			</div><!-- /.table-responsive -->
			<center>
				<p><small>
					<?php
					echo $this->Paginator->counter(array(
					'format' => __('Página {:page} de {:pages}, mostrando {:current} registros de {:count} total, comenzando por el {:start}, y terminando en el {:end}')
					));
					?>				</small></p>
	
				<ul class="pagination">
					<?php
		echo $this->Paginator->prev('< ' . __('Anterior'), array('tag' => 'li'), null, array('class' => 'disabled', 'tag' => 'li', 'disabledTag' => 'a'));
		echo $this->Paginator->numbers(array('separator' => '', 'currentTag' => 'a', 'tag' => 'li', 'currentClass' => 'disabled'));
		echo $this->Paginator->next(__('Siguiente') . ' >', array('tag' => 'li'), null, array('class' => 'disabled', 'tag' => 'li', 'disabledTag' => 'a'));
	?>
				</ul><!-- /.pagination -->
			
			</center>