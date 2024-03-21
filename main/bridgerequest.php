<?php
session_start();
$fn = $_SESSION['username'];
$un = $_SESSION['userunique'];
$dept = $_SESSION['dept'];
?>
<script type="text/javascript">
	window.location='../medmatrix/request_stock/<?=$fn;?>/<?=$un;?>/<?=$dept;?>';
</script>