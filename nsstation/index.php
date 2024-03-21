
<?php
include "../main/class.php";
if($_SESSION['verifyuser']!="verified"){echo"<script>alert('Session Expired!'); window.location='../';</script>";}

// -------------------------------------->>>>> ISSET DISPLAY -------------------->>>>>>>
if(isset($_GET['main'])){$main="main.php"; $sidebar="sidebar.php";}
elseif(isset($_GET['detail'])){$main="detail.php"; $sidebar="sidebardetail.php";}
elseif(isset($_GET['diagnosisresult'])){$main="diagnosisresult.php"; $sidebar="sidebardetail.php";}
elseif(isset($_GET['dischargedlist'])){$main="dischargedlist.php"; $sidebar="sidebar.php";}

elseif(isset($_GET['otherinfo'])){$main="cf4/otherinfo.php"; $sidebar="sidebardetail.php";}
elseif(isset($_GET['part2'])){$main="cf4/part2.php"; $sidebar="sidebardetail.php";}
elseif(isset($_GET['part3'])){$main="cf4/part3.php"; $sidebar="sidebardetail.php";}
elseif(isset($_GET['finaldx'])){$main="finaldx.php"; $sidebar="sidebardetail.php";}

elseif(isset($_GET['editcaseno'])){$main="../nsstation/other/editcaseno.php"; $sidebar="sidebardetail.php";}
elseif(isset($_GET['ap'])){$main="../nsstation/other/edit_ap.php"; $sidebar="sidebardetail.php";}
elseif(isset($_GET['dietlist'])){$main="../nsstation/other/dietlist.php"; $sidebar="sidebardetail.php";}
elseif(isset($_GET['senior'])){$main="../nsstation/other/senior.php"; $sidebar="sidebardetail.php";}
elseif(isset($_GET['room'])){$main="../nsstation/other/room.php"; $sidebar="sidebardetail.php";}
elseif(isset($_GET['medicationsheet'])){$main="../nsstation/medicationsheet.php"; $sidebar="sidebardetail.php";}
elseif(isset($_GET['medicationsheetgroup'])){$main="../nsstation/medicationsheetgroup.php"; $sidebar="sidebardetail.php";}
elseif(isset($_GET['labcharges'])){$main="../nsstation/labcharges.php"; $sidebar="sidebardetail.php";}
elseif(isset($_GET['archives'])){$main="../nsstation/searcharchives.php"; $sidebar="sidebar.php";}
elseif(isset($_GET['printslip'])){$main="../nsstation/printslip/main.php"; $sidebar="sidebardetail.php";}
elseif(isset($_GET['nursesnote'])){$main="../nsstation/nursesnote.php"; $sidebar="sidebardetail.php";}
elseif(isset($_GET['proceduresched'])){$main="../nsstation/procedure_sched.php"; $sidebar="sidebardetail.php";}
elseif(isset($_GET['dischargedsummary'])){$main="../nsstation/dischargedsummary.php"; $sidebar="sidebardetail.php";}

elseif(isset($_GET['stockrequest'])){$main="../pharmacy/scm_stockrequest.php"; $sidebar="sidebar.php";}
elseif(isset($_GET['stockrequest2'])){$main="../pharmacy/scm_stockrequest2.php"; $sidebar="sidebar.php";}

elseif(isset($_GET['autostk'])){$main="auto_stk.php"; $sidebar="sidebar.php";}
elseif(isset($_GET['autostkdetails'])){$main="auto_stk_details.php"; $sidebar="sidebar.php";}

elseif(isset($_GET['xrayresults'])){$main="../radiology/xrayresults.php"; $sidebar="sidebardetail.php";}
elseif(isset($_GET['dischargedpt'])){$main="../nsstation/dischargedpt.php"; $sidebar="sidebardetail.php";}
else{$main="main.php"; $sidebar="sidebar.php";}
// ------------------------------------------------------------------------------ >>>>>>


include "../main/header.php";
?>

<!------------------------------- AUTO LOADING IF PAGE IS LOADING --------------------->
<style>
.center {
position: absolute;
top: 0;
bottom: 0;
left: 0;
right: 0;
margin: auto;
}
</style>

<script>
document.onreadystatechange = function() {
if (document.readyState !== "complete") {
document.getElementById("loading").style.display="";
document.getElementById("maindisplay").style.display="none";
} else {
document.getElementById("loading").style.display="none";
document.getElementById("maindisplay").style.display="";
}
};
</script>
<img src="../main/img/loading2.gif" id="loading" class="center"></img>
<!--------------------------- END AUTO LOADING IF PAGE IS LOADING --------------------->



<body>
<div id="mytask-layout" class="theme-indigo">
<?php include "$sidebar"; ?>

<!-- main body area -->
<div class="main px-lg-4 px-md-4" style="overflow-y: scroll;">
<?php include "../main/heading.php"; ?>
<div id="maindisplay" style="display: none;"><?php include "$main"; ?> <br></div>
</div>
</div>


<?php

if(strpos($dept, "NS")!==false or strpos($dept, "RECORDS")!==false or $dept=="OPD" or $dept=="ER" or $dept=="RDU" or $dept=="ADMISSION"  or $dept=="MARKETING"  or $dept=="ICU"  or $dept=="SCU"  or $dept=="HMO" or $dept=="ONCOLOGY"){$mydept=$dept;}else{$mydept="NS";}
include "../verifymodule.php";


$_SESSION['homemeds']='';
include "../chargecart/cartmodal.php";
include "../nsstation/modal_class.php";
include "../main/footer.php";
?>
</body>
</html>
