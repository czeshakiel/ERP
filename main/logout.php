<head>
<script type="text/javascript">
function disableBack() { window.history.forward();}
setTimeout("disableBack()", 0);
window.onunload = function () { null };
</script>  
</head>

<?php
include "class.php";
session_destroy();
$conn->query("DELETE FROM `user_session` WHERE ipaddress='$myip'");
echo"<script>window.location = 'http://$ip/ERP';</script>";
?>
