<?php 
if (!isset($filename)) {
	$filename = 'reporte';
}

header("Content-Type: application/vnd.ms-excel; charset=UTF-8");
header("Content-Disposition: attachment; filename=" . $filename . ".xls");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private", false);

$letras = array(
	'É', 'È', 'Ñ', 'ñ', 'à', 'á', 'Á', 'À', 'è', 'é', 'í', 'ì', 
	'Í', 'Ì', 'Ò', 'Ó', 'ò', 'ó', 'Ù', 'Ú', 'ú', 'ù', 'ü', 'Ü'
);
$codigos = array(
	chr(200), chr(201), chr(209), chr(241), chr(224), chr(225), chr(193), chr(192), chr(232), chr(233), chr(236), chr(237), 
	chr(205), chr(204), chr(210), chr(210), chr(242), chr(242), chr(243), chr(217), chr(250), chr(250), chr(250), chr(252), chr(220));

echo str_replace($letras, $codigos, $this->element($element_path));
die();
?>
