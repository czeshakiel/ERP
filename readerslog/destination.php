<?php
if($view=="main"){$main="main.php"; $sidebar="sidebar.php";}
elseif($view=="ptlist"){$main="ptlist.php"; $sidebar="sidebar.php";}
elseif($view=="makeresult"){$main="makeresult.php"; $sidebar="sidebar.php";}
elseif($view=="readerslogin"){$main="readerslogin.php"; $sidebar="sidebar.php";}
elseif($view=="xrayresults"){$main="../radiology/xrayresults.php"; $sidebar="sidebar.php";  $caseno = $_GET['caseno'];}
elseif($view=="editresult"){$main="../readerslog/editresult.php"; $sidebar="sidebar.php";}
?>
