
<div id="page-container" class="row">

<!-- 	<div id="sidebar" class="col-sm-3">
		
		<div class="actions">
			
			<ul class="list-group">			
						<li class="list-group-item"><?php echo $this->Html->link(__('Edit Grupos Url'), array('action' => 'edit', $gruposUrl['GruposUrl']['id']), array('class' => '')); ?> </li>
		<li class="list-group-item"><?php echo $this->Form->postLink(__('Delete Grupos Url'), array('action' => 'delete', $gruposUrl['GruposUrl']['id']), array('class' => ''), __('Are you sure you want to delete # %s?', $gruposUrl['GruposUrl']['id'])); ?> </li>
		<li class="list-group-item"><?php echo $this->Html->link(__('List Grupos Urls'), array('action' => 'index'), array('class' => '')); ?> </li>
		<li class="list-group-item"><?php echo $this->Html->link(__('New Grupos Url'), array('action' => 'add'), array('class' => '')); ?> </li>
		<li class="list-group-item"><?php echo $this->Html->link(__('List Grupos'), array('controller' => 'grupos', 'action' => 'index'), array('class' => '')); ?> </li>
		<li class="list-group-item"><?php echo $this->Html->link(__('New Grupo'), array('controller' => 'grupos', 'action' => 'add'), array('class' => '')); ?> </li>
		<li class="list-group-item"><?php echo $this->Html->link(__('List Urls'), array('controller' => 'urls', 'action' => 'index'), array('class' => '')); ?> </li>
		<li class="list-group-item"><?php echo $this->Html->link(__('New Url'), array('controller' => 'urls', 'action' => 'add'), array('class' => '')); ?> </li>
				
			</ul><!-- /.list-group -->
			
<!-- 		</div><!-- /.actions -->
		
<!-- 	</div><!-- /#sidebar .span3 -->
				
		<div id="page-content" class="col-sm-12">
<!-- 	<div id="page-content" class="col-sm-9"> -->
		
		<div class="gruposUrls view">

			<h2><?php  echo __('Grupos Url'); ?></h2>
			
			<div class="table-responsive">
				<table class="table table-striped table-bordered">
					<tbody>
						<tr>		<td><strong><?php echo __('Id'); ?></strong></td>
		<td>
			<?php echo h($gruposUrl['GruposUrl']['id']); ?>
			&nbsp;
		</td>
</tr><tr>		<td><strong><?php echo __('Grupo'); ?></strong></td>
		<td>
			<?php echo $this->Html->link($gruposUrl['Grupo']['descripcion'], array('controller' => 'grupos', 'action' => 'view', $gruposUrl['Grupo']['id']), array('class' => '')); ?>
			&nbsp;
		</td>
</tr><tr>		<td><strong><?php echo __('Url'); ?></strong></td>
		<td>
			<?php echo $this->Html->link($gruposUrl['Url']['descripcion'], array('controller' => 'urls', 'action' => 'view', $gruposUrl['Url']['id']), array('class' => '')); ?>
			&nbsp;
		</td>
</tr>					</tbody>
				</table><!-- /.table table-striped table-bordered -->
			</div><!-- /.table-responsive -->
			
		</div><!-- /.view -->

			
	</div><!-- /#page-content .span9 -->

</div><!-- /#page-container .row-fluid -->
