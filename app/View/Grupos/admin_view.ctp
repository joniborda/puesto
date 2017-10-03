<div id="page-container" class="row">

    <div id="page-content" class="col-sm-12">

        <div class="grupos view">

            <h2><?php  echo __('Grupo'); ?></h2>

            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <tbody>
                        <tr>
                            <td><strong><?php echo __('Descripcion'); ?></strong></td>
                            <td>
								<?php echo h($grupo['Grupo']['descripcion']); ?>
								&nbsp;
							</td>
                        </tr>
                    </tbody>
                </table>
                <!-- /.table table-striped table-bordered -->
            </div>
            <!-- /.table-responsive -->

        </div>
        <!-- /.view -->


        <div class="related">

            <h3><?php echo __('Related Urls'); ?></h3>
				
				<?php if (!empty($grupo['Url'])): ?>
					
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
					foreach ( $grupo ['Url'] as $url ) :
						?>
		<tr>
                            <td><?php echo $url['id']; ?></td>
                            <td><?php echo $url['descripcion']; ?></td>
                            <td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'urls', 'action' => 'view', $url['id']), array('class' => 'btn btn-default btn-xs')); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'urls', 'action' => 'edit', $url['id']), array('class' => 'btn btn-default btn-xs')); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'urls', 'action' => 'delete', $url['id']), array('class' => 'btn btn-default btn-xs'), __('Are you sure you want to delete # %s?', $url['id'])); ?>
			</td>
                        </tr>
	<?php endforeach; ?>
							</tbody>
                </table>
                <!-- /.table table-striped table-bordered -->
            </div>
            <!-- /.table-responsive -->
					
				<?php endif; ?>

				
				<div class="actions">
					<?php echo $this->Html->link('<i class="icon-plus icon-white"></i> '.__('New Url'), array('controller' => 'urls', 'action' => 'add'), array('class' => 'btn btn-primary', 'escape' => false)); ?>				</div>
            <!-- /.actions -->

        </div>
        <!-- /.related -->


        <div class="related">

            <h3><?php echo __('Related Usuarios'); ?></h3>
				
				<?php if (!empty($grupo['Usuario'])): ?>
					
					<div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th><?php echo __('Usuario Login'); ?></th>
                            <th><?php echo __('Nombre Completo'); ?></th>
                            <th><?php echo __('Password'); ?></th>
                            <th><?php echo __('Borrado'); ?></th>
                            <th><?php echo __('Modified'); ?></th>
                            <th><?php echo __('Created'); ?></th>
                            <th class="actions"><?php echo __('Actions'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
									<?php
					$i = 0;
					foreach ( $grupo ['Usuario'] as $usuario ) :
						?>
		<tr>
                            <td><?php echo $usuario['usuario_login']; ?></td>
                            <td><?php echo $usuario['nombre_completo']; ?></td>
                            <td><?php echo $usuario['password']; ?></td>
                            <td><?php echo $usuario['borrado']; ?></td>
                            <td><?php echo $usuario['modified']; ?></td>
                            <td><?php echo $usuario['created']; ?></td>
                            <td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'usuarios', 'action' => 'view', $usuario['usuario_login']), array('class' => 'btn btn-default btn-xs')); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'usuarios', 'action' => 'edit', $usuario['usuario_login']), array('class' => 'btn btn-default btn-xs')); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'usuarios', 'action' => 'delete', $usuario['usuario_login']), array('class' => 'btn btn-default btn-xs'), __('Are you sure you want to delete # %s?', $usuario['usuario_login'])); ?>
			</td>
                        </tr>
	<?php endforeach; ?>
							</tbody>
                </table>
                <!-- /.table table-striped table-bordered -->
            </div>
            <!-- /.table-responsive -->
					
				<?php endif; ?>

				
				<div class="actions">
					<?php echo $this->Html->link('<i class="icon-plus icon-white"></i> '.__('New Usuario'), array('controller' => 'usuarios', 'action' => 'add'), array('class' => 'btn btn-primary', 'escape' => false)); ?>				</div>
            <!-- /.actions -->

        </div>
        <!-- /.related -->


    </div>
    <!-- /#page-content .span9 -->

</div>
<!-- /#page-container .row-fluid -->
