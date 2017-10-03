<div id="page-container" class="row">
	<div id="page-content" class="col-sm-12">
		<div class="grupos form">
			<?php echo $this->Form->create('Grupo', array('inputDefaults' => array('label' => false), 'role' => 'form')); ?>
			<fieldset>
				<h2><?php echo __('Admin Add Grupo'); ?></h2>
				<div class="form-group">
					<?php echo $this->Form->label('descripcion', Inflector::humanize('descripcion'));?>
					<?php echo $this->Form->input('descripcion', array('type' => 'text', 'div' => false, "class" => 'form-control')); ?>
				</div><!-- .form-group -->
				<?php echo $this->Form->label('Url', Inflector::humanize('url'));?>
				<?php echo $this->Form->input('Url');?>
				<?php echo $this->Form->label('Usuario', Inflector::humanize('usuario'));?>
				<?php echo $this->Form->input('Usuario', array('multiple' => 'multiple'));?>
			</fieldset>
			<?php echo $this->Form->submit('Submit', array('class' => 'btn btn-large btn-primary')); ?>
			<?php echo $this->Form->end(); ?>
		</div><!-- /.form -->
	</div><!-- /#page-content .col-sm-9 -->
</div><!-- /#page-container .row-fluid -->
