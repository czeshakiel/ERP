<?php
if($view=="main"){$main="main.php"; $sidebar="sidebar.php";}
elseif($view=="xraydecking"){$main="xraydecking.php"; $sidebar="sidebar.php";}
elseif($view=="archives"){$main="../ns/searcharchives.php"; $sidebar="sidebar.php";}
elseif($view=="generateresult"){$main="generateresult.php"; $sidebar="sidebar.php";}
elseif($view=="resultdecking"){$main="resultdecking.php"; $sidebar="sidebar.php";}
elseif($view=="cr2decho"){$main="cr_2decho_ver2.php"; $sidebar="sidebar.php"; $caseno=$_GET['caseno'];}
elseif($view=="details"){$main="heartresults.php"; $sidebar="sidebar.php"; $caseno=$_GET['caseno'];}
?>
