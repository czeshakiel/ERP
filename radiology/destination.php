<?php
if($view=="main"){$main="main.php"; $sidebar="sidebar.php";}
elseif($view=="xraydecking"){$main="xraydecking.php"; $sidebar="sidebar.php";}
elseif($view=="archives"){$main="../ns/searcharchives.php"; $sidebar="sidebar.php";}
elseif($view=="readerslogin"){$main="readerslogin.php"; $sidebar="sidebar.php";}
elseif($view=="xrayresults"){$main="xrayresults.php"; $sidebar="sidebar.php"; $caseno=$_GET['caseno'];}
elseif($view=="editresult"){$main="../readerslog/makeresult.php"; $sidebar="sidebar.php";}
elseif($view=="readersfee"){$main="readersfee.php"; $sidebar="sidebar.php";}
?>
