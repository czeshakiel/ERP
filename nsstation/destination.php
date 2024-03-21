<?php
if($view=="main"){$main="main.php"; $sidebar="sidebar.php";}
elseif($view=="detail"){$main="detail.php"; $sidebar="sidebardetail.php";}
elseif($view=="finaldx"){$main="finaldx.php"; $sidebar="sidebardetail.php";}
elseif($view=="otherinfo"){$main="../ns/cf4/otherinfo.php"; $sidebar="sidebardetail.php";}
elseif($view=="part2"){$main="../ns/cf4/part2.php"; $sidebar="sidebardetail.php";}
elseif($view=="part3"){$main="../ns/cf4/part3.php"; $sidebar="sidebardetail.php";}
elseif($view=="courseward"){$main="../ns/cf4/courseward.php"; $sidebar="sidebardetail.php";}
elseif($view=="printslip"){$main="../ns/printslip/main.php"; $sidebar="sidebardetail.php";}
elseif($view=="return"){$main="../ns/return.php"; $sidebar="sidebardetail.php";}
elseif($view=="medicationsheet"){$main="../ns/medicationsheet.php"; $sidebar="sidebardetail.php";}
elseif($view=="editcaseno"){$main="../ns/other/editcaseno.php"; $sidebar="sidebardetail.php";}
elseif($view=="ap"){$main="../ns/other/edit_ap.php"; $sidebar="sidebardetail.php";}
elseif($view=="dietlist"){$main="../ns/other/dietlist.php"; $sidebar="sidebardetail.php";}
elseif($view=="archives"){$main="../ns/searcharchives.php"; $sidebar="sidebar.php";}
elseif($view=="senior"){$main="../ns/other/senior.php"; $sidebar="sidebardetail.php";}

elseif($view=="stockrequest"){$main="../supplychain/stockrequest.php"; $sidebar="sidebar.php";}
elseif($view=="stockrequest2"){$main="../supplychain/stockrequest2.php"; $sidebar="sidebar.php";}




elseif($view=="mypatient"){$main="../nsstation/activepatient.php"; $sidebar="sidebar.php";}
elseif($view=="activept"){$main="../nsstation/activepatient.php"; $sidebar="sidebar.php";}
elseif($view=="activeptopd"){$main="../nsstation/activepatient.php"; $sidebar="sidebar.php";}
elseif($view=="dischargedpt"){$main="../nsstation/dischargedpatient.php"; $sidebar="sidebar.php";}
elseif($view=="archives"){$main="../nsstation/searcharchives.php"; $sidebar="sidebar.php";}
elseif($view=="otherfiles"){$main="../nsstation/otherfiles.php"; $sidebar="sidebardetail.php";}
elseif($view=="carthm"){$main="../nsstation/carthm.php"; $sidebar="sidebardetail.php";}
elseif($view=="carthm2"){$main="../nsstation/carthm2.php"; $sidebar="sidebardetail.php";}

elseif($view=="returnusageCN"){$main="../nsstation/returnusageCN.php"; $sidebar="sidebardetail.php";}
elseif($view=="procedure"){$main="../nsstation/procedure_sched.php"; $sidebar="sidebardetail.php";}
elseif($view=="xrayresults"){$main="../radiology/xrayresults.php"; $sidebar="sidebardetail.php";}
elseif($view=="cart"){$main="cart.php"; $sidebar="sidebardetail.php";}
elseif($view=="courseward"){$main="cf4/courseward.php"; $sidebar="sidebardetail.php";}
elseif($view=="dispt"){$main="dischargedpt.php"; $sidebar="sidebardetail.php";}
elseif($view=="hmrx"){$main="../nsstation/homemeds_rx/hmrx.php"; $sidebar="sidebardetail.php";}
elseif($view=="rxlist"){$main="../nsstation/homemeds_rx/rxlist.php"; $sidebar="sidebardetail.php";}
elseif($view=="nursesnote"){$main="../nsstation/nursesnote.php"; $sidebar="sidebardetail.php";}
elseif($view=="nursesnoteprint"){$main="../nsstation/nursesnoteprint.php"; $sidebar="sidebardetail.php";}
elseif($view=="printslip"){$main="../nsstation/printslip/main.php"; $sidebar="sidebardetail.php";}
elseif($view=="medicationsheet"){$main="../nsstation/medicationsheet.php"; $sidebar="sidebardetail.php";}



elseif($view=="editcaseno"){$main="../nsstation/other/editcaseno.php"; $sidebar="sidebardetail.php";}
elseif($view=="ap"){$main="../nsstation/other/edit_ap.php"; $sidebar="sidebardetail.php";}
elseif($view=="dietlist"){$main="../nsstation/other/dietlist.php"; $sidebar="sidebardetail.php";}
elseif($view=="mesheet"){$main="../nsstation/mesheet.php"; $sidebar="sidebardetail.php";}
elseif($view=="deletepending"){$main="../verifier/deletepending.php"; $sidebar="sidebardetail.php";}

elseif($view=="otherinfo2"){$main="../nsstation/cf4/otherinfo.php"; $sidebar="sidebardetail.php";}
elseif($view=="part1"){$main="../nsstation/cf4/part1.php"; $sidebar="sidebardetail.php";}
elseif($view=="part2"){$main="../nsstation/cf4/part2.php"; $sidebar="sidebardetail.php";}
elseif($view=="part3"){$main="../nsstation/cf4/part3.php"; $sidebar="sidebardetail.php";}

// --------------------------- ECG ACCESS --------------------------------
elseif($view == "ecgresults"){$main="../ecg/ecgresults.php"; $sidebar="sidebardetail.php";  $caseno=$_GET['caseno'];}
elseif($view == "ecg_deck"){$main="../ecg/ecg_deck.php"; $sidebar="sidebardetail.php";  $caseno=$_GET['caseno'];}

?>
