<?php
if($view=="main"){$main="main.php"; $sidebar="sidebar.php";}
elseif($view=="details"){$main="detail.php"; $sidebar="sidebar.php";}
elseif($view=="pos"){$main="POS.php"; $sidebar="sidebar.php";}
elseif($view=="returnitem"){$main="returnitem.php"; $sidebar="sidebar.php";}
elseif($view=="returnitem2"){$main="returnitem2.php"; $sidebar="sidebar.php";}
elseif($view=="servemonitoring"){$main="servemonitoring.php"; $sidebar="sidebar.php";}
elseif($view=="trackinvoice"){$main="trackinvoice.php"; $sidebar="sidebar.php";}

elseif($view=="manualreceiving"){$main="../supplychain/manualreceiving.php"; $sidebar="sidebar.php";}
elseif($view=="manualreceiving2"){$main="../supplychain/manualreceiving2.php"; $sidebar="sidebar.php";}
elseif($view=="password"){$main="../supplychain/password.php"; $sidebar="sidebar.php";}
elseif($view=="adjustment"){$main="../supplychain/adjustment.php"; $sidebar="sidebar.php";}
elseif($view=="bulkadjustment"){$main="../supplychain/bulkadjustment.php"; $sidebar="sidebar.php";}
elseif($view=="purchaserequest"){$main="../supplychain/purchaserequest.php"; $sidebar="sidebar.php";}
elseif($view=="purchaserequest2"){$main="../supplychain/purchaserequest2.php"; $sidebar="sidebar.php";}
elseif($view=="adjustmenthistory"){$main="../supplychain/adjustmenthistory.php"; $sidebar="sidebar.php";}
elseif($view=="adjustmenthistory2"){$main="../supplychain/adjustmenthistory2.php"; $sidebar="sidebar.php";}
elseif($view=="adjustmenthistory2det"){$main="../supplychain/adjustmenthistory2detail.php"; $sidebar="sidebar.php";}
elseif($view=="purchasereceivinghistory"){$main="../supplychain/purchasereceivinghistory.php"; $sidebar="sidebar.php";}
elseif($view=="purchasereceivinghistorylist"){$main="../supplychain/purchasereceivinghistorylist.php"; $sidebar="sidebar.php";}
elseif($view=="stockrequest"){$main="../supplychain/stockrequest.php"; $sidebar="sidebar.php";}
elseif($view=="stockrequest2"){$main="../supplychain/stockrequest2.php"; $sidebar="sidebar.php";}
elseif($view=="stockissuance"){$main="../supplychain/stockissuance.php"; $sidebar="sidebar.php";}
elseif($view=="stockissuance2"){$main="../supplychain/stockissuance2.php"; $sidebar="sidebar.php";}

elseif($view=="mainhm"){$main="mainhm.php"; $sidebar="sidebar.php";}
elseif($view=="mainrx"){$main="mainrx.php"; $sidebar="sidebar.php";}
elseif($view=="viewprice"){$main="viewprice.php"; $sidebar="sidebar.php";}
elseif($view=="requestreturn"){$main="requestreturn.php"; $sidebar="sidebar.php";}
elseif($view=="requestreturn2"){$main="requestreturn2.php"; $sidebar="sidebar.php";}



elseif($view=="manualreceiving"){$main="../scm/manualreceiving.php"; $sidebar="sidebar.php";}
elseif($view=="manualreceiving2"){$main="../scm/manualreceiving2.php"; $sidebar="sidebar.php";}
elseif($view=="password"){$main="../scm/password.php"; $sidebar="sidebar.php";}
elseif($view=="adjustment"){$main="../scm/adjustment.php"; $sidebar="sidebar.php";}


elseif($view=="activepatients"){$main="../ns/allpatient.php"; $sidebar="sidebar.php";}
elseif($view=="activeptopd"){$main="../ns/activepatient.php"; $sidebar="sidebar.php";}
elseif($view=="dischargedpt"){$main="../ns/dischargedpatient.php"; $sidebar="sidebar.php";}
elseif($view=="archive"){$main="../ns/searcharchives.php"; $sidebar="sidebar.php";}
elseif($view=="detail"){$main="../ns/detail.php"; $sidebar="../ns/sidebardetail.php"; $caseno = $_GET['caseno'];}











elseif($view=="manage_qty") {$sidebar = "sidebar.php"; $main="../cashier/manage_qty.php";}
elseif($view=="manage_cancel") {$sidebar = "sidebar.php"; $main="../cashier/manage_cancel.php";}

elseif($view=="estockcard") {$sidebar = "sidebar.php"; $main="../scm/e_stockcard.php";}
elseif($view=="estockcard2") {$sidebar = "sidebar.php"; $main="../scm/e_stockcard2.php";}

elseif($view=="arpatient") {$sidebar = "sidebar.php"; $main="../admission/main.php";}

elseif($view=="inventory"){$main="inventory.php"; $sidebar="sidebar.php";}

elseif($view=="cndate"){$main="cndate.php"; $sidebar="sidebar.php";}
elseif($view=="cnreport"){$main="cnreport.php"; $sidebar="sidebar.php";}
elseif($view=="cddate"){$main="cddate.php"; $sidebar="sidebar.php";}
elseif($view=="cdreport"){$main="cdreport.php"; $sidebar="sidebar.php";}


elseif($view=="posdoc"){$main="POSdoc.php"; $sidebar="sidebar.php";}
elseif($view=="posemp"){$main="POSemp.php"; $sidebar="sidebar.php";}

elseif($view=="adjustmenthistory"){$main="../scm/adjustmenthistory.php"; $sidebar="sidebar.php";}
elseif($view=="adjustmenthistory2"){$main="../scm/adjustmenthistory2.php"; $sidebar="sidebar.php";}
elseif($view=="adjustmenthistory2det"){$main="../scm/adjustmenthistory2detail.php"; $sidebar="sidebar.php";}
elseif($view=="purchaserequest"){$main="../scm/purchaserequest.php"; $sidebar="sidebar.php";}
elseif($view=="purchaserequest2"){$main="../scm/purchaserequest2.php"; $sidebar="sidebar.php";}
elseif($view=="extractpo"){$main="../scm/extractpohistory.php"; $sidebar="sidebar.php";}
elseif($view=="extractpohistorylist"){$main="../scm/extractpohistorylist.php"; $sidebar="sidebar.php";}
elseif($view=="extractpodetails"){$main="../scm/extractpodetails.php"; $sidebar="sidebar.php";}

elseif($view=="purchasereceivinghistory"){$main="../scm/purchasereceivinghistory.php"; $sidebar="sidebar.php";}
elseif($view=="purchasereceivinghistorylist"){$main="../scm/purchasereceivinghistorylist.php"; $sidebar="sidebar.php";}
elseif($view=="kitassembly"){$main="../scm/kitassembly.php"; $sidebar="sidebar.php";}
elseif($view=="trackinvoice"){$main="trackinvoice.php"; $sidebar="sidebar.php";}
else{$main ="../main/404.php"; $sidebar="sidebar.php";}
?>
