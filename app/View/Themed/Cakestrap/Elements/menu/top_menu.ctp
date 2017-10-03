<div>
	<a href="#" onclick="mostrarNavBar(150)" class="boton_nav_bar mostrar_nav_bar"><span class="glyphicon glyphicon-chevron-right"></span></a>	
</div>
<div class="sidebar">
</div>
<nav id="menu">	
	<div id="top_menu_div">
		<a href="#" onclick="ocultarNavBar(150)" class="boton_nav_bar"><span class="glyphicon glyphicon-chevron-left"></span></a>
		<h4 class="title_principal">
			RED DE TRABAJO SOBRE IDENTIDAD BIOLÓGICA
		</h4>
		<div class="menu_login">
			<?php if ($current_user) {
				$ruta_logout = Router::url(
					array (
						'controller' => 'usuarios',
						'action' => 'admin_logout' 
						)
					);
					?>
			<div>
				<a href="<?php echo Router::url(array('controller' => 'usuarios', 'action' => 'perfil', $current_user['usuario_login']));?>">
					<?php echo ucfirst($current_user['usuario_login']); ?>
				</a>
			</div>
			<div>
				<a href="<?php echo Router::url(array('controller' => 'usuarios', 'action' => 'perfil', $current_user['usuario_login']));?>">
					<?php
					$filename = $current_user ['usuario_login'] . "_" . md5 ( $current_user['usuario_login'] );

					if (file_exists ( WWW_ROOT . '/perfiles/' . $filename . '.jpg' )) {
						echo $this->Html->image ( '/perfiles/' . $filename . '.jpg', array (
							'alt' => 'Foto',
							'title' => 'Foto',
							'width' => '50px',
							'height' => '50px',
							'id' => 'f_perfil' 
							) );
					} else {
						echo $this->Html->image ( 'perfil.png', array (
							'alt' => 'Foto',
							'title' => 'Foto',
							'width' => '50px',
							'height' => '50px',
							'id' => 'f_perfil' 
							) );
					}
					?>
				</a>
			</div>
			<div>
				<a id='a_logout' href="<?php echo $ruta_logout; ?>">
					<i class="glyphicon glyphicon-off"></i>
					<?php echo __('Salir'); ?>
				</a>
			</div>
			<?php
		}
		?>
		</div>
	</div>
	<ul>
		<?php if (isset($is_admin) && $is_admin):?>
			<?php echo $this->element('menu/top_admin');?>
		<?php endif;?>
		<li class="<?php 
			if ($current_controller == 'pedidos' && $current_action == 'admin_index' && !empty($tipo) && $tipo == 'mio' ):
				echo 'mm-selected';
			endif;
		?>">
			<a href="<?php echo Router::url(array('controller' => 'pedidos', 'action' => 'admin_index', 'mio'))?>" class="">
				<!-- Muestra los pedidos que soy responsable -->
				Mi Bandeja
			</a>
		</li>
		<li class="<?php echo ($current_controller == 'pedidos' && $current_action == 'admin_index' && empty($tipo)) ? 'mm-selected': ''?>">
			<a href="<?php echo Router::url(array('controller' => 'pedidos', 'action' => 'admin_index'))?>" class="">
				<!-- Muestra los pedidos que hice como area -->
				Pedidos
			</a>
		</li>
		<li class="<?php echo ($current_controller == 'orden_pagos' && $current_action == 'admin_index') ? 'mm-selected': ''?>">
			<a href="<?php echo Router::url(array('controller' => 'orden_pagos', 'action' => 'admin_index'))?>" class="">
				Orden de pago
			</a>
		</li>
		<li class=" <?php echo $current_controller == 'personas' || $current_controller == 'vPersonas' ? 'mm-selected': ''?>">
			<a href="#" class="" data-toggle="">
				Personas
			</a>
			<ul class="">
				<li class="<?php echo ($current_controller == 'personas' && $current_action == 'admin_index') ? 'mm-selected': ''?>">
					<a href="<?php echo Router::url(array('controller' => 'personas', 'action' => 'index'));?>">
						Listado
					</a>
				</li>
				<li class="<?php echo ($current_controller == 'vPersonas' && $current_action == 'admin_index') ? 'mm-selected': ''?>">
					<a href="<?php echo Router::url(array('controller' => 'vPersonas', 'action' => 'index'));?>">Búsqueda avanzada</a>
				</li>
			</ul>
		</li>

		<li class=" <?php echo ($current_controller == 'pedidos' && $current_action == 'admin_grafico') ? 'mm-selected': ''?>">
			<a href="<?php echo Router::url(array('controller' => 'pedidos', 'action' => 'admin_grafico'))?>" class="">
				Reportes
			</a>
		</li>

		<li class=" <?php echo $current_controller == 'tareas' ? 'mm-selected': ''?>">
			<a href="#" class="" data-toggle="">
				Tareas
			</a>
			<ul class="">
				<li>
					<a href="<?php echo Router::url(array('controller' => 'tareas', 'action' => 'index', 'sin_revisar'));?>">
						Sin revisar
					</a>
				</li>
				<li>
					<a href="<?php echo Router::url(array('controller' => 'tareas', 'action' => 'index', 'revisadas'));?>">
						Revisadas
					</a>
				</li>
			</ul>
		</li>
	</ul>
</nav>