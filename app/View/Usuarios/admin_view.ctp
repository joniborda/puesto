<div id="page-container" class="row">
		<div id="page-content" class="col-sm-12">

		<div class="usuariosTables view">

			<h2><?php  echo __('Usuarios Table'); ?></h2>
			<hr />
			<div class="table-responsive">
				<table class="table table-striped table-bordered">
					<tbody>
<tr>
		<td class="col-sm-2"><strong><?php echo __('Id'); ?></strong></td>
		<td class="col-sm-4">
			<?php echo h($usuario['Usuario']['id_usuario']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<td class="col-sm-2"><strong><?php echo __('Nombre Completo'); ?></strong></td>
		<td class="col-sm-4">
			<?php echo h($usuario['Usuario']['nombre_completo']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<td class="col-sm-2"><strong><?php echo __('Usuario Login'); ?></strong></td>
		<td class="col-sm-4">
			<?php echo h($usuario['Usuario']['usuario_login']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<td class="col-sm-2"><strong><?php echo __('Modified'); ?></strong></td>
		<td class="col-sm-4">
			<?php echo h($usuario['Usuario']['modified']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<td class="col-sm-2"><strong><?php echo __('Created'); ?></strong></td>
		<td class="col-sm-4">
			<?php echo h($usuario['Usuario']['created']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<td class="col-sm-2"><strong><?php echo __('Contrasenia'); ?></strong></td>
		<td class="col-sm-4">
			<?php echo h($usuario['Usuario']['contrasenia']); ?>
			&nbsp;
		</td>
					</tbody>
				</table><!-- /.table table-striped table-bordered -->
			</div><!-- /.table-responsive -->
			
		</div><!-- /.view -->

					
			<div class="related">
			
				<h3><?php echo __('Grupos'); ?></h3>
				
				<?php if (!empty($usuario['Grupo'])): ?>
					
					<div class="table-responsive">
						<table class="table table-striped table-bordered">
							<thead>
								<tr>
											<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Descripcion'); ?></th>
									<th class="actions"><?php echo __('Actions'); ?></th>
								</tr>
							</thead>
							<tbody>
									<?php
										$i = 0;
										foreach ($usuario['Grupo'] as $grupo): ?>
		<tr>
			<td><?php echo $grupo['id']; ?></td>
			<td><?php echo $grupo['descripcion']; ?></td>
		<td class="actions">
			<?php echo $this->Html->link('<span class="glyphicon glyphicon-list-alt" title="Ver"></span>', array('controller' => 'grupos', 'action' => 'view', $grupo['id']), array('escape'=>false)); ?>
			<?php echo $this->Html->link('<span class="glyphicon glyphicon-wrench" title="Editar"></span>', array('controller' => 'grupos', 'action' => 'edit', $grupo['id']), array('escape'=>false)); ?>
			<?php echo $this->Form->postLink('<span class="glyphicon glyphicon-trash" title="Borrar"></span>', array('controller' => 'grupos', 'action' => 'delete', $grupo['id']), array('escape'=>false), __('¿Estas seguro que desea borrar # %s?', $grupo['id'])); ?>
		</td>
		</tr>
	<?php endforeach; ?>
							</tbody>
						</table><!-- /.table table-striped table-bordered -->
					</div><!-- /.table-responsive -->
					
				<?php endif; ?>

				
				<div class="actions">
					<?php echo $this->Html->link('<i class="icon-plus icon-white"></i> '.__('Nuevo Grupo'), array('controller' => 'grupos', 'action' => 'add',h($usuario['Usuario']['id'])),array('class' => 'btn btn-primary', 'escape' => false)); ?>				</div><!-- /.actions -->
				
			</div><!-- /.related -->

			
	</div><!-- /#page-content .span9 -->

</div><!-- /#page-container .row-fluid -->
