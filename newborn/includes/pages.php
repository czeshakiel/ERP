<?php
if(isset($_GET["dashboard"])){$page= "pages/mydashboard.php";}
elseif(isset($_GET["requests"])){$page= "pages/requests.php";}
elseif(isset($_GET["search_archive"])){$page= "pages/search_archive.php";}
elseif(isset($_GET["readers_report"])){$page= "pages/readers_report.php";}
elseif(isset($_GET["census_report"])){$page= "pages/census_report.php";}
elseif(isset($_GET["estockcard"])){$page= "pages/electronic_stockcard.php";}
elseif(isset($_GET["audiometry_report"])){$page= "pages/audiometry_report.php";}
elseif(isset($_GET["repeat_report"])){$page= "pages/nbsrepeat_report.php";}
elseif(isset($_GET["stockrequest"])){$page= "../pharmacy/scm_stockrequest.php"; include "../main/connection.php";}
elseif(isset($_GET["stockrequest2"])){$page= "../pharmacy/scm_stockrequest2.php"; include "../main/connection.php";}
elseif(isset($_GET["password"])){$page= "../pharmacy/scm_password.php"; include "../main/connection.php";}
elseif(isset($_GET["adjustment"])){$page= "../pharmacy/scm_adjustment.php"; include "../main/class.php";}
else{$page = "pages/mydashboard.php";}
?>