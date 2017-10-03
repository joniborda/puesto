<div id="page-container" class="row">
	<div id="page-content" class="col-sm-12">
		<div class="usuarios form p_form">
			<?php echo $this->Form->create('Usuario', array('inputDefaults' => array('label' => false), 'role' => 'form')); ?>
				<fieldset>
					<h2>Editar</h2>
					<hr />
					<div class="row">
						<div class="form-group col-sm-2">
							<?php echo $this->Form->label('nombre_completo', 'Nombre completo'); ?>
						</div><!-- .form-group -->
						<div class="form-group col-sm-4">
							<?php echo $this->Form->input('nombre_completo', array('type' => 'text', 'div' => false, "class" => 'form-control')); ?>
						</div><!-- .form-group -->
					</div>
					<div class="row">
						<div class="form-group col-sm-2">
							<?php echo $this->Form->label('usuario_login', 'Usuario Login'); ?>
						</div><!-- .form-group -->
						<div class="form-group col-sm-4">
							<?php echo $this->Form->input('usuario_login', array('type' => 'text', 'div' => false, "class" => 'form-control')); ?>
						</div><!-- .form-group -->
					</div>
					<div class="row">
						<div class="form-group col-sm-2">
							<?php echo $this->Form->label('contrasenia', 'Contraseña'); ?>
						</div><!-- .form-group -->
						<div class="form-group col-sm-4">
							<?php echo $this->Form->input('contrasenia', array('type' => 'password', 'div' => false, "class" => 'form-control', 'value' => '')); ?>
						</div><!-- .form-group -->
					</div>
					<div class="row">
						<div class="form-group col-sm-2">
							<?php echo $this->Form->label('email', 'email'); ?>
						</div><!-- .form-group -->
						<div class="form-group col-sm-4">
							<?php echo $this->Form->input('email', array('type' => 'text', 'div' => false, "class" => 'form-control')); ?>
						</div><!-- .form-group -->
					</div>
					<div class="row">
						<div class="form-group col-sm-2">
							<?php echo $this->Form->label('area', 'area'); ?>
						</div><!-- .form-group -->
						<div class="form-group col-sm-4">
							<?php echo $this->Form->input('area', array('type' => 'select', 'div' => false, "class" => 'form-control')); ?>
						</div><!-- .form-group -->
					</div>
					<div class="row">
					</div>
						<?php echo $this->Form->input('Grupo');?>

				</fieldset>
			<?php echo $this->Form->submit('Editar', array('class' => 'btn btn-large btn-primary')); ?>
<?php echo $this->Form->end(); ?>
			
		</div><!-- /.form -->
			
	</div><!-- /#page-content .col-sm-9 -->

</div><!-- /#page-container .row-fluid -->
