<div class="table-responsive">
	<table cellpadding="0" cellspacing="0" class="table table-striped table-bordered">
		<thead>
			<tr>
				<th><?php echo $this->Paginator->sort('nombre_completo'); ?></th>
				<th><?php echo $this->Paginator->sort('usuario_login'); ?></th>
				<th><?php echo $this->Paginator->sort('borrado'); ?></th>
				<th><?php echo $this->Paginator->sort('modified'); ?></th>
				<th><?php echo $this->Paginator->sort('created'); ?></th>
				<th class="actions"><?php echo __('Opciones'); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach ($usuarios as $usuario): ?>
			<tr>
				<td><?php echo h($usuario['Usuario']['nombre_completo']); ?></td>
				<td><?php echo h($usuario['Usuario']['usuario_login']); ?></td>
				<td><?php echo h($usuario['Usuario']['borrado']); ?></td>
				<td><?php echo h($usuario['Usuario']['modified']); ?></td>
				<td><?php echo h($usuario['Usuario']['created']); ?></td>
				<td class="actions">
					<?php echo $this->Html->link('<span class="glyphicon glyphicon-list-alt" title="Ver"></span>', array('action' => 'view', $usuario['Usuario']['usuario_login']), array('escape'=>false)); ?>
					&nbsp;
					<?php echo $this->Html->link('<span class="glyphicon glyphicon-wrench" title="Editar"></span>', array('action' => 'edit', $usuario['Usuario']['usuario_login']), array('escape'=>false)); ?>
					&nbsp;
					<?php echo $this->Form->postLink('<span class="glyphicon glyphicon-trash" title="Borrar"></span>', array('action' => 'delete', $usuario['Usuario']['usuario_login']), array('escape'=>false), __('¿Estas seguro que desea borrar # %s?', $usuario['Usuario']['usuario_login'])); ?>
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