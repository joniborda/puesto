<?php 
echo str_replace(array('&lt;?php&nbsp;','?&gt;'), '', highlight_string( '<?php ' .     var_export($e, true) . ' ?>', true ) );
?>