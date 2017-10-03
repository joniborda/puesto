<html>
	<meta charset="iso-8859-1">
<head>
	<style type="text/css">
		body {
			font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
		}
		.loading {
			text-align: center;
			max-width: 500px;
			margin: auto;
		}
	</style>
	<?php echo $this->Html->script ( 'libs/jquery-1.10.2.min' );?>
</head>

<body>
	<?php echo $this->fetch('content'); ?>
</body>
</html>