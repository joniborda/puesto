<h2 class="hightitle"><?php __('Recuperar contraseña'); ?></h2>
<div class="forgetpwd form" style="margin:5px auto 5px auto;width:450px;">
<?php echo $this->Form->create('Usuario', array('action' => 'forgetpwd')); ?>
<?php echo $this->Form->input('email',array('class' => 'form-control'));?>
<?php echo $this->Form->submit(__('Recuperar'), array('class' => 'btn btn-large btn-primary')); ?>
<?php echo $this->Form->end();?>
</div>