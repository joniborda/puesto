<?php
	echo "<option value=''>Seleccione</option>";
if(!empty($options)) {
	foreach($options as $k => $v) {
		echo "<option value='$k'>$v</option>";
	}
	}
	
?>	