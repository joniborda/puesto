<h2 class="hightitle"><?php __('Recuperar contraseña'); ?></h2>
<div class="forgetpwd form" style="margin:5px auto 5px auto;width:450px;">
<?php //echo $this->Form->create('Usuario', array('action' => 'reset')); ?>
 
<?php
if(isset($errors)){
echo '<div class="error">';
echo "<ul>";
foreach($errors as $error){
 echo"<li><div class='error-message'>$error</div></li>";
}
echo"</ul>";
echo'</div>';
}
?>
 
<form method="post">
<?php
echo $this->Form->input('password',array('class' => 'form-control',"type"=>"password", 'label' => 'Nuevo password',"name"=>"data[Usuario][password]"));
?>
 <?php echo $this->Form->submit(__('Guardar'), array('class' => 'btn btn-large btn-primary')); ?>
<?php //echo $this->Form->end();?>
</form>
</div>