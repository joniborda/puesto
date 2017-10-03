
<div id="page-container" class="row">
	<div class="form" id="search-form" <?php echo ($this->view === 'admin_index')? 'style="display:none;"' : ''?>>	<?php echo $this->Form->create('UsuariosGrupo', array(
		    'url' => array('controller' => 'UsuariosGrupos', 'action' => 'find'),
			'inputDefaults' => array('label' => false), 'role' => 'form'
		));?>						<div class="row">
												<div class="form-group col-sm-3">
				<div>
					<input type="checkbox" onclick="buscar_usuario_id(this);" <?php echo (isset($this->passedArgs['usuario_id']) && $this->passedArgs['usuario_id'] != null)? 'checked="checked"' : '';?>/>
					<script type="text/javascript">
						function buscar_usuario_id() {
							if ($('#UsuariosGrupoUsuarioId').attr('disabled')) {
								$('#usuario_id_input').show('slow');
								$('#UsuariosGrupoUsuarioId').removeAttr('disabled');
								$('#UsuariosGrupoUsuarioId_').removeAttr('disabled');
								
							} else {
								$('#usuario_id_input').hide('slow');
								$('#UsuariosGrupoUsuarioId').val('');
								$('#UsuariosGrupoUsuarioId').attr('disabled', 'disabled');
								$('#UsuariosGrupoUsuarioId_').attr('disabled', 'disabled');
							}
						}
					</script>
				<?php echo $this->Form->label('usuario_id','usuario_id');?></div>
				<div id="usuario_id_input"  <?php echo (isset($this->passedArgs['usuario_id'])  && $this->passedArgs['usuario_id'] != null)? '' : 'style="display:none;"' ?> >
				<?php echo $this->Form->input('usuario_id', array('div' => false, "class" => "form-control", "disabled" => (isset($this->passedArgs["usuario_id"])  && $this->passedArgs["usuario_id"] != null )? false : "disabled"));?>				</div>
			</div><!-- .form-group -->
												<div class="form-group col-sm-3">
				<div>
					<input type="checkbox" onclick="buscar_grupo_id(this);" <?php echo (isset($this->passedArgs['grupo_id']) && $this->passedArgs['grupo_id'] != null)? 'checked="checked"' : '';?>/>
					<script type="text/javascript">
						function buscar_grupo_id() {
							if ($('#UsuariosGrupoGrupoId').attr('disabled')) {
								$('#grupo_id_input').show('slow');
								$('#UsuariosGrupoGrupoId').removeAttr('disabled');
								$('#UsuariosGrupoGrupoId_').removeAttr('disabled');
								
							} else {
								$('#grupo_id_input').hide('slow');
								$('#UsuariosGrupoGrupoId').val('');
								$('#UsuariosGrupoGrupoId').attr('disabled', 'disabled');
								$('#UsuariosGrupoGrupoId_').attr('disabled', 'disabled');
							}
						}
					</script>
				<?php echo $this->Form->label('grupo_id','grupo_id');?></div>
				<div id="grupo_id_input"  <?php echo (isset($this->passedArgs['grupo_id'])  && $this->passedArgs['grupo_id'] != null)? '' : 'style="display:none;"' ?> >
				<?php echo $this->Form->input('grupo_id', array('div' => false, "class" => "form-control", "disabled" => (isset($this->passedArgs["grupo_id"])  && $this->passedArgs["grupo_id"] != null )? false : "disabled"));?>				</div>
			</div><!-- .form-group -->
								</div>
				<div style="clear:both;">			<?php echo $this->Form->submit(__('Search'), array('class' => 'btn btn-large btn-primary'));
 echo $this->Form->end();?>		</div>			
	</div><!-- form -->
	<div class="show_search text-center">
	<a href="#" onclick="showSearch(this);return false;">
		<?php echo ($this->view === 'admin_index')? '<span class="glyphicon glyphicon-chevron-down"></span>' : '<span class="glyphicon glyphicon-chevron-up"></span>';?>  
		<span>Búsqueda</span>
	</a>
	<script type="text/javascript">
		function showSearch(element) {
				if ($('#search-form').is(':visible')) {
					$(element).find('.glyphicon').removeClass('glyphicon-chevron-up');
					$(element).find('.glyphicon').addClass('glyphicon-chevron-down');
					$('#search-form').hide('slow');
				} else {
					$(element).find('.glyphicon').removeClass('glyphicon-chevron-down');
					$(element).find('.glyphicon').addClass('glyphicon-chevron-up');
					$('#search-form').show('slow');
				}
			}
	</script>
	</div>
<!-- 	<div id="sidebar" class="col-sm-3">
		
		<div class="actions">
		
			<ul class="list-group">
				<li class="list-group-item"><?php echo $this->Html->link(__('New Usuarios Grupo'), array('action' => 'add'), array('class' => '')); ?></li>						<li class="list-group-item"><?php echo $this->Html->link(__('List Usuarios'), array('controller' => 'usuarios', 'action' => 'index'), array('class' => '')); ?></li> 
		<li class="list-group-item"><?php echo $this->Html->link(__('New Usuario'), array('controller' => 'usuarios', 'action' => 'add'), array('class' => '')); ?></li> 
		<li class="list-group-item"><?php echo $this->Html->link(__('List Grupos'), array('controller' => 'grupos', 'action' => 'index'), array('class' => '')); ?></li> 
		<li class="list-group-item"><?php echo $this->Html->link(__('New Grupo'), array('controller' => 'grupos', 'action' => 'add'), array('class' => '')); ?></li> 
			</ul><!-- /.list-group -->
			
<!--  		</div><!-- /.actions -->
		
<!-- 	</div><!-- /#sidebar .col-sm-3 -->
				
	<div id="page-content" class="col-sm-12">
<!-- 	<div id="page-content" class="col-sm-9"> -->

		<div class="usuariosGrupos index">
		
			<h2><?php echo __('Usuarios Grupos'); ?></h2>
			
			<div class="table-responsive">
				<table cellpadding="0" cellspacing="0" class="table table-striped table-bordered">
					<thead>
						<tr>
															<th class="actions"><?php echo __('Opciones'); ?></th>
															<th><?php echo $this->Paginator->sort('id'); ?></th>
															<th><?php echo $this->Paginator->sort('usuario_id'); ?></th>
															<th><?php echo $this->Paginator->sort('grupo_id'); ?></th>
						</tr>
					</thead>
					<tbody>
						<?php
						foreach ($usuariosGrupos as $usuariosGrupo): ?>
	<tr>
		<td class="actions">
			<?php echo $this->Html->link('<span class="glyphicon glyphicon-list-alt" title="Ver"></span>', array('action' => 'view', $usuariosGrupo['UsuariosGrupo']['id']), array('escape'=>false)); ?>
			<?php echo $this->Html->link('<span class="glyphicon glyphicon-wrench" title="Ver"></span>', array('action' => 'edit', $usuariosGrupo['UsuariosGrupo']['id']), array('escape'=>false)); ?>
			<?php echo $this->Form->postLink('<span class="glyphicon glyphicon-trash" title="Borrar"></span>', array('action' => 'delete', $usuariosGrupo['UsuariosGrupo']['id']), array('escape'=>false), __('Are you sure you want to delete # %s?', $usuariosGrupo['UsuariosGrupo']['id'])); ?>
		</td>
		<td><?php echo h($usuariosGrupo['UsuariosGrupo']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($usuariosGrupo['Usuario']['nombre_completo'], array('controller' => 'usuarios', 'action' => 'view', $usuariosGrupo['Usuario']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($usuariosGrupo['Grupo']['descripcion'], array('controller' => 'grupos', 'action' => 'view', $usuariosGrupo['Grupo']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
					</tbody>
				</table>
			</div><!-- /.table-responsive -->
			
			<p><small>
				<?php
				echo $this->Paginator->counter(array(
				'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
				));
				?>			</small></p>

			<ul class="pagination">
				<?php
		echo $this->Paginator->prev('< ' . __('Previous'), array('tag' => 'li'), null, array('class' => 'disabled', 'tag' => 'li', 'disabledTag' => 'a'));
		echo $this->Paginator->numbers(array('separator' => '', 'currentTag' => 'a', 'tag' => 'li', 'currentClass' => 'disabled'));
		echo $this->Paginator->next(__('Next') . ' >', array('tag' => 'li'), null, array('class' => 'disabled', 'tag' => 'li', 'disabledTag' => 'a'));
	?>
			</ul><!-- /.pagination -->
			
		</div><!-- /.index -->
	
	</div><!-- /#page-content .col-sm-9 -->

</div><!-- /#page-container .row-fluid -->
