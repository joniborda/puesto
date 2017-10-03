<li class=" <?php echo (array_search($current_controller, array('','usuarios', 'grupos','urls')) != null) ? 'active': ''?>">
	<a href="#" class="" data-toggle="">
		AREA ADMIN
	</a>
	<ul class="-menu">
		<li class="-submenu <?php echo $current_controller == 'usuarios'? 'active': ''?>">
			<a href="#" class="" data-toggle="">Usuarios</a>
			<ul class="-menu">
				<li
					class="<?php echo ($current_controller == 'usuarios' && $current_action == 'admin_add') ? 'active': ''?>">
					<a href="<?php echo Router::url(array('controller' => 'usuarios', 'action' => 'add'));?>">
						Agregar
					</a>
				</li>
				<li
					class="<?php echo ($current_controller == 'usuarios' && $current_action == 'admin_index') ? 'active': ''?>"><a
					href="<?php echo Router::url(array('controller' => 'usuarios', 'action' => 'index'));?>">Listado</a></li>
			</ul>
		</li>
		<li
			class="-submenu <?php echo $current_controller == 'grupos'? 'active': ''?>">
			<a href="#" class="" data-toggle="">Grupos
		</a>
			<ul class="-menu">
				<li
					class="<?php echo ($current_controller == 'grupos' && $current_action == 'admin_add') ? 'active': ''?>"><a
					href="<?php echo Router::url(array('controller' => 'grupos', 'action' => 'add'));?>">Agregar</a></li>
				<li
					class="<?php echo ($current_controller == 'grupos' && $current_action == 'admin_index') ? 'active': ''?>"><a
					href="<?php echo Router::url(array('controller' => 'grupos', 'action' => 'index'));?>">Listado</a></li>
			</ul>
		</li>
		<li
			class="-submenu <?php echo $current_controller == 'urls'? 'active': ''?>">
			<a href="#" class="" data-toggle="">URLs </a>
			<ul class="-menu">
				<li
					class="<?php echo ($current_controller == 'urls' && $current_action == 'admin_add') ? 'active': ''?>"><a
					href="<?php echo Router::url(array('controller' => 'urls', 'action' => 'add'));?>">Agregar</a></li>
				<li
					class="<?php echo ($current_controller == 'urls' && $current_action == 'admin_cargar') ? 'active': ''?>"><a
					href="<?php echo Router::url(array('controller' => 'urls', 'action' => 'cargar'));?>">Cargar todas</a></li>
				<li
					class="<?php echo ($current_controller == 'urls' && $current_action == 'admin_index') ? 'active': ''?>"><a
					href="<?php echo Router::url(array('controller' => 'urls', 'action' => 'index'));?>">Listado</a></li>
			</ul>
		</li>
		<li
			class="-submenu <?php echo $current_controller == 'historials'? 'active': ''?>">
			<a href="#" class="" data-toggle="">Historial
		</a>
			<ul class="-menu">
				<li
					class="<?php echo ($current_controller == 'historials' && $current_action == 'admin_index') ? 'active': ''?>"><a
					href="<?php echo Router::url(array('controller' => 'historials', 'action' => 'index'));?>">Listado</a></li>
			</ul>
		</li>
	</ul>
</li>