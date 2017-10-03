<div id="page-container" class="row">
    <div id="page-content" class="col-sm-12">
        <div class="usuarios form p_form">
			<?php echo $this->Form->create('Usuario', array('inputDefaults' => array('label' => false), 'role' => 'form')); ?>
				<fieldset>
                <h2><?php echo __('Agregar Usuario'); ?></h2>
                <hr />
                <div class="row">
                    <div class="form-group col-sm-2">
						<?php echo $this->Form->label('nombre_completo', 'Nombre Completo'); ?>
					</div>
                    <!-- .form-group -->
                    <div class="form-group col-sm-4">
						<?php echo $this->Form->input('nombre_completo', array('div' => false, 'type' => 'text', "class" => 'form-control')); ?>
					</div>
                    <!-- .form-group -->
                    <div class="form-group col-sm-2">
						<?php echo $this->Form->label('usuario_login', 'Usuario Login'); ?>
					</div>
                    <!-- .form-group -->
                    <div class="form-group col-sm-4">
						<?php echo $this->Form->input('usuario_login', array('div' => false, 'type' => 'text', "class" => 'form-control')); ?>
					</div>
                    <!-- .form-group -->

                </div>
                <div class="row">
                    <div class="form-group col-sm-2">
						<?php echo $this->Form->label('apellido', 'Apellido'); ?>
					</div>
                    <!-- .form-group -->
                    <div class="form-group col-sm-4">
						<?php echo $this->Form->input('apellido', array('div' => false, 'type' => 'text', "class" => 'form-control')); ?>
					</div>
                    <!-- .form-group -->

                    <div class="form-group col-sm-2">
						<?php echo $this->Form->label('nombre', 'Nombre'); ?>
					</div>
                    <!-- .form-group -->
                    <div class="form-group col-sm-4">
						<?php echo $this->Form->input('nombre', array('div' => false, 'type' => 'text', "class" => 'form-control')); ?>
					</div>
                    <!-- .form-group -->
                </div>
                <div class="row">
                    <div class="form-group col-sm-2">
						<?php echo $this->Form->label('contrasenia', 'Password'); ?>
					</div>
                    <!-- .form-group -->
                    <div class="form-group col-sm-4">
						<?php echo $this->Form->input('contrasenia', array('type' => 'password', 'div' => false, "class" => 'form-control')); ?>
					</div>
                    <!-- .form-group -->
                </div>

                <div class="row">
                    <div class="form-group col-sm-2">
						<?php echo $this->Form->label('email', 'Email'); ?>
					</div>
                    <!-- .form-group -->
                    <div class="form-group col-sm-4">
						<?php echo $this->Form->input('email', array('div' => false, "class" => 'form-control')); ?>
					</div>
                    <!-- .form-group -->
                </div>
                <div class="row"></div>
					<?php echo $this->Form->input('Grupo');?>
				</fieldset>
			<?php echo $this->Form->submit('Agregar', array('class' => 'btn btn-large btn-primary')); ?>
            <div class="limpiar"></div>
<?php echo $this->Form->end(); ?>
		</div>
        <!-- /.form -->
    </div>
    <!-- /#page-content .col-sm-9 -->
</div>
<!-- /#page-container .row-fluid -->
