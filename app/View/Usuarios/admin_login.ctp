<?php echo $this->Html->css ( 'login' ); ?>
<div id="background">
    
</div>
<div class="login">
	<?php echo $this->Form->create('Usuario', array('class' => 'form-signin')); ?>
		<h3 class="title">Ingreso</h3>
		<div class="img_background">
			<div class="img_1"></div>
		</div>
		<?php echo $this->Form->input ( 'usuario_login', array (
			'type' => 'text',
			'placeholder' => 'Usuario',
			'class' => 'form-control-dos',
			'label' => false,
			'div' => false
		) );?>
		<div class="img_background">
			<div class="img_2"></div>
		</div>
		<?php echo $this->Form->input ( 'contrasenia', array (
			'type' => 'password',
			'class' => 'form-control-dos',
			'placeholder' => 'Contraseña',
			'label' => false,
			'div' => false
		) );?>
		<?php echo $this->Form->submit(__('Ingresar'), array(
			'class' => 'button',
			'div' => false
		)); ?>
	<?php echo $this->Form->end(); ?>

</div>
<script type="text/javascript">
	function resize() {
		var height = window.innerHeight - $('#footer').height() - $('.sql_dump').height();
		if (height < 560) {
			$('#content').height(560);
			$('#background').height(560 + $('.sql_dump').height());
		} else {
			$('#content').height(height);
			$('#background').height(window.innerHeight);
		}

		$('#UsuarioAdminLoginForm').css('margin-top', $('#content').height() /3);

		$('#background').width(window.innerWidth);
	}
	window.onresize = resize;
	$(function() {
		resize();
	});
</script>