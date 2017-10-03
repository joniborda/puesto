
<div id="page-container" class="row">

<!-- 	<div id="sidebar" class="col-sm-3">
		
		<div class="actions">
		
			<ul class="list-group">
							</ul><!-- /.list-group -->
		
<!-- 		</div><!-- /.actions -->
		
<!-- 	</div><!-- /#sidebar .col-sm-3 -->
	
<!-- 	<div id="page-content" class="col-sm-9"> -->
	<div id="page-content" class="col-sm-12">

		<div class="historiales form p_form">
		
			<?php echo $this->Form->create('Historiale', array('inputDefaults' => array('label' => false), 'role' => 'form')); ?>
				<fieldset>
					<h2><?php echo __('Editar Historiale'); ?></h2>
				<hr />
						<div class="row">
									<div class="form-group col-sm-2">
	<?php echo $this->Form->label('usuario_id', 'Usuario'); ?>
</div><!-- .form-group -->
<div class="form-group col-sm-4">
		<?php echo $this->Form->input('usuario_id', array('div' => false, "class" => 'form-control')); ?>
</div><!-- .form-group -->

						<div class="form-group col-sm-2">
	<?php echo $this->Form->label('url', 'Url'); ?>
</div><!-- .form-group -->
<div class="form-group col-sm-4">
		<?php echo $this->Form->input('url', array('div' => false, "class" => 'form-control')); ?>
</div><!-- .form-group -->

			</div>
							<div class="row">
									<div class="form-group col-sm-2">
	<?php echo $this->Form->label('parametros', 'Parametros'); ?>
</div><!-- .form-group -->
<div class="form-group col-sm-4">
		<?php echo $this->Form->input('parametros', array('div' => false, "class" => 'form-control')); ?>
</div><!-- .form-group -->

						<div class="form-group col-sm-2">
	<?php echo $this->Form->label('navegador', 'Navegador'); ?>
</div><!-- .form-group -->
<div class="form-group col-sm-4">
		<?php echo $this->Form->input('navegador', array('div' => false, "class" => 'form-control')); ?>
</div><!-- .form-group -->

			</div>
							<div class="row">
									<div class="form-group col-sm-2">
	<?php echo $this->Form->label('ip', 'Ip'); ?>
</div><!-- .form-group -->
<div class="form-group col-sm-4">
		<?php echo $this->Form->input('ip', array('div' => false, "class" => 'form-control')); ?>
</div><!-- .form-group -->

						<div class="form-group col-sm-2">
	<?php echo $this->Form->label('fecha', 'Fecha'); ?>
</div><!-- .form-group -->
<div class="form-group col-sm-4">
		<?php echo $this->Form->input('fecha', array('type'=>'text','div' => false, "class" => 'form-control datepicker')); ?>
</div><!-- .form-group -->

			</div>
							<div class="row">
									</div>
								</fieldset>
			<?php echo $this->Form->submit('Editar', array('class' => 'btn btn-large btn-primary')); ?>
<?php echo $this->Form->end(); ?>
			
		</div><!-- /.form -->
			
	</div><!-- /#page-content .col-sm-9 -->

</div><!-- /#page-container .row-fluid -->
