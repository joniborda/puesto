<div id="page-container" class="row">
	<div class="form" id="search-form" <?php echo ($this->view === 'admin_index')? 'style="display:none;"' : ''?>>
		<?php echo $this->Form->create('Url', array(
		    'url' => array('controller' => 'Urls', 'action' => 'find'),
			'inputDefaults' => array('label' => false), 'role' => 'form'
		));?>
		<div class="row">
			<div class="form-group col-sm-3">
				<div>
					<input type="checkbox" onclick="buscar_descripcion(this);" <?php echo (isset($this->passedArgs['descripcion']) && $this->passedArgs['descripcion'] != null)? 'checked="checked"' : '';?>/>
					<script type="text/javascript">
						function buscar_descripcion() {
							if ($('#UrlDescripcion').attr('disabled')) {
								$('#descripcion_input').show('slow');
								$('#UrlDescripcion').removeAttr('disabled');
								$('#UrlDescripcion_').removeAttr('disabled');
								
							} else {
								$('#descripcion_input').hide('slow');
								$('#UrlDescripcion').val('');
								$('#UrlDescripcion').attr('disabled', 'disabled');
								$('#UrlDescripcion_').attr('disabled', 'disabled');
							}
						}
					</script>
					<?php echo $this->Form->label('descripcion','descripcion');?>
				</div>
				<div id="descripcion_input"  <?php echo (isset($this->passedArgs['descripcion'])  && $this->passedArgs['descripcion'] != null)? '' : 'style="display:none;"' ?> >
				<?php echo $this->Form->input('descripcion', array('div' => false, "class" => "form-control", "disabled" => (isset($this->passedArgs["descripcion"])  && $this->passedArgs["descripcion"] != null )? false : "disabled"));?>
				</div>
			</div><!-- .form-group -->
		</div>
		<div style="clear:both;">
			<?php echo $this->Form->submit(__('Search'), array('class' => 'btn btn-large btn-primary'));
				echo $this->Form->end();?>
		</div>			
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

	<div id="page-content" class="col-sm-12">

		<div class="urls index">
		
			<h2>
				<?php echo __('Urls'); ?>
				<?php echo $this->Html->link('Agregar', array('controller' => 'urls', 'action' => 'add'), array('class' => 'btn btn-primary', 'escape' => false, 'style' => 'margin-left:20px')); ?>
			</h2>
			
			<div class="table-responsive">
				<table cellpadding="0" cellspacing="0" class="table table-striped table-bordered">
					<thead>
						<tr>
							<th class="actions"><?php echo __('Opciones'); ?></th>
							<th><?php echo $this->Paginator->sort('id'); ?></th>
							<th><?php echo $this->Paginator->sort('descripcion'); ?></th>
						</tr>
					</thead>
					<tbody>
					<?php foreach ($urls as $url): ?>
						<tr>
							<td class="actions">
								<?php echo $this->Html->link('<span class="glyphicon glyphicon-list-alt" title="Ver"></span>', array('action' => 'view', $url['Url']['id']), array('escape'=>false)); ?>
								<?php echo $this->Html->link('<span class="glyphicon glyphicon-wrench" title="Ver"></span>', array('action' => 'edit', $url['Url']['id']), array('escape'=>false)); ?>
								<?php echo $this->Form->postLink('<span class="glyphicon glyphicon-trash" title="Borrar"></span>', array('action' => 'delete', $url['Url']['id']), array('escape'=>false), __('Are you sure you want to delete # %s?', $url['Url']['id'])); ?>
							</td>
							<td><?php echo h($url['Url']['id']); ?>&nbsp;</td>
							<td><?php echo h($url['Url']['descripcion']); ?>&nbsp;</td>
						</tr>
					<?php endforeach; ?>
					</tbody>
				</table>
			</div><!-- /.table-responsive -->
			
			<center>
				<p>
					<small>
						<?php
						echo $this->Paginator->counter(array(
						'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
						));
						?>
					</small>
				</p>

				<ul class="pagination">
				<?php
					echo $this->Paginator->prev('< ' . __('Previous'), array('tag' => 'li'), null, array('class' => 'disabled', 'tag' => 'li', 'disabledTag' => 'a'));
					echo $this->Paginator->numbers(array('separator' => '', 'currentTag' => 'a', 'tag' => 'li', 'currentClass' => 'disabled'));
					echo $this->Paginator->next(__('Next') . ' >', array('tag' => 'li'), null, array('class' => 'disabled', 'tag' => 'li', 'disabledTag' => 'a'));
				?>
				</ul><!-- /.pagination -->
			</center>			
		</div><!-- /.index -->
	
	</div><!-- /#page-content .col-sm-9 -->

</div><!-- /#page-container .row-fluid -->
