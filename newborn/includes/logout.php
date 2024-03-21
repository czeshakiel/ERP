<head>
<script type="text/javascript">
function disableBack() { window.history.forward();}
setTimeout("disableBack()", 0);
window.onunload = function () { null };
</script>  
</head>

<?php
include "../meshes/alink.php";
session_destroy();
echo"<script>window.location = 'http://$ip/ERP';</script>";
?>
