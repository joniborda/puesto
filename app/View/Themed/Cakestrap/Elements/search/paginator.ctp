<?php if (isset($count) && $count) : ?>
	<div class="paginator">
		<p class="small">
			<?php echo 'Página ' . $page . ' de '. $pages . ', mostrando '. ($count < 20 ? $count : '20' ) . ' registros de ' . $count .' total.';?>
		</p>
		<ul class="pagination">
			<?php $disabled = ($page == 1? true : false); ?>
			<li <?php echo ($disabled? 'class="disabled"' : ''); ?>>
				<a href="#" data-page="<?php echo $page-1?>" <?php echo ($disabled? 'disabled="disabled"' : ''); ?>>&lt; Anterior</a>
			</li>

			<?php
				// LO UNICO QUE PODEMOS CAMBIAR ES ESTA VARIABLE, SE RECOMIENDA QUE SEA IMPAR
				$cantidad_paginas_mostrar = 7;

				$mitad = ceil($cantidad_paginas_mostrar/2);
				$primer_pagina = 1;
				$ultima_pagina = $pages;
				$mostrar_ultima = false;
				$mostrar_primera = false;

				if ($pages > $cantidad_paginas_mostrar) {
					if ($page > $mitad) {
						$primer_pagina = $page - $mitad;

						if ($primer_pagina > 1) {
							$mostrar_primera = true;
						}
					}

					$ultima_pagina = $primer_pagina + $cantidad_paginas_mostrar;
					if ($ultima_pagina > $pages) {
						$ultima_pagina = $pages;
					}

					if ($pages > $ultima_pagina) {
						$mostrar_ultima = true;
					}
				}
			?>
			<?php if ($mostrar_primera): ?>
				<?php $disabled = ($page == 1? true : false); ?>
				<li <?php echo ($disabled? 'class="disabled"' : ''); ?>>
					<a href="#" data-page="1" <?php echo ($disabled? 'disabled="disabled"' : ''); ?> >1</a>
				</li>
				<li><a>...</a></li>
			<?php endif;?>
			<?php for ($i = $primer_pagina; $i <= $ultima_pagina; $i++) : ?>
			<?php $disabled = ($i == $page? true : false); ?>
			<li <?php echo ($disabled? 'class="disabled"' : ''); ?>>
				<a href="#" data-page="<?php echo $i?>" <?php echo ($disabled? 'disabled="disabled"' : ''); ?> ><?php echo $i; ?></a>
			</li>
			<?php endfor; ?>

			<?php if ($mostrar_ultima): ?>
				<li><a>...</a></li>
				<?php $disabled = ($page == $pages? true : false); ?>
				<li <?php echo ($disabled? 'class="disabled"' : ''); ?>>
					<a href="#" data-page="<?php echo $pages;?>" <?php echo ($disabled? 'disabled="disabled"' : ''); ?> ><?php echo $pages;?></a>
				</li>
			<?php endif;?>

			<?php $disabled = ($pages == 0 || $page == $pages? true : false); ?>
			<li <?php echo ($disabled? 'class="disabled"' : 'class="next"'); ?>>
				<a href="#"  data-page="<?php echo $page+1?>" rel="next" <?php echo ($disabled? 'disabled="disabled"' : ''); ?>>Siguiente &gt;</a>
			</li>
		</ul>
	</div>
<?php endif;?>