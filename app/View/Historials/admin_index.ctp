
<div id="page-container" class="row">
	<div class="form" id="search-form" <?php echo ($this->view === 'admin_index')? 'style="display:none;"' : ''?>>	<?php echo $this->Form->create('Historial', array(
		    'url' => array('controller' => 'Historials', 'action' => 'find'),
			'inputDefaults' => array('label' => false), 'role' => 'form'
		));?>						<div class="row">
												<div class="form-group col-sm-3">
				<div>
					<input type="checkbox" id="HistorialUsuarioIdCheck" onclick="buscar_usuario_id(this);" <?php echo (isset($this->passedArgs['usuario_id']) && $this->passedArgs['usuario_id'] != null)? 'checked="checked"' : '';?>/>
					<script type="text/javascript">
						function buscar_usuario_id() {
							if ($('#HistorialUsuarioId').attr('disabled')) {
								$('#usuario_id_input').show('slow');
								$('#HistorialUsuarioId').removeAttr('disabled');
								$('#HistorialUsuarioId_').removeAttr('disabled');
								
							} else {
								$('#usuario_id_input').hide('slow');
								$('#HistorialUsuarioId').val('');
								$('#HistorialUsuarioId').attr('disabled', 'disabled');
								$('#HistorialUsuarioId_').attr('disabled', 'disabled');
							}
						}
					</script>

				<?php echo $this->Form->label('usuario_id','Usuario');?></div>

				<div id="usuario_id_input"  <?php echo (isset($this->passedArgs['usuario_id'])  && $this->passedArgs['usuario_id'] != null)? '' : 'style="display:none;"' ?> >
				<?php echo $this->Form->input('usuario_id', array('type'=>'text','div' => false, "class" => "form-control", "disabled" => (isset($this->passedArgs["usuario_id"])  && $this->passedArgs["usuario_id"] != null )? false : "disabled"));?>				</div>
			</div><!-- .form-group -->
												<div class="form-group col-sm-3">
				<div>
					<input type="checkbox" id="HistorialUrlCheck" onclick="buscar_url(this);" <?php echo (isset($this->passedArgs['url']) && $this->passedArgs['url'] != null)? 'checked="checked"' : '';?>/>
					<script type="text/javascript">
						function buscar_url() {
							if ($('#HistorialUrl').attr('disabled')) {
								$('#url_input').show('slow');
								$('#HistorialUrl').removeAttr('disabled');
								$('#HistorialUrl_').removeAttr('disabled');
								
							} else {
								$('#url_input').hide('slow');
								$('#HistorialUrl').val('');
								$('#HistorialUrl').attr('disabled', 'disabled');
								$('#HistorialUrl_').attr('disabled', 'disabled');
							}
						}
					</script>

				<?php echo $this->Form->label('url','Url');?></div>

				<div id="url_input"  <?php echo (isset($this->passedArgs['url'])  && $this->passedArgs['url'] != null)? '' : 'style="display:none;"' ?> >
				<?php echo $this->Form->input('url', array('div' => false, "class" => "form-control", "disabled" => (isset($this->passedArgs["url"])  && $this->passedArgs["url"] != null )? false : "disabled"));?>				</div>
			</div><!-- .form-group -->
												<div class="form-group col-sm-3">
				<div>
					<input type="checkbox" id="HistorialParametrosCheck" onclick="buscar_parametros(this);" <?php echo (isset($this->passedArgs['parametros']) && $this->passedArgs['parametros'] != null)? 'checked="checked"' : '';?>/>
					<script type="text/javascript">
						function buscar_parametros() {
							if ($('#HistorialParametros').attr('disabled')) {
								$('#parametros_input').show('slow');
								$('#HistorialParametros').removeAttr('disabled');
								$('#HistorialParametros_').removeAttr('disabled');
								
							} else {
								$('#parametros_input').hide('slow');
								$('#HistorialParametros').val('');
								$('#HistorialParametros').attr('disabled', 'disabled');
								$('#HistorialParametros_').attr('disabled', 'disabled');
							}
						}
					</script>

				<?php echo $this->Form->label('parametros','Parametros');?></div>

				<div id="parametros_input"  <?php echo (isset($this->passedArgs['parametros'])  && $this->passedArgs['parametros'] != null)? '' : 'style="display:none;"' ?> >
				<?php echo $this->Form->input('parametros', array('div' => false, "class" => "form-control", "disabled" => (isset($this->passedArgs["parametros"])  && $this->passedArgs["parametros"] != null )? false : "disabled"));?>				</div>
			</div><!-- .form-group -->
												<div class="form-group col-sm-3">
				<div>
					<input type="checkbox" id="HistorialNavegadorCheck" onclick="buscar_navegador(this);" <?php echo (isset($this->passedArgs['navegador']) && $this->passedArgs['navegador'] != null)? 'checked="checked"' : '';?>/>
					<script type="text/javascript">
						function buscar_navegador() {
							if ($('#HistorialNavegador').attr('disabled')) {
								$('#navegador_input').show('slow');
								$('#HistorialNavegador').removeAttr('disabled');
								$('#HistorialNavegador_').removeAttr('disabled');
								
							} else {
								$('#navegador_input').hide('slow');
								$('#HistorialNavegador').val('');
								$('#HistorialNavegador').attr('disabled', 'disabled');
								$('#HistorialNavegador_').attr('disabled', 'disabled');
							}
						}
					</script>

				<?php echo $this->Form->label('navegador','Navegador');?></div>

				<div id="navegador_input"  <?php echo (isset($this->passedArgs['navegador'])  && $this->passedArgs['navegador'] != null)? '' : 'style="display:none;"' ?> >
				<?php echo $this->Form->input('navegador', array('div' => false, "class" => "form-control", "disabled" => (isset($this->passedArgs["navegador"])  && $this->passedArgs["navegador"] != null )? false : "disabled"));?>				</div>
			</div><!-- .form-group -->
					</div>
				<div class="row">
												<div class="form-group col-sm-3">
				<div>
					<input type="checkbox" id="HistorialIpCheck" onclick="buscar_ip(this);" <?php echo (isset($this->passedArgs['ip']) && $this->passedArgs['ip'] != null)? 'checked="checked"' : '';?>/>
					<script type="text/javascript">
						function buscar_ip() {
							if ($('#HistorialIp').attr('disabled')) {
								$('#ip_input').show('slow');
								$('#HistorialIp').removeAttr('disabled');
								$('#HistorialIp_').removeAttr('disabled');
								
							} else {
								$('#ip_input').hide('slow');
								$('#HistorialIp').val('');
								$('#HistorialIp').attr('disabled', 'disabled');
								$('#HistorialIp_').attr('disabled', 'disabled');
							}
						}
					</script>

				<?php echo $this->Form->label('ip','Ip');?></div>

				<div id="ip_input"  <?php echo (isset($this->passedArgs['ip'])  && $this->passedArgs['ip'] != null)? '' : 'style="display:none;"' ?> >
				<?php echo $this->Form->input('ip', array('div' => false, "class" => "form-control", "disabled" => (isset($this->passedArgs["ip"])  && $this->passedArgs["ip"] != null )? false : "disabled"));?>				</div>
			</div><!-- .form-group -->
												<div class="form-group col-sm-3">
				<div>
					<input type="checkbox" id="HistorialFechaCheck" onclick="buscar_fecha(this);" <?php echo (isset($this->passedArgs['fecha']) && $this->passedArgs['fecha'] != null)? 'checked="checked"' : '';?>/>
					<script type="text/javascript">
						function buscar_fecha() {
							if ($('#HistorialFecha').attr('disabled')) {
								$('#fecha_input').show('slow');
								$('#HistorialFecha').removeAttr('disabled');
								$('#HistorialFecha_').removeAttr('disabled');
								
							} else {
								$('#fecha_input').hide('slow');
								$('#HistorialFecha').val('');
								$('#HistorialFecha').attr('disabled', 'disabled');
								$('#HistorialFecha_').attr('disabled', 'disabled');
							}
						}
					</script>

				<?php echo $this->Form->label('fecha','Fecha');?></div>

				<div id="fecha_input"  <?php echo (isset($this->passedArgs['fecha'])  && $this->passedArgs['fecha'] != null)? '' : 'style="display:none;"' ?> >
				<?php echo $this->Form->input('fecha', array('type'=>'text','div' => false, "class" => "form-control datepicker", "disabled" => (isset($this->passedArgs["fecha"])  && $this->passedArgs["fecha"] != null )? false : "disabled"));?>				</div>
			</div><!-- .form-group -->
								</div>
				<div style="clear:both;">			<?php echo $this->Form->submit(__('Buscar'), array('class' => 'btn btn-large btn-primary'));
 echo $this->Form->end();?>		</div>			
	</div><!-- form -->
	<div class="show_search text-center">
	<a href="#" onclick="showSearch(this);return false;">
		<?php echo ($this->view === 'admin_index')? '<span class="glyphicon glyphicon-chevron-down"></span>' : '<span class="glyphicon glyphicon-chevron-up"></span>';?>  
		<span>Búsqueda</span>
	</a>
	<script type="text/javascript">
		function showSearch(element) {
				if ($('#search-form').is(':visible')) {
					$(element).find('.glyphicon').removeClass('glyphicon-chevron-up');
					$(element).find('.glyphicon').addClass('glyphicon-chevron-down');
					$('#search-form').hide('slow');
				} else {
					$(element).find('.glyphicon').removeClass('glyphicon-chevron-down');
					$(element).find('.glyphicon').addClass('glyphicon-chevron-up');
					$('#search-form').show('slow');
				}
			}
	</script>
	</div>
			
	<div id="page-content" class="col-sm-12">

		<div class="historiales index">
		
			<h2><?php echo __('Historials'); ?></h2>
			<hr />
			<div class="table-responsive">
				<table cellpadding="0" cellspacing="0" class="table table-striped table-bordered">
					<thead>
						<tr>
							<th class="actions"><?php echo __('Opciones'); ?></th>
							<th><?php echo $this->Paginator->sort('id'); ?></th>
							<th><?php echo $this->Paginator->sort('usuario'); ?></th>
							<th><?php echo $this->Paginator->sort('url'); ?></th>
							<th><?php echo $this->Paginator->sort('parametros'); ?></th>
							<th><?php echo $this->Paginator->sort('navegador'); ?></th>
							<th><?php echo $this->Paginator->sort('ip'); ?></th>
							<th><?php echo $this->Paginator->sort('fecha'); ?></th>
						</tr>
					</thead>
					<tbody>
						<?php
						foreach ($historials as $historiale): ?>
	<tr>
		<td class="actions">
			<?php echo $this->Html->link('<span class="glyphicon glyphicon-list-alt" title="Ver"></span>', array('action' => 'view', $historiale['Historial']['id']), array('escape'=>false)); ?>
			<?php echo $this->Html->link('<span class="glyphicon glyphicon-wrench" title="Ver"></span>', array('action' => 'edit', $historiale['Historial']['id']), array('escape'=>false)); ?>
			<?php echo $this->Form->postLink('<span class="glyphicon glyphicon-trash" title="Borrar"></span>', array('action' => 'delete', $historiale['Historial']['id']), array('escape'=>false), __('¿Estas seguro que desea borrar # %s?', $historiale['Historial']['id'])); ?>
		</td>
		<td><?php echo h($historiale['Historial']['id']); ?>&nbsp;</td>
		<td><?php echo h($historiale['Historial']['usuario']); ?>&nbsp;</td>
		<td><?php echo h($historiale['Historial']['url']); ?>&nbsp;</td>
		<td><?php echo h($historiale['Historial']['parametros']); ?>&nbsp;</td>
		<td><?php echo h($historiale['Historial']['navegador']); ?>&nbsp;</td>
		<td><?php echo h($historiale['Historial']['ip']); ?>&nbsp;</td>
		<td><?php echo h($historiale['Historial']['fecha']); ?>&nbsp;</td>
	</tr>
<?php endforeach; ?>
					</tbody>
				</table>
			</div><!-- /.table-responsive -->
			<center>
				<p><small>
					<?php
					echo $this->Paginator->counter(array(
					'format' => __('Página {:page} de {:pages}, mostrando {:current} registros de {:count} total, comenzando por el {:start}, y terminando en el {:end}')
					));
					?>				</small></p>
	
				<ul class="pagination">
					<?php
		echo $this->Paginator->prev('< ' . __('Anterior'), array('tag' => 'li'), null, array('class' => 'disabled', 'tag' => 'li', 'disabledTag' => 'a'));
		echo $this->Paginator->numbers(array('separator' => '', 'currentTag' => 'a', 'tag' => 'li', 'currentClass' => 'disabled'));
		echo $this->Paginator->next(__('Siguiente') . ' >', array('tag' => 'li'), null, array('class' => 'disabled', 'tag' => 'li', 'disabledTag' => 'a'));
	?>
				</ul><!-- /.pagination -->
			
			</center>
		</div><!-- /.index -->
	
	</div><!-- /#page-content .col-sm-9 -->

</div><!-- /#page-container .row-fluid -->
