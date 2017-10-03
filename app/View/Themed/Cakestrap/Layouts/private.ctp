<?php
$cakeDescription = __d('cake_dev', 'Gastos Menores');
?>
<?php echo $this->Html->docType('html5'); ?>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
	</title>
	<?php
	echo $this->Html->meta ( 'icon' );

	echo $this->fetch ( 'meta' );

	echo $this->Html->css ( 'bootstrap.min' );
	echo $this->Html->css ( 'core' );
	echo $this->Html->css ( 'jquery/jquery-ui-1.10.3.custom.min.css' );
	echo $this->Html->css ( 'default.css' );
	echo $this->Html->css ( 'default_1200.css' );
	echo $this->Html->css ( 'default_768.css' );
	echo $this->Html->css ( 'default_640.css' );
	echo $this->Html->css ( 'jquery.mmenu.css' );
	echo $this->Html->css ( 'jquery.mmenu.all.css' );
	echo $this->Html->css ( 'select2/select2.min' );
	echo $this->Html->css ( 'fontawesome/css/font-awesome.min' );

	echo $this->fetch ( 'css' );

	echo $this->Html->script ( 'libs/jquery-1.10.2.min' );
	echo $this->Html->script ( 'libs/bootstrap' );
	echo $this->Html->script ( 'jquery/jquery.floatThead.js' );
	echo $this->Html->script ( 'jquery/jquery-ui-1.10.3.custom' );
	echo $this->Html->script ( 'jquery/jquery.ui.datepicker-es.min' );
	echo $this->Html->script ( 'jquery/multiselect/bootstrap-multiselect.js' );
	echo $this->Html->script ( 'jquery/jquery.zoomooz.min.js' );
	echo $this->Html->script ( 'jquery.mmenu.js' );
	echo $this->Html->script ( 'jquery.mmenu.all.js' );
	echo $this->Html->script ( 'default.js' );
	echo $this->Html->script ( 'location.js' );
	echo $this->Html->script ('/js/select2/select2.min.js');
	echo $this->fetch ( 'script' );
	?>
	<meta http-equiv="X-UA-Compatible"
	content="IE=10; IE=9; IE=8; IE=7; IE=EDGE" />
	<script type="text/javascript">
		var base_url = 'http://<?php echo $_SERVER['HTTP_HOST'].ROUTER::url("/"); ?>';
		var usuario_login = null;
		<?php if (isset($current_user) && $current_user):?>
			usuario_login = '<?php echo $current_user['usuario_login']?>';
		<?php endif;?>
	</script>
</head>
<body>
	<?php $nombre_archivo = parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH);

	if ( strpos($nombre_archivo, '/') !== FALSE ) {
		$array = explode('/', $nombre_archivo);
		$nombre_archivo = array_pop($array);
	}
	$claseLogin = '';
	if($nombre_archivo == 'login') {
		$claseLogin = 'class="container-login"';
	}?>
	<div id="main-container" <?php echo $claseLogin;?>>
		<!-- /#header .container -->
		<div id="content" class="container">

			<?php echo $this->Session->flash('auth'); ?>
			<?php echo $this->Session->flash(); ?>
			<?php echo $this->fetch('content'); ?>
		</div>
		<!-- /#header .container -->

	    <div class="sql_dump container margen_izquierda">
	    	<div class="">
	    		<small>
	    			<?php echo $this->element('sql_dump'); ?>
	    		</small>
	    	</div>
	    	<!-- /.well well-sm -->
	    </div>

		<div id="footer" class="container-fluid">
			<div class="footer_title">
			DIRECCIÓN GENERAL DE GESTIÓN DE LA INFORMACIÓN
			</div>
			<div>
				<img src="<?php echo Router::url('/');?>img/secretaria.svg" class="logo-footer"/>
	    	</div>
        </div>
        <!-- /#footer .container -->
	    <!-- /.container -->

	    <div id="modal" class="modal fade">
	    	<div class="modal-dialog" role="document">
	    		<div class="modal-content">
	    			<div class="modal-header">
	    				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	    					<span aria-hidden="true">×</span>
	    				</button>
	    				<h4 class="modal-title"></h4>
	    			</div>
	    			<div class="modal-body">
	    			</div>
	    		</div>
	    	</div>
	    </div>

	    <div id="modal_error" class="modal fade">
	    	<div class="modal-dialog" role="document">
	    		<div class="modal-content">
	    			<div class="modal-header">
	    				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	    					<span aria-hidden="true">×</span>
	    				</button>
	    				<h4 class="modal-title">Modal</h4>
	    			</div>
	    			<div class="modal-body error">
	    			</div>
	    		</div>
	    	</div>
	    </div>
    </div>
	<?php if($current_user): ?>
		<?php echo $this->element('menu/top_menu'); ?>
	<?php endif; ?>
</body>
<script type="text/javascript">
$('#menu').mmenu({
	"navbars": [
		{
			"content": $('#top_menu_div'),
			"position": "top",
			"height": 5
		}
	]         
});

function mostrarNavBar(miliseconds) {
	$('#main-container').animate(
		{
			'padding-left': '15%'
		},
		miliseconds
	);
	$( "#menu" ).animate({
			opacity: 1,
			width: [ "toggle", "swing" ]
		}, miliseconds, function() {
			$('#menu').css('display', 'initial');
		}
	);
}
function ocultarNavBar(miliseconds) {
	$('#main-container').animate(
		{
			'padding-left': 0
		},
		miliseconds
	);
	$( "#menu" ).animate({
			opacity: 0.25,
			width: [ "toggle", "swing" ]
		}, miliseconds, function() {
			$('#menu').css('display', 'none');
		}
	);
}
</script>
</html>
