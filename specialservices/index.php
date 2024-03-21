
<?php
include "../main/class.php";
if($_SESSION['verifyuser']!="verified"){echo"<script>window.location='../';</script>";}
// -------------------------------------->>>>> ISSET DISPLAY -------------------->>>>>>>
if($dept=="OR"){$mymain = "main2.php";}else{$mymain = "main.php";}

if(isset($_GET['main'])){$main="$mymain"; $sidebar="sidebar.php";}
elseif(isset($_GET['detail'])){$main="../nsstation/detail.php"; $sidebar="../nsstation/sidebardetail.php";}
elseif(isset($_GET['archives'])){$main="../nsstation/searcharchives.php"; $sidebar="sidebar.php";}
elseif(isset($_GET['activepatients'])){$main="../nsstation/allpatient.php"; $sidebar="sidebar.php";}
elseif(isset($_GET['diagnosisresult'])){$main="../nsstation/diagnosisresult.php"; $sidebar="../nsstation/sidebardetail.php";}
elseif(isset($_GET['printslip'])){$main="../nsstation/printslip/main.php"; $sidebar="../nsstation/sidebardetail.php";}

elseif(isset($_GET['ptpf'])){$main="ptpf.php"; $sidebar="sidebar.php";}
elseif(isset($_GET['ptreport'])){$main="ptreport.php"; $sidebar="sidebar.php";}
elseif(isset($_GET['ptlab'])){$main="ptlab.php"; $sidebar="sidebar.php";}

elseif(isset($_GET['patientlist'])){$main="patientlist.php"; $sidebar="sidebar.php";}
elseif(isset($_GET['arpatient']) or isset($_GET['walkinpatient'])){$main="patientadmission.php"; $sidebar="sidebar.php";}


elseif(isset($_GET['rtlab'])){$main="rtlab.php"; $sidebar="sidebar.php";}
elseif(isset($_GET['rtresults'])){$main="rtresults.php"; $sidebar="sidebar.php";}
elseif(isset($_GET['abg_createresult'])){$main="abg_createresult.php"; $sidebar="sidebar.php";}

elseif(isset($_GET['autostk'])){$main="auto_stk.php"; $sidebar="sidebar.php";}
elseif(isset($_GET['autostkdetails'])){$main="auto_stk_details.php"; $sidebar="sidebar.php";}

elseif(isset($_GET['stockrequest'])){$main="../pharmacy/scm_stockrequest.php"; $sidebar="sidebar.php";}
elseif(isset($_GET['stockrequest2'])){$main="../pharmacy/scm_stockrequest2.php"; $sidebar="sidebar.php";}
elseif(isset($_GET['issuancehistory'])){$main="../pharmacy/scm_issuancehistory.php"; $sidebar="sidebar.php";}
elseif(isset($_GET['issuancehistory2'])){$main="../pharmacy/scm_issuancehistory2.php"; $sidebar="sidebar.php";}
elseif(isset($_GET['issuancehistorysummary'])){$main="../pharmacy/scm_issuancehistorysummary.php"; $sidebar="sidebar.php";}

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
document.getElementById("maindisplay").style.display="";
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
<div class="main px-lg-4 px-md-4">
<?php include "../main/heading.php"; ?>
<div id="maindisplay" style="display: none;"><?php include "$main"; ?> <br></div>
</div>
</div>

<?php
if($dept=="OR" or $dept=="DR" or $dept=="PT" or $dept=="RT"){$mydept="$dept";}
else{$mydept="OR";}

include "../verifymodule.php";

$_SESSION['homemeds']='';
include "../chargecart/cartmodal.php";
include "../nsstation/modal_class.php";
include "../main/footer.php";
?>
</body>
</html>
