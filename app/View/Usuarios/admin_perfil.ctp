<style type="text/css">
	.usuarios img {
		width: 50%;
		text-align: center;
		margin: auto;
		display: inherit;
	}
</style>
<div id="page-container" class="row">
	<div id="page-content" class="col-sm-12">
		<div class="usuarios form p_form">
			<?php echo $this->Form->create('Usuario', array("enctype"=>"multipart/form-data",'inputDefaults' => array('div' => false, 'label' => false), 'role' => 'form')); ?>
			<fieldset>
				<h3>
					Perfil
				</h3>
				<div class="row">
					<div class="col-sm-3">
						
						<?php
						$filename = $current_user['usuario_login'] . "_" . md5($current_user['usuario_login']);

						if (file_exists( WWW_ROOT . '/perfiles/' . $filename. '.jpg')) {
							echo $this->Html->image('/perfiles/' . $filename. '.jpg');
						} else {
							echo $this->Html->image('/img/perfil.png');
						}
						?>
					</div>
					<div class="col-sm-9">
						<div class="row">
							<div class="form-group col-sm-2">
								<?php echo $this->Form->label('nombre_completo', 'Nombre Completo'); ?>
							</div><!-- .form-group -->
							<div class="form-group col-sm-4">
								<?php echo $this->Form->input('nombre_completo', array('type' => 'text', "class" => 'form-control')); ?>
							</div><!-- .form-group -->
						</div>
						<div class="row">
							<div class="form-group col-sm-2">
								<?php echo $this->Form->label('usuario_login', 'Usuario Login'); ?>
							</div><!-- .form-group -->
							<div class="form-group col-sm-4">
								<?php echo $this->Form->input('usuario_login', array('type' => 'text', "class" => 'form-control', 'disabled' => 'disabled')); ?>
							</div><!-- .form-group -->
						</div>
						<div class="row">
							<div class="form-group col-sm-2">
								<?php echo $this->Form->label('contrasenia', 'Contraseña'); ?>
							</div><!-- .form-group -->
							<div class="form-group col-sm-4">
								<div class="text_contrasenia padding">
									xxxxxxxxxx <a href="#" id="cambiar_contrasenia">CAMBIAR</a>
								</div>
								<div class="input_contrasenia ocultar">
									<?php echo $this->Form->input('contrasenia', array('type' => 'password',"class" => 'form-control', 'value' => '')); ?>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-sm-2">
								<?php echo $this->Form->label('imagen', 'Imagen JPG'); ?>
							</div>
							<div class="form-group col-sm-2">
								<div class="padding">
									<a href="#" class="click_file">
										SELECCIONAR
									</a>
								</div>
								<?php echo $this->Form->input('imagen', array('type'=>'file', "class" => 'ocultar'));?>
							</div>
						</div>
						<?php echo $this->Form->submit('Guardar', array('class' => 'btn btn-large btn-primary')); ?>
					</div>
				</div>
			</fieldset>
			<?php echo $this->Form->end(); ?>
			
		</div><!-- /.form -->

	</div><!-- /#page-content .col-sm-9 -->

</div><!-- /#page-container .row-fluid -->
<script type="text/javascript">
	$('#cambiar_contrasenia').click(function(e){
		e.preventDefault();
		$('.input_contrasenia').removeClass('ocultar').show();
		$('.text_contrasenia').hide();
		return false;
	});
</script>